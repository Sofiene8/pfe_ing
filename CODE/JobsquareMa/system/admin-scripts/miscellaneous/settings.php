<?php

class SJB_Admin_Miscellaneous_Settings extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $errors = [];
        $action = SJB_Request::getVar('action');
        $page = SJB_Request::getVar('page');

        if ($action == 'apply_settings') {
            if (SJB_H::isSaas() && SJB_Settings::getValue('domain') != SJB_Request::getVar('domain')) {
                $_REQUEST['domain'] =
                    $domain = trim(mb_strtolower(preg_replace('#https?://|/#ui', '', SJB_Request::getVar('domain'))));
                $response = SJB_HelperFunctions::whmcsCall('parkdomain', [
                    'client_username' => SJB_Session::getValue('saas')['email'],
                    'whmcsProductId' => SJB_Session::getValue('saas')['id'],
                    'domain' => $domain,
                ]);
                if (empty($response) || $response['result'] != 'success') {
                    if (!empty($response['message']) && preg_match('/already exists/iu', $response['message'])) {
                        $errors[] = 'Sorry, this domain name is already in use by another Smartjobboard website. Please try another one.';
                    } elseif (!empty($response['message']) && preg_match('/invalid subdomain|invalid domain specified/iu', $response['message'])) {
                        $errors[] = 'Sorry, the domain name entered is using invalid syntax. Take a look at this article for more info: <a target="_blank" href="https://en.wikipedia.org/wiki/Domain_Name_System#Domain_name_syntax">https://en.wikipedia.org/wiki/Domain_Name_System#Domain_name_syntax</a>';
                    } elseif (!empty($response['message']) && preg_match('/namespace call to function/iu', $response['message'])) {
                        $errors[] = 'Sorry, the domain name entered is using invalid syntax. Take a look at this article for more info: <a target="_blank" href="https://en.wikipedia.org/wiki/Domain_Name_System#Domain_name_syntax">https://en.wikipedia.org/wiki/Domain_Name_System#Domain_name_syntax</a>';
                    } else {
                        $errors[] = 'Unable to change domain';
                        SJB_Error::getInstance()->addError(sprintf('Unable to park domain %s to client %s (%s) - %s',
                            $domain,
                            SJB_Session::getValue('username'),
                            SJB_Session::getValue('saas')['id'],
                            print_r($response, true)
                        ));
                    }
                } elseif ($domain) {
                    \SJB\Analytics\Logger::log('Added Custom Domain', ['Domain Name' => $domain]);
                    \SJB\Analytics\Logger::intercom('Added custom domain');
                }
            }
            if (empty($errors)) {
                SJB_Settings::updateSettings($_REQUEST);
                if (SJB_H::isSaas()) {
                    SJB_Settings::updateCustomDomainRedirect();
                }
            } else {
                // leave form as is if we have some errors
                foreach (SJB_Settings::getSettings() as $key => $value) {
                    if (isset($_REQUEST[$key]) && $_REQUEST[$key] != $value) {
                        SJB_Settings::changeValue($key, $_REQUEST[$key]);
                    }
                }
            }

            $tp->assign('page', $page);
        }

        $i18n = SJB_I18N::getInstance();
        $tp->assign('settings', SJB_Settings::getSettings());
        if (SJB_H::isSaas()) {
            $tp->assign('ip', SJB_System::getSystemSettings('env')['SJB']['sites_ip']);
            $tp->assign('from_email', SJB_H::getFromSaasDefaultEmail());
            $tp->assign('email_domain_verified', SJB_H::isEmailDomainVerified());
        }
        $tp->assign('timezones', timezone_identifiers_list());

        $tp->assign('errors', $errors);
        $tp->assign('i18n_domains', $i18n->getDomainsData());
        $tp->assign('currencies', SJB_CurrencyManager::getCurrencies());
        $tp->assign('date_formats', SJB_DateFormatter::getFormats());
        $tp->assign('recruiting_pipeline', json_decode(SJB_Settings::getValue('application_statuses'),true));
        $tp->display('settings.tpl');
    }
}