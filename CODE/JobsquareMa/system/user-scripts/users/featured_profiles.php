<?php

class SJB_Users_FeaturedProfiles extends SJB_Function
{
    public function execute()
    {

        $template = SJB_Request::getVar('template', 'featured_profiles.tpl');
        $listingType = SJB_Request::getVar('listingType', 'Job');
        if ($listingType == 'Training') {
            $profiles = self::getFeaturedProfilesForTrainings(SJB_Request::getVar('items_count', 1));
        } else {
            $profiles = SJB_UserManager::getFeaturedProfiles(SJB_Request::getVar('items_count', 1));
        }
        $tp = SJB_System::getTemplateProcessor();
        $tp->assign('profiles', $profiles);

        // Count active listings by type with a single query
        $countListings = array();
        if ($listingType) {
            $listingTypeSID = SJB_ListingTypeManager::getListingTypeSIDByID($listingType);
            $count = SJB_DB::queryValue("SELECT COUNT(*) FROM `listings` WHERE `active` = 1 AND `listing_type_sid` = ?n", $listingTypeSID);
            $countListings[$listingType] = $count;
        } else {
            $rows = SJB_DB::query("SELECT lt.`id`, COUNT(l.`sid`) as `count` FROM `listing_types` lt LEFT JOIN `listings` l ON l.`listing_type_sid` = lt.`sid` AND l.`active` = 1 GROUP BY lt.`sid`, lt.`id`");
            foreach ($rows as $row) {
                $countListings[$row['id']] = $row['count'];
            }
        }
        $tp->assign('listings_types', $countListings);

        $tp->display($template);
    }


    /**
     * @param  int $numberOfProfiles
     * @return array
     */
    public static function getFeaturedProfilesForTrainings($numberOfProfiles)
    {
        $logosInfo = SJB_UserProfileFieldManager::getFieldsInfoByType('logo');
        $logoFields = [];
        foreach ($logosInfo as $logoInfo) {
            if (!empty($logoInfo['id'])) {
                $logoFields[] = " `{$logoInfo['id']}` != '' ";
            }
        }

        $whereLogo = empty($logos) ? '' : 'AND (' . implode(' OR ', $logoFields) . ')';


                                   $query = "SELECT DISTINCT(`users`.`sid`) 
																 FROM `users`
																 INNER JOIN `listings` ON `users`.`sid` = `listings`.`user_sid`
																 {$whereLogo}
																 AND `listings`.`listing_type_sid` = '26' and `users`.`featured`=1
																ORDER BY RAND() LIMIT 0, ?n";
        $usersInfo = SJB_DB::query($query, $numberOfProfiles);

        $users = [];
        $sids = [];
        foreach ($usersInfo as $userInfo) {
            $user = SJB_UserManager::getObjectBySID($userInfo['sid']);
            $users[] = !empty($user) ? SJB_UserManager::createTemplateStructureForUser($user) : null;
            $sids[] = $userInfo['sid'];
        }

        if ($sids) {
            $listingType = SJB_ListingTypeManager::getListingTypeInfoBySID(SJB_ListingTypeManager::getListingTypeSIDByID('Training'));
            $countListings = SJB_ListingDBManager::getActiveJobsNumberForUsers($sids, $listingType);
            foreach ($users as $key => $user) {
                if (!empty($countListings[$user['sid']])) {
                    $users[$key]['countListings'] = $countListings[$user['sid']];
                } else {
                  //  unset($users[$key]);
					$users[$key]['countListings'] =0;
                }
            }
        }

        return $users;
    }


}