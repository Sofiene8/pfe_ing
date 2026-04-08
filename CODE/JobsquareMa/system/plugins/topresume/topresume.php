<?php

class TopresumePlugin extends SJB_PluginAbstract
{
    public static function handleSystemBoot()
    {
        if (!SJB_PluginManager::isPluginActive('TopresumePlugin')) {
            return;
        }
        $isFbAppSettingsPage = SJB_Request::getVar('action') == 'settings' && SJB_Request::getVar('plugin') == 'TopresumePlugin';
        if ($isFbAppSettingsPage) {
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('ADMIN_SITE_URL') . '/system/miscellaneous/topresume/');
        }
        if (SJB_Navigator::getURI() == '/system/miscellaneous/topresume/') {
            SJB_System::getModuleManager()->addFunction('miscellaneous', 'topresume', [
                'display_name' => 'Topresume',
                'script' => '../../plugins/topresume/module/miscellaneous/topresume.php',
                'type' => 'admin',
                'access_type' => ['admin'],
            ]);
            require_once __DIR__ . '/module/miscellaneous/topresume.php';
        }
    }

    /**
     * @param SJB_Listing $listing
     */
    public static function uploadFromListing($listing)
    {
        $user = SJB_UserManager::getUserInfoBySID($listing->getUserSID());
        if (!$listing->getProperty('Resume')) {
            return;
        }
        $file = $listing->getProperty('Resume')->getSQLValue();
        if (!$file) {
            return;
        }
        $file = SJB_UploadFileManager::getUploadedFileInfo($file);
        $mime = $file['mime_type'];
        $file = SJB_BASE_DIR . 'files/' . $file['file_group'] . '/' . $file['saved_file_name'];
        $data = [
            'first_name' => $user['FullName'],
            'email' => $user['username'],
            'resume_file' => new CURLFile($file, $mime),
        ];
        self::upload($data);
    }

    public static function upload($data)
    {
        $data['partner_key'] = SJB_Settings::getValue('topresume_key');
        $data['secret_key'] = SJB_Settings::getValue('topresume_secret');
        $data['last_name'] = '';

        $url = 'https://api.talentinc.com/v1/resume';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
        curl_close($ch);
    }

    /**
     * @param SJB_Listing $listing
     * @return SJB_Listing
     */
    public static function listingSaved($listing)
    {
        if ($listing->getListingTypeSID() == SJB_ListingTypeManager::RESUME) {
            $info = SJB_ListingManager::getListingInfoBySID($listing->getSID());
            if (!empty($info['topresume'])) {
                self::uploadFromListing($listing);
            }
        }
        return $listing;
    }

    /**
     * @param SJB_Listing $listing
     * @return SJB_Listing
     */
    public static function addListingForm($listing)
    {
        $value = '';
        if ($listing->getSID()) {
            $info = SJB_ListingManager::getListingInfoBySID($listing->getSID());
            if (!empty($info['topresume'])) {
                $value = 1;
            }
        }
        $listing->addProperty([
            'id' => 'topresume',
            'caption' => 'FREE resume evaluation by a professional resume expert from TopResume',
            'type' => 'boolean',
            'value' => SJB_Request::getVar('topresume', $value),
            'is_system' => false,
        ]);

        // topresume must be after Resume field
        $topresumeProp = array_pop($listing->details->properties);
        $props = [];
        foreach (array_keys($listing->getProperties()) as $prop) {
            $props[$prop] = $listing->details->properties[$prop];
            if ($prop == 'Resume') {
                $props['topresume'] = $topresumeProp;
            }
        }
        $listing->details->properties = $props;
        return $listing;
    }
}

class SJB_TopResumeApply extends SJB_Object
{
    public function __construct($properties = [])
    {
        $this->details = new SJB_TopResumeApplyDetails($properties);
    }
}


class SJB_TopResumeApplyDetails extends SJB_ObjectDetails
{
    public static function getDetails()
    {
        return [
            [
                'id' => 'name',
                'caption' => 'Contact Name',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
            ],
            [
                'id' => 'email',
                'caption' => 'Email',
                'type' => 'email',
                'length' => '255',
                'is_required' => true,
            ],
            [
                'id' => 'phone',
                'caption' => 'Phone number',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
            ],
            [
                'id' => 'site_url',
                'caption' => 'Site URL',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
                'default_value' => SJB_H::getCustomDomainUrl()
            ],
            [
                'id' => 'country',
                'caption' => 'Country',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
            ],
            [
                'id' => 'traffic_from',
                'caption' => 'Majority of traffic comes from',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
            ],
            [
                'id' => 'audience',
                'caption' => 'Job board audience',
                'type' => 'list',
                'list_values' => [
                    [
                        'id' => 'US (TopResume)',
                        'caption' => 'US (TopResume)',
                    ],
                    [
                        'id' => 'International (CVNow)',
                        'caption' => 'International (CVNow)',
                    ]
                ],
                'default_value' => 'US (TopResume)',
                'is_required' => true,
            ]
        ];
    }
}
