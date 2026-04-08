<?php

class SJB_Admin_Applications_View extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_JOB_BOARD);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $displayTemplate = 'view.tpl';
        $errors = [];
 
        $filename = SJB_Request::getVar('filename', false);

        if ($filename) {
            $appsID = SJB_Request::getVar('appsID', false);
            if ($appsID) {
                $file = SJB_UploadFileManager::openApplicationFile($filename, $appsID);
                if (!$file) {
                    $errors['NO_SUCH_FILE'] = true;
                }
            } else {
                $errors['NO_SUCH_APPS'] = true;
            }
        }

        $cu = SJB_UserManager::getUserInfoBySID(SJB_Request::getVar('user_sid', null));
        $tp->assign('user_sid', $cu['sid']);
        $tp->assign('username', $cu['username']);

        $appJobId = SJB_Request::getVar('appJobId', false);

        if ($cu['user_group_sid'] == SJB_UserGroup::EMPLOYER) { // Работадатель
            if ($appJobId) {
                $apps = SJB_Applications::getByJob($appJobId, $orderInfo);
                $jobInfo = SJB_ListingManager::getListingInfoBySID($appJobId);
                $tp->assign('jobInfo', $jobInfo);
                $tp->assign('listingType', SJB_ListingTypeManager::getListingTypeInfoBySID($jobInfo['listing_type_sid']));
            } else {
                $apps = SJB_Applications::getByEmployer($cu['sid'], $orderInfo);
            }

            for ($i = 0; $i < count($apps); ++$i) {
                $apps[$i]['job'] = SJB_ListingManager::getListingInfoBySID($apps[$i]['listing_id']);
                if (isset($apps[$i]['resume']) && !empty($apps[$i]['resume'])) {
                    $apps[$i]['resumeInfo'] = SJB_ListingManager::getListingInfoBySID($apps[$i]['resume']);
                }
                if ($apps[$i]['jobseeker_id'] == 0) {
                    $apps[$i]['user']['FirstName'] = $apps[$i]['username'];
                }
                else {
                    $apps[$i]['user'] = SJB_UserManager::getUserInfoBySID($apps[$i]['jobseeker_id']);
                }
            }

            $tp->assign('current_filter', $appJobId);
        } else { // Соискатель
            $apps = SJB_Applications::getByJobseeker($cu['sid'], $orderInfo);
            for ($i = 0; $i < count($apps); ++$i) {
                $apps[$i]['job'] = SJB_ListingManager::getListingInfoBySID($apps[$i]['listing_id']);
                $apps[$i]['company'] = SJB_UserManager::getUserInfoBySID($apps[$i]['job']['user_sid']);
            }

            $displayTemplate = 'view_seeker.tpl';
        }

        if (isset($sortByUsername)) {
            $order = ($order == 'desc') ? SORT_DESC : SORT_ASC;
            foreach ($apps as $key => $value) {
                if (!isset($apps[$key]['user']['FirstName'])) {
                    $apps[$key]['user']['FirstName'] = '';
                }
                if (!isset($apps[$key]['user']['LastName'])) {
                    $apps[$key]['user']['LastName'] = '';
                }
                $sortKeys[$key] = $apps[$key]['user']['FirstName'] . ' ' . $apps[$key]['user']['LastName'];
            }
            if ($apps) {
                array_multisort($sortKeys, $order, SORT_REGULAR, $apps);
            }
        }

        $userGroupInfo = SJB_UserGroupManager::getUserGroupInfoBySID($cu['user_group_sid']);
		
      //  $tp->assign('METADATA', SJB_Applications::getApplicationMeta());
			
        $tp->assign('user_group_info', $userGroupInfo);
        $tp->assign('applications', $apps);
        $tp->assign('errors', $errors);
        $tp->display($displayTemplate);
    }
}
