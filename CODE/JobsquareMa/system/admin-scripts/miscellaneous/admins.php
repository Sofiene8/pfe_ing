<?php

class SJB_Admin_Miscellaneous_Admins extends SJB_Function
{
    protected $selfAcc = false;

    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_FULL);
        $currentAdmin = SJB_Session::getValue('admin');
        $this->selfAcc = $currentAdmin && $currentAdmin['sid'] == SJB_Request::getVar('sid') && SJB_Request::getVar('action') == 'edit';
        return $this->selfAcc || parent::isAccessible();
    }

    public function execute()
    {
        if (!$this->selfAcc && !SJB_AdminAcl::getInstance()->isFeatureAllowed('Site Admins')) {
            echo SJB_System::executeFunction('miscellaneous', 'function_is_not_accessible', [
                'message' => sprintf(
                    '<p>Site Admins functionality is not available for your current plan.</p>' .
                    '<p>It allows to invite your teammates to manage your job board.</p>' .
                    '<p><a href="%s" class="btn btn--primary">Upgrade your account now</a></p>',
                    SJB_AdminAcl::getInstance()->getUpgradeUrl()
                )
            ]);
            return;
        }

        $tp = SJB_System::getTemplateProcessor();
        $errors = [];
        switch (SJB_Request::getVar('action')) {
            case 'new':
                $admin = new \SJB\Admins\Admin($_REQUEST);
                $admin->deleteProperty('password');

                $form = new SJB_Form($admin);
                if (SJB_Request::getVar('save') && $form->isDataValid($errors)) {
                    SJB_ObjectManager::saveObject('admins', $admin);
                    if (SJB_Notifications::sendAdminInvite($admin)) {
                        SJB_FlashMessages::getInstance()->addMessage('Invite successfully sent');
                        \SJB\Analytics\Logger::log('Site-admin invited');
                    } else {
                        SJB_FlashMessages::getInstance()->addWarning('Failed to send email');
                    }
                    SJB_H::redirect(SJB_H::getSiteUrl() . '/admins/');
                }
                $form->registerTags($tp);
                $tp->assign('form_fields', $form->getFormFieldsInfo());
                $tp->assign('errors', $errors);
                $tp->display('admin_invite.tpl');
                return;
                break;
            case 'edit':
                $adminInfo = SJB_DB::query('select * from `admins` where `sid` = ?n', SJB_Request::getVar('sid'));
                $adminInfo = array_pop($adminInfo);
                $currentAdmin = SJB_Session::getValue('admin');
                $admin = new \SJB\Admins\Admin(array_merge($adminInfo, $_REQUEST));
                if ($currentAdmin['sid'] == $adminInfo['sid']) {
                    $admin->deleteProperty('permissions');
                    $admin->deleteProperty('permissions_type');
                    $admin->addProperty([
                        'id' => 'current_password',
                        'caption' => 'Current Password',
                        'type' => 'current_password',
                        'is_required' => true,
                        'is_system' => true,
                        'current_password' => $adminInfo['password'],
                        'saas_owner' => SJB_H::isSaas() && $adminInfo['owner'],
                        'value' => SJB_Request::getVar('current_password'),
                    ]);
                    $properties = [];
                    foreach ($admin->details->properties as $property) {
                        if ($property->getID() == 'password') {
                            $properties['current_password'] = $admin->getProperty('current_password');
                        }
                        $properties[$property->getID()] = $property;
                    }
                    $admin->details->properties = $properties;
                }
                $form = new SJB_Form($admin);
                if (SJB_Request::getVar('save') && $form->isDataValid($errors)) {
                    $saved = false;
                    if (SJB_H::isSaas() && $adminInfo['owner']) {
                        $props = [
                            'domain' => SJB_System::getSystemSettings('HTTPHOST'),
                            'new_name' => $admin->getPropertyValue('name'),
                            'new_email' => $admin->getPropertyValue('email'),
                        ];
                        if ($admin->getPropertyValue('password')['original']) {
                            $props['new_pass'] = $admin->getPropertyValue('password')['original'];
                        }

                        $res = SJB_H::whmcsCall('updateclientnamepass', $props);
                        if (!$res || SJB_Array::get($res, 'result') == 'error') {
                            $errors[] = 'Ops... Something went wrong. Please try again!';
                            SJB_Error::getInstance()->addError(print_r($res, true));
                        } else {
                            SJB_ObjectManager::saveObject('admins', $admin);
                            if ($admin->getPropertyValue('password')['original']) {
                                SJB_Session::setValue('password', $admin->getPropertyValue('password')['original']);
                            }
                            $saved = true;
                        }
                    } else {
                        $password = $admin->getPropertyValue('password');
                        $properties = $admin->getProperties();
                        if (empty($password['original'])) {
                            $admin->deleteProperty('password');
                        }
                        SJB_ObjectManager::saveObject('admins', $admin);
                        $admin->details->properties = $properties;
                        $saved = true;
                    }

                    if ($saved && $currentAdmin['sid'] == $adminInfo['sid']) {
                        SJB_Admin::admin_login(
                            $admin->getPropertyValue('email'),
                            SJB_Session::getValue('saas'),
                            [],
                            $admin->getPropertyValue('password')['original'] ? $admin->getPropertyValue('password')['original'] : SJB_Request::getVar('current_password')
                        );
                    }
                }
                $form->registerTags($tp);
                $tp->assign('form_fields', $form->getFormFieldsInfo());
                $tp->assign('errors', $errors);
                $tp->assign('admin', $adminInfo);
                $tp->display('admin_edit.tpl');
                return;
                break;
            case 'delete':
                SJB_DB::query('delete from `admins` where `sid` = ?n and `owner` != 1', SJB_Request::getInt('sid'));
                break;
        }
        $admins = SJB_DB::query('select * from `admins`');
        $tp->assign('admins', $admins);
        $tp->display('admins.tpl');
    }
}
