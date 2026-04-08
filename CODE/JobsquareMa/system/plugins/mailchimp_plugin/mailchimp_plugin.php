<?php

class MailChimpPlugin extends SJB_PluginAbstract
{
    public static function init()
    {
        if (SJB_Settings::getSettingByName('mc_subscribe_new_users')) {
            SJB_Event::handle('onAfterUserCreated', ['MailChimpPlugin', 'subscribeUser']);
        }
    }

    function pluginSettings()
    {
        return [
            [
                'id' => 'mc_subscribe_new_users',
                'caption' => 'Automatically subscribe newly registered users',
                'type' => 'boolean',
                'length' => '50',
                'order' => null,
            ],
            [
                'id' => 'mc_apikey',
                'caption' => 'API Key',
                'type' => 'string',
                'comment' => 'Please check this MC page for more info: <a href="https://us4.admin.mailchimp.com/account/api" target="_blank">https://us4.admin.mailchimp.com/account/api</a></p>',
                'length' => '50',
                'order' => null,
            ],
            [
                'id' => 'mc_emplistId',
                'caption' => 'Employers List ID',
                'type' => 'string',
                'length' => '50',
                'comment' => 'MailChimp Account &gt; Lists &gt; List Settings &gt; List Settings & Unique ID',
                'order' => null,
            ],
            [
                'id' => 'mc_jslistId',
                'caption' => 'Job Seekers List ID',
                'type' => 'string',
                'length' => '50',
                'comment' => 'MailChimp Account &gt; Lists &gt; List Settings &gt; List Settings & Unique ID',
                'order' => null,
            ],
        ];
    }

    /**
     * @param SJB_User $user
     * @return bool
     * @throws Exception
     */
    public static function subscribeUser($user)
    {
        $lastName = '';
        $mergeFields = [];
        if (!empty($user)) {
            $email = $user->getUserName();
            if ($user->getPropertyValue('FullName')) {
                $firstName = $user->getPropertyValue('FullName');
                if (strpos($firstName, ' ') !== false) {
                    list($firstName, $lastName) = explode(' ', $firstName, 2);
                }
                $mergeFields['FNAME'] = $firstName;
                if ($lastName) {
                    $mergeFields['LNAME'] = $lastName;
                }
            }
        } else {
            return false;
        }

        $listId = SJB_Settings::getSettingByName($user->getUserGroupSID() == 41 ? 'mc_emplistId' : 'mc_jslistId');

        try {
            $mailchimp = new \DrewM\MailChimp\MailChimp(SJB_Settings::getSettingByName('mc_apikey'));
            $params = [
                'email_address' => $email,
                'status' => 'subscribed',
            ];
            if ($mergeFields) {
                $params['merge_fields'] = $mergeFields;
            }
            $mailchimp->put("lists/{$listId}/members/" . md5(mb_strtolower($email)), $params);
        } catch (Exception $ex) {
        }
    }
}
