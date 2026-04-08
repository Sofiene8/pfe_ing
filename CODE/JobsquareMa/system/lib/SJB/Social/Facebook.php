<?php

namespace SJB\Social;

use SJB_H;
use SJB_Listing;
use SJB_Navigator;
use SJB_Request;
use SJB_Settings;
use SJB_User;
use SJB_UserManager;

class Facebook
{
    /**
     * @var \Facebook\Facebook
     */
    private $fb;

    public static function getName()
    {
        return 'Facebook';
    }

    public function init()
    {
        $this->fb = new \Facebook\Facebook([
            'app_id' => SJB_Settings::getSettingByName('fb_appID'),
            'app_secret' => SJB_Settings::getSettingByName('fb_appSecret'),
            'default_graph_version' => 'v2.8',
        ]);

        if (!SJB_Request::getVar('code')) {
            $helper = $this->fb->getRedirectLoginHelper();
            $permissions = [
                'public_profile',
                'email',
                'user_education_history',
                'user_location',
                'user_website',
                'user_work_history'
            ];
            $loginUrl = $helper->getLoginUrl(SJB_H::getCustomDomainUrl() . SJB_Navigator::getURI() . '?' . $_SERVER['QUERY_STRING'], $permissions);
            SJB_H::redirect($loginUrl);
        }
    }

    public function getUser()
    {
        $helper = $this->fb->getRedirectLoginHelper();
        $response = $this->fb->get('/me?fields=id,email', $helper->getAccessToken());
        $gu = $response->getGraphUser();

        $user = SJB_UserManager::getUserInfoByUserName($gu->getEmail());
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function fillUser(SJB_User $user)
    {
        $helper = $this->fb->getRedirectLoginHelper();
        $response = $this->fb->get('/me?fields=id,email,name,location,work,website', $helper->getAccessToken());
        $gu = $response->getGraphUser();

        $user->setPropertyValue('username', $gu->getEmail());
        $user->setPropertyValue('FullName', $gu->getName());
        $user->setPropertyValue('password', md5(serialize($gu)));
        $u = $gu->asArray();
        if (!empty($u['work'])) {
            $user->setPropertyValue('CompanyName', $u['work'][0]['employer']['name']);
        }
        if (!empty($u['website'])) {
            $user->setPropertyValue('WebSite', $u['website']);
        }
        if (!empty($u['location'])) {
            $user->setPropertyValue('GooglePlace', $u['location']['name']);
        }
        return true;
    }

    public function fillListing(SJB_Listing $listing)
    {
        $helper = $this->fb->getRedirectLoginHelper();
        $response = $this->fb->get('/me?fields=picture.type(large),location,work,education', $helper->getAccessToken());
        $user = $response->getGraphUser()->asArray();

        if (!empty($user['picture']) && empty($user['picture']['is_silhouette'])) {
            $listing->setPropertyValue('Photo', $user['picture']['url']);
        }
        if (!empty($user['location'])) {
            $listing->setPropertyValue('GooglePlace', $user['location']['name']);
        }
        if (!empty($user['work'])) {
            $we = [
                'WE_JobTitle' => [],
                'WE_Company' => [],
                'WE_From' => [],
                'WE_To' => [],
                'WE_Description' => [],
            ];
            foreach ($user['work'] as $key => $work) {
                $key++;
                $we['WE_JobTitle'][$key] = empty($work['position']) ? '' : $work['position']['name'];
                $we['WE_Company'][$key] = empty($work['employer']) ? '' : $work['employer']['name'];
                $we['WE_From'][$key] = (empty($work['start_date']) || preg_match('/0000/', $work['start_date'])) ? '' : $work['start_date'];
                $we['WE_To'][$key] = (empty($work['end_date']) || preg_match('/0000/', $work['end_date'])) ? '' : $work['end_date'];
                $we['WE_Description'][$key] = empty($work['description']) ? '' : nl2br($work['description']);
            }
            $listing->setPropertyValue('WorkExperience', $we);
        }
        if (!empty($user['education'])) {
            $ed = [
                'ED_DegreeSpecialty' => [],
                'ED_UniversityInstitution' => [],
                'ED_From' => [],
                'ED_To' => [],
            ];
            $key = 1;
            foreach ($user['education'] as $education) {
                $ed['ED_DegreeSpecialty'][$key] = empty($education['degree']) ? '' : $education['degree']['name'];
                $ed['ED_UniversityInstitution'][$key] = empty($education['school']) ? '' : $education['school']['name'];
                $ed['ED_From'][$key] = '';
                $ed['ED_To'][$key] = '';
                if (!empty($education['year'])) {
                    $ed['ED_To'][$key] = '01-01-' . $education['year']['name'];
                }
                $key++;
            }
            $listing->setPropertyValue('Education', $ed);
        }
        return true;
    }
}
