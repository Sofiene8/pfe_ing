<?php

class SJB_Admin_SocialMedia_SocialMedia extends SJB_Function
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
        $settings = $this->getSettings();
        $saved = false;

        switch (SJB_Request::getVar('action')) {

            case 'save_settings':
                $errors = $this->checkFields($_REQUEST);
                if (!$errors) {
                    foreach ($settings as $networkSettings) {
                        foreach ($networkSettings as $settingsItem) {
                            SJB_Settings::saveSetting($settingsItem['id'], SJB_Request::getVar($settingsItem['id']));
                        }
                    }
                    $saved = true;
                }

                break;
        }

        $tp->assign('networks', $settings);
        $tp->assign('saved', $saved);
        $tp->assign('settings', SJB_Settings::getSettings());
        $tp->assign('errors', $errors);
        $tp->display('social_media_settings.tpl');
    }

    private function getSettings()
    {
        return [
            'Facebook' => [
                [
                    'id' => 'fb_signin',
                    'caption' => 'Enable login with Facebook',
                    'type' => 'boolean',
                    'length' => '255',
                    'is_required' => false,
                    'is_system' => true,
                    'order' => 0,
                    'comment' => '',
                ],
                [
                    'id' => 'fb_appID',
                    'caption' => 'App ID',
                    'type' => 'string',
                    'length' => '255',
                    'is_required' => true,
                    'is_system' => true,
                    'order' => -1,
                    'comment' => 'To get these credentials you need to create an application in <a href="https://developers.facebook.com/" target="_blank">Facebook Developers Console</a>.'
                ],
                [
                    'id' => 'fb_appSecret',
                    'caption' => 'App Secret',
                    'type' => 'string',
                    'length' => '255',
                    'is_required' => true,
                    'is_system' => true,
                    'order' => -0,
                ],
            ],
            'Linkedin' => [
                [
                    'id' => 'li_signin',
                    'caption' => 'Enable login with Linkedin',
                    'type' => 'boolean',
                    'length' => '255',
                    'is_required' => false,
                    'is_system' => true,
                    'order' => 0,
                    'comment' => '',
                ],
                [
                    'id' => 'li_apiKey',
                    'caption' => 'Client ID',
                    'type' => 'string',
                    'length' => '255',
                    'is_required' => true,
                    'is_system' => true,
                    'order' => 1,
                    'comment' => 'To get these credentials you need to create an application in <a href="https://www.linkedin.com/secure/developer" target="_blank">Linkedin Developer Network</a>',
                ],
                [
                    'id' => 'li_secKey',
                    'caption' => 'Client Secret',
                    'type' => 'string',
                    'length' => '255',
                    'is_required' => true,
                    'is_system' => true,
                    'order' => 2,
                ],
            ]
        ];
    }

    /**
     * @param  array $settings
     * @return bool
     */
    private function checkFields(array $settings)
    {
        $errors = [];
        foreach ($this->getSettings() as $network => $networkSettings) {
            if (!$settings[current($networkSettings)['id']]) {
                continue;
            }
            foreach ($networkSettings as $settingsField) {
                if (!empty($settingsField['is_required'])  && empty($settings[$settingsField['id']])) {
                    $errors[] = $settingsField['caption'] . ' is empty';
                }
            }
        }

        return $errors;
    }
}
