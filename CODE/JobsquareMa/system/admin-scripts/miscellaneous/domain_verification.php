<?php

class SJB_Admin_Miscellaneous_DomainVerification extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $email = SJB_Request::getVar('email', SJB_Settings::getValue('system_email'));
        $ses = SJB_System::getSystemSettings('env')['SES'];
        $ses = \Aws\Ses\SesClient::factory([
            'key' => $ses['key'],
            'secret' => $ses['secret'],
            'region'  => 'eu-west-1',
        ]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            SJB_FlashMessages::getInstance()->addError('Please enter valid email');
            $tp->display('domain_verification.tpl');
            exit();
        }
        list(,$emailDomain) = explode('@', $email);
        $action = SJB_Request::getVar('action', 'records');

        switch ($action) {
            case 'records':
                $records = [];
                try {
                    $r = $ses->verifyDomainIdentity(['Domain' => $emailDomain]);
                    $records[] = [
                        'name' => $emailDomain,
                        'type' => 'TXT',
                        'value' => $r['VerificationToken'],
                    ];

                    $r = $ses->verifyDomainDkim(['Domain' => $emailDomain]);
                    foreach ($r['DkimTokens'] as $token) {
                        $records[] = [
                            'name' => "{$token}._domainkey.{$emailDomain}",
                            'type' => 'CNAME',
                            'value' => "{$token}.dkim.amazonses.com",
                        ];
                    }
                    $tp->assign('records', $records);
                } catch (Exception $ex) {
                    SJB_FlashMessages::getInstance()->addError($ex->getMessage());
                }
                break;
            case 'verify':
                try {
                    $dkimAtt = $ses->getIdentityDkimAttributes(['Identities' => [$emailDomain]]);
                    $domainAtt = $ses->getIdentityVerificationAttributes(['Identities' => [$emailDomain]]);
                    if (
                        $dkimAtt['DkimAttributes'][$emailDomain]['DkimVerificationStatus'] == 'Success' &&
                        $domainAtt['VerificationAttributes'][$emailDomain]['VerificationStatus'] == 'Success'
                    ) {
                        SJB_Settings::saveSetting('email_domain_verified', $emailDomain);
                        SJB_FlashMessages::getInstance()->addMessage("Domain for {$email} email has been verified.");
                    } else {

                        SJB_FlashMessages::getInstance()->addError(
                            "Unable to locate DKIM DNS record for {$emailDomain}. If you have created the record, it may still be propagating. Please try again later."
                        );
                    }
                } catch (Exception $ex) {
                    SJB_FlashMessages::getInstance()->addError($ex->getMessage());
                }
//                $ses->setIdentityDkimEnabled([
//                    'Identity' => $emailDomain,
//                    'DkimEnabled' => true
//                ]);
                break;
        }
//
        $tp->assign('action', $action);
        $tp->display('domain_verification.tpl');
    }
}