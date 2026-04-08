<?php

class SJB_Admin_Main_AdminLogin extends SJB_Function
{
    public function isAccessible()
    {
        return true;
    }

    /**
     * Verify admin password against stored hash (bcrypt or legacy MD5).
     * Auto-rehashes legacy MD5 passwords to bcrypt on successful login.
     */
    private static function verifyAdminPassword($plainPassword, $admin)
    {
        $storedHash = $admin['password'];

        // Try bcrypt first
        if (password_verify($plainPassword, $storedHash)) {
            return true;
        }

        // Fallback: legacy MD5 check
        if ($storedHash === md5($plainPassword)) {
            // Re-hash with bcrypt and update DB
            $newHash = password_hash($plainPassword, PASSWORD_BCRYPT);
            SJB_DB::query('UPDATE `admins` SET `password` = ?s WHERE `sid` = ?n', $newHash, $admin['sid']);
            return true;
        }

        return false;
    }

    public function execute()
    {
        $errors = [];
        $params = [];
        foreach ($_REQUEST as $k => $v) {
            if (!is_array($v)) {
                $params[$k] = $v;
            }
        }

        if (SJB_Request::getVar('action') == 'login') {
            $admin = SJB_Admin::getAdmin(SJB_Request::getVar('username', ''));
            if (SJB_H::isSaas()) {
                $saasInfo = SJB_HelperFunctions::whmcsCall('saasinfo', [
                    'domain' => SJB_System::getSystemSettings('HTTPHOST'),
                    'saas_login' => SJB_Request::getVar('username', ''),
                    'saas_pass' => SJB_Request::getVar('password', ''),
                ]);

                if (!empty($saasInfo) && $saasInfo['result'] == 'success') {
                    if (!empty($saasInfo['owner'])) {
                        SJB_DB::query('update `admins` set `email` = ?s, `name` = ?s where `owner` = 1', $saasInfo['owner']['email'], trim($saasInfo['owner']['firstname'] . ' ' . $saasInfo['owner']['lastname']));
                        $admin = SJB_Admin::getAdmin(SJB_Request::getVar('username', ''));
                        return SJB_Admin::admin_login(SJB_Request::getVar('username', ''), $saasInfo['saas'], $admin, SJB_Request::getVar('password', ''));
                    }
                    if ($admin && empty($admin['owner'])) {
                        $inputPass = SJB_Request::getVar('password', '');
                        if (self::verifyAdminPassword($inputPass, $admin)) {
                            return SJB_Admin::admin_login(SJB_Request::getVar('username'), $saasInfo['saas'], $admin, $inputPass);
                        }
                    }
                }
            } else {
                $inputPass = SJB_Request::getVar('password', '');
                if ($admin && self::verifyAdminPassword($inputPass, $admin)) {
                    return SJB_Admin::admin_login(SJB_Request::getVar('username'), '', $admin);
                }
            }
            $errors['LOGIN_PASS_NOT_CORRECT'] = true;
        }
        $tp = SJB_System::getTemplateProcessor();
        $action = SJB_Request::getVar('action');
        switch ($action) {
            case 'password_recovery':
                $email = SJB_Request::getVar('email', false);
                if ($email !== false) {
                    $adminInfo = SJB_DB::query('select * from `admins` where `email` = ?s and `status` = "Active" limit 1', $email);
                    if (!$adminInfo && SJB_H::isSaas()) {
                        $saasInfo = SJB_HelperFunctions::whmcsCall('saasinfo', [
                            'domain' => SJB_System::getSystemSettings('HTTPHOST'),
                        ]);
                        if (!empty($saasInfo['saas']['email'])) {
                            SJB_DB::query('update `admins` set `email` = ?s where `owner` = 1', $saasInfo['saas']['email']);
                        }
                        $adminInfo = SJB_DB::query('select * from `admins` where `email` = ?s and `status` = "Active" limit 1', $email);
                    }
                    if ($adminInfo) {
                        $adminInfo = current($adminInfo);
                        $admin = new \SJB\Admins\Admin($adminInfo);
                        $adminInfo['recover_key'] = $admin->generateRecoverKey();
                        SJB_DB::query('update `admins` set `recover_key` = ?s where `sid` = ?n', $adminInfo['recover_key'], $adminInfo['sid']);
                        if (SJB_Notifications::sendAdminRecover($adminInfo)) {
                            SJB_FlashMessages::getInstance()->addMessage('Link to reset your password have been emailed to you.');
                            SJB_H::redirect(SJB_H::getAdminSiteUrl());
                        } else {
                            $errors[] = 'Oops... Something went wrong. Please try again!';
                        }
                    } else {
                        $errors[] = 'We could\'t find any record for the email you specified. Please try again!';
                    }
                    $tp->assign('email', $email);
                }
                break;
            case 'password_recover':
                $key = SJB_Request::getVar('recover_key');
                $adminInfo = SJB_DB::query('select * from `admins` where `recover_key` = ?s and `recover_key` is not null and `status` = "Active" limit 1', $key);
                if ($adminInfo) {
                    $adminInfo = current($adminInfo);
                    $admin = new \SJB\Admins\Admin(array_merge($_REQUEST, ['sid' => $adminInfo['sid']]));

                    foreach ($admin->getProperties() as $property) {
                        if ($property->getID() !== 'password') {
                            $admin->deleteProperty($property->getID());
                        }
                    }
                    $admin->makePropertyRequired('password');
                    $form = new SJB_Form($admin);
                    if (SJB_Request::getMethod() == SJB_Request::METHOD_POST && $form->isDataValid($errors)) {
                        if (SJB_H::isSaas() && $adminInfo['owner']) {
                            $props = [
                                'domain' => SJB_System::getSystemSettings('HTTPHOST'),
                                'new_email' => $adminInfo['email'],
                                'new_pass' => $admin->getPropertyValue('password')['original']
                            ];
                            $res = SJB_H::whmcsCall('updateclientnamepass', $props);
                            if (!$res || SJB_Array::get($res, 'result') == 'error') {
                                $errors[] = 'Oops... Something went wrong. Please try again!';
                            }
                        }
                        if (!$errors) {
                            SJB_ObjectManager::saveObject('admins', $admin);
                            SJB_DB::query('update `admins` set `recover_key` = null where `recover_key` = ?s', $key);
                            SJB_System::executeFunction('main', 'admin_login', [
                                'action' => 'login',
                                'username' => $adminInfo['email'],
                                'password' => $admin->getPropertyValue('password')['original'],
                            ]);
                            SJB_H::redirect(SJB_H::getAdminSiteUrl());
                        }
                    }
                    $form->registerTags($tp);
                    $tp->assign('form_fields', $form->getFormFieldsInfo());
                } else {
                    SJB_FlashMessages::getInstance()->addError(SJB_I18N::getInstance()->gettext('Frontend', 'Invalid token. Please try to reset your password again.'), ['type' => 'error']);
                    $action = 'login';
                }
                break;
            case 'activate':
                $subAdmin = SJB_DB::query('select * from `admins` where `email` = ?s and `status` = "Pending"', SJB_Request::getVar('email'));
                
			
				
				if (!$subAdmin) {
                    echo SJB_System::executeFunction('main', 'admin_login', ['action' => '']);
                    exit();
                } else {
                    $subAdmin = current($subAdmin);
                    $subAdmin = array_merge($subAdmin, $_REQUEST);
                    $subAdmin = new \SJB\Admins\Admin($subAdmin);
                    $subAdmin->deleteProperty('permissions');
                    $subAdmin->deleteProperty('permissions_type');
                    $subAdmin->deleteProperty('status');
                    $subAdmin->makePropertyRequired('password');

                    if ($subAdmin->getHash() != SJB_Request::getVar('hash')) {
                        echo SJB_System::executeFunction('main', 'admin_login', ['action' => '']);
                        exit();
                    }

                    $form = new SJB_Form($subAdmin);
                    if (SJB_Request::getVar('save') && $form->isDataValid($errors)) {
                        if ($subAdmin->getHash() == SJB_Request::getVar('hash')) {
                            $subAdmin->addStatusProperty();
                            $subAdmin->setPropertyValue('status', 'Active');
                            SJB_ObjectManager::saveObject('admins', $subAdmin);
                            SJB_System::executeFunction('main', 'admin_login', [
                                'action' => 'login',
                                'username' => $subAdmin->getPropertyValue('email'),
                                'password' => $subAdmin->getPropertyValue('password')['original'],
                            ]);
                            SJB_H::redirect(SJB_H::getSiteUrl());
                        }
                    }
                    $form->registerTags($tp);
                    $tp->assign('form_fields', $form->getFormFieldsInfo());
                }
                break;
            default:
                $action = 'login';
                break;
        }

        if (empty($action)) {
            $action = 'login';
        }

        $tp->assign('form_hidden_params', SJB_HelperFunctions::form(['action' => $action] + $params));
        $tp->assign('errors', $errors);
        $tp->assign('action', $action);
        $tp->assign('message', SJB_Request::getVar('message'));
        $tp->display('auth.tpl');
        exit();
    }
}
