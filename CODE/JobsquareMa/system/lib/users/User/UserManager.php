<?php

class SJB_UserManager extends SJB_ObjectManager
{
    public static function getCurrentUserInfo()
    {
        if (SJB_Authorization::isUserLoggedIn())
            return SJB_Authorization::getCurrentUserInfo();
        return null;
    }

    public static function isUserLoggedIn()
    {
        return SJB_Authorization::isUserLoggedIn();
    }

    /**
     * Get current user
     *
     * @return SJB_User|null
     */
    public static function getCurrentUser()
    {
        $user_info = SJB_UserManager::getCurrentUserInfo();
        $user = null;
        if (!is_null($user_info)) {
            $user = new SJB_User($user_info, $user_info['user_group_sid']);
            $user->setSID($user_info['sid']);
        }
        return $user;
    }

    /**
     * Gets user object by sid
     *
     * @param int $user_sid
     * @return SJB_User
     */
    public static function getObjectBySID($user_sid)
    {
        $user_info = SJB_UserManager::getUserInfoBySID($user_sid);
        if (!is_null($user_info)) {
            $user = new SJB_User($user_info, $user_info['user_group_sid']);
            $user->setSID($user_info['sid']);
            return $user;
        }
        return null;
    }

    public static function getUserInfoBySID($user_sid)
    {
        return SJB_UserDBManager::getUserInfoBySID($user_sid);
    }

    /**
     * @static
     * @param SJB_User $user
     * @return bool
     */
    public static function saveUser(SJB_User $user)
    {
        \SJB\Location\Helper::fixLocation($user);
        $newUserInDB = !$user->isSavedInDB();
        if ($newUserInDB) {
            $user->createVerificationKey();
        }

        SJB_UserDBManager::saveUser($user);
        SJB_Cache::getInstance()->clean('matchingAnyTag', [SJB_Cache::TAG_USERS]);
        if ($newUserInDB) {
            SJB_Event::dispatch('onAfterUserCreated', $user);
        }

        if (SJB_Authorization::isUserLoggedIn()) {
            SJB_Authorization::updateCurrentUserSession();
        }

        return true;
    }

    public static function deleteUserById($id)
    {
        $user = SJB_UserManager::getObjectBySID($id);
        if (empty($user)) {
            SJB_UserDBManager::deleteEmptyUsers();
            return true;
        }

        SJB_Event::dispatch('onBeforeUserDelete', $user);

        $listings = SJB_ListingDBManager::getListingsSIDByUserSID($id);
        SJB_ListingManager::deleteListingBySID($listings);

        // delete user logo file
        $pictProp = $user->getProperty('Logo');
        if ($pictProp) {
            SJB_UploadFileManager::deleteUploadedFileByID($pictProp->value);
        }

        // delete social info
//        $socialReference = SJB_SocialPlugin::getProfileSocialID($user->getSID());
//        if ($socialReference) {
//            SJB_SocialPlugin::deleteProfileSocialInfoByReference($socialReference);
//        }


        $result = SJB_UserDBManager::deleteUserById($id) && SJB_ContractManager::deleteAllContractsByUserSID($id);
        SJB_Cache::getInstance()->clean('matchingAnyTag', [SJB_Cache::TAG_USERS]);
        return $result;
    }

    /**
     * @param $id int User id
     * @param $status int Status
     * @return bool
     */
    public static function setStatus($id, $status)
    {
        $result = SJB_UserDBManager::setStatus($id, $status);
        SJB_Cache::getInstance()->clean('matchingAnyTag', [SJB_Cache::TAG_USERS]);
        return $result;
    }

    public static function getUserInfoByUserName($username)
    {
        return SJB_UserDBManager::getUserInfoByUserName($username);
    }

    public static function getUserInfoByExtUserID($extUserID, $listingTypeID)
    {
        return SJB_UserDBManager::getUserInfoByExtUserID($extUserID, $listingTypeID);
    }

    public static function login($username, $password, &$errors, $autorizeByUsername, $login_as_user)
    {
        
		$userExists = SJB_DB::queryValue("SELECT count(*) FROM `users` WHERE `username` = ?s", $username);

        if ($userExists && $autorizeByUsername)
            return true;

        if ($userExists) {
            $userAuthorized = false;
            if ($login_as_user) {
                $userAuthorized = SJB_DB::queryValue("SELECT count(*) FROM `users` WHERE `username` = ?s", $username);
            } else {
                $storedPassword = SJB_DB::queryValue("SELECT `password` FROM `users` WHERE `username` = ?s", $username);
                if ($storedPassword) {
                    // Support both bcrypt and legacy md5 passwords
                    if (password_verify($password, $storedPassword)) {
                        $userAuthorized = true;
                    } elseif ($storedPassword === md5($password)) {
                        $userAuthorized = true;
                        // Upgrade legacy md5 to bcrypt
                        $userSid = SJB_DB::queryValue("SELECT `sid` FROM `users` WHERE `username` = ?s", $username);
                        if ($userSid) {
                            SJB_DB::query("UPDATE `users` SET `password` = ?s WHERE `sid` = ?n", password_hash($password, PASSWORD_BCRYPT), $userSid);
                        }
                    }
                }
            }

            if (!$userAuthorized) {
                $errors['NO_SUCH_USER'] = 1;
                return false;
            }
            return true;
        }

        $errors['NO_SUCH_USER'] = 1;
        return false;
    }

//    public static function login($username, $password, &$errors, $autorizeByUsername = false, $login_as_user)
//    {
//        $userExists = SJB_DB::queryValue("SELECT count(*) FROM `users` WHERE `username` = ?s", $username);
//
//        if ($userExists && $autorizeByUsername)
//            return true;
//
//        if ($userExists) {
//            $userAuthorized = false;
//            if ($login_as_user) {
//                if (SJB_Request::getVar('session')) {
//                    session_write_close();
//                    session_id(SJB_Request::getVar('session'));
//                    session_start();
//                }
//                if (SJB_Admin::admin_authed()) {
//                    $userAuthorized = SJB_DB::queryValue("SELECT count(*) FROM `users` WHERE `username` = ?s", $username);
//                }
//            } else {
//                $userAuthorized = SJB_DB::queryValue("SELECT count(*) FROM `users` WHERE `username` = ?s AND `password` = ?s", $username, md5($password));
//            }
//
//            if (!$userAuthorized) {
//                $errors['NO_SUCH_USER'] = 1;
//                return false;
//            }
//            return true;
//        }
//
//        $errors['NO_SUCH_USER'] = 1;
//        return false;
//    }

    public static function getCurrentUserSID()
    {
        $user_info = SJB_UserManager::getCurrentUserInfo();
        if (!is_null($user_info))
            return $user_info['sid'];
        return null;
    }

    public static function getUserNameByUserSID($user_sid)
    {
        return SJB_UserDBManager::getUserNameByUserSID($user_sid);
    }

    public static function getExtUserIDByUserSID($user_sid)
    {
        return SJB_UserDBManager::getExtUserIDByUserSID($user_sid);
    }

    public static function getUserSIDbyUsername($username)
    {
        $user_info = SJB_UserManager::getUserInfoByUserName($username);
        if (!empty($user_info))
            return $user_info['sid'];
        return null;
    }

    public static function getUserSIDsLikeUsername($username)
    {
        return SJB_UserDBManager::getUserSIDsLikeUsername($username);
    }

    public static function getUserSIDsLikeCompanyName($username)
    {
        return SJB_UserDBManager::getUserSIDsLikeCompanyName($username);
    }

    public static function changeUserPassword($user_sid, $password)
    {
        return SJB_DB::query("UPDATE `users` SET `password` = ?s WHERE `sid` = ?s", password_hash($password, PASSWORD_BCRYPT), $user_sid);
    }

    public static function saveUserSessionKey($session_key, $user_sid)
    {
        SJB_DB::query("INSERT INTO user_sessions SET session_key = ?s, user_sid = ?n, remote_ip = ?s, user_agent = ?s, start = UNIX_TIMESTAMP()", $session_key, $user_sid, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
    }

    public static function removeUserSessionKey($session_key)
    {
        SJB_DB::query("DELETE FROM user_sessions WHERE session_key = ?s", $session_key);
    }

    public static function getUserSIDBySessionKey($session_key)
    {
        return SJB_DB::queryValue("SELECT user_sid FROM user_sessions WHERE session_key = ?s", $session_key);
    }

    /**
     * @param SJB_User $user
     * @return array
     */
    public static function createTemplateStructureForUser($user)
    {
        if (!$user)
            return [];
        $structure = $user->getUserInfo();
        if (SJB_MemoryCache::has('userGroupInfo' . $user->getUserGroupSID())) {
            $user_group_info = SJB_MemoryCache::get('userGroupInfo' . $user->getUserGroupSID());
        } else {
            $user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user->getUserGroupSID());
            SJB_MemoryCache::set('userGroupInfo' . $user->getUserGroupSID(), $user_group_info);
        }
        foreach ($user->getProperties() as $property) {
            $value = $property->getValue();
            if ($property->getType() == 'list') {
                $listValues = isset($property->type->property_info['list_values']) ? $property->type->property_info['list_values'] : [];
                foreach ($listValues as $listValue) {
                    if ($listValue['id'] == $value)
                        $structure[$property->getID()] = $listValue['caption'];
                }
            } elseif ($property->getType() == 'location') {
                foreach ($property->type->fields as $locationField) {
                    if (isset($structure[$property->getID()]) && array_key_exists($locationField['id'], $structure[$property->getID()])) {
                        $listValues = isset($locationField['list_values']) ? $locationField['list_values'] : [];
                        foreach ($listValues as $listValue) {
                            if ($listValue['id'] == $value[$locationField['id']]) {
                                $structure[$property->getID()][$locationField['id']] = $listValue['caption'];
                            }
                        }
                    }
                }
            } else {
                $structure[$property->getID()] = $value;
            }
        }

        $structure['id'] = $user->getID();
        $structure['isJobg8'] = strpos($structure['username'], 'jobg8_') !== false;
        $structure['group'] = ['id' => $user_group_info['id'],
            'caption' => $user_group_info['name']];

        $structure['METADATA'] = [
            'group' => [
                'caption' => ['type' => 'string', 'propertyID' => 'caption'],
            ],
            'registration_date' => ['type' => 'date'],
        ];
        $structure['METADATA'] = array_merge($structure['METADATA'], parent::getObjectMetaData($user));
        return $structure;
    }

    public static function createTemplateStructureForCurrentUser()
    {
        return SJB_UserManager::createTemplateStructureForUser(SJB_UserManager::getCurrentUser());
    }

    /**
     * gets all groups info
     *
     * @return array
     */
    public static function getGroupsInfo()
    {
        $res = [];
        //TODO: можно ускорить и сделать так же как в листингах
        $today = SJB_DateType::mysqlToday();
        $periods = [
            'Total' => '1=1',
            'Today' => "`u`.`registration_date` >= '{$today}'",
            'Last 7 days' => "`u`.`registration_date` >= date_sub('{$today}', interval 7 day)",
            'Last 30 days' => "`u`.`registration_date` >= date_sub('{$today}', interval 30 day)",
        ];

        $user_groups_structure = SJB_UserGroupManager::createTemplateStructureForUserGroups();

        foreach ($user_groups_structure as $userGroup) {
            foreach ($periods as $key => $value) {
                $res[$userGroup['caption']][$key] = SJB_DB::queryValue("
					select	ifnull(count(u.user_group_sid), 0) as `count`
					from users u
					where {$value} and u.user_group_sid = {$userGroup['sid']}");
            }
        }
        return $res;
    }

    /**
     * gets all users info
     *
     * @return array
     */
    public static function getUsersInfo()
    {
        $usersInfo = SJB_DB::query("select ifnull(count(*), 0) as `count`, ifnull(sum(users.active), 0) as `active` from users");
        return array_shift($usersInfo);
    }

    /**
     * @param  int $numberOfProfiles
     * @return array
     */
    public static function getFeaturedProfiles($numberOfProfiles)
    {
        // Load all featured users with only needed fields in a single query
        $allFeatured = SJB_DB::query("SELECT u.`sid`, u.`username`, u.`CompanyName`, u.`WebSite`, u.`Logo`
            FROM `users_featured` u
            WHERE u.`featured` = 1 AND u.`active` = 1");

        if (empty($allFeatured)) {
            return [];
        }

        // Shuffle in PHP and pick the requested number
        shuffle($allFeatured);
        $selectedUsers = array_slice($allFeatured, 0, $numberOfProfiles);

        // Batch load all logo file info in a single query
        $logoIds = [];
        foreach ($selectedUsers as $userInfo) {
            if (!empty($userInfo['Logo'])) {
                $logoIds[] = $userInfo['Logo'];
                $logoIds[] = $userInfo['Logo'] . '_thumb';
            }
        }
        $logoFilesMap = [];
        if ($logoIds) {
            $logoFiles = SJB_DB::query("SELECT `id`, `saved_file_name`, `file_group`, `creation_time` FROM `uploaded_files` WHERE `id` IN (?l)", $logoIds);
            foreach ($logoFiles as $file) {
                $logoFilesMap[$file['id']] = $file;
            }
        }

        // Build logo URLs using the system's upload manager
        $upload_manager = new SJB_UploadPictureManager();
        $upload_manager->setFileGroup("pictures");
        $sids = [];
        $users = [];
        foreach ($selectedUsers as $userInfo) {
            $sids[] = $userInfo['sid'];
            $logoStructure = [];
            if (!empty($userInfo['Logo'])) {
                $logoKey = $userInfo['Logo'];
                $thumbKey = $logoKey . '_thumb';
                $fileInfo = isset($logoFilesMap[$logoKey]) ? $logoFilesMap[$logoKey] : null;
                $thumbInfo = isset($logoFilesMap[$thumbKey]) ? $logoFilesMap[$thumbKey] : null;
                $logoStructure = [
                    'file_url' => $fileInfo ? $upload_manager->getUploadedFileLink($logoKey, $fileInfo) : null,
                    'file_name' => $fileInfo ? $fileInfo['saved_file_name'] : null,
                    'thumb_file_url' => $thumbInfo ? $upload_manager->getUploadedFileLink($thumbKey, $thumbInfo) : null,
                    'thumb_file_name' => $thumbInfo ? $thumbInfo['saved_file_name'] : null,
                ];
            }
            $users[] = [
                'sid' => $userInfo['sid'],
                'id' => $userInfo['sid'],
                'CompanyName' => $userInfo['CompanyName'],
                'WebSite' => $userInfo['WebSite'],
                'Logo' => $logoStructure,
            ];
        }

        // Get job counts in a single query
        if ($sids) {
            $listingType = SJB_ListingTypeManager::getListingTypeInfoBySID(SJB_ListingTypeManager::getListingTypeSIDByID('Job'));
            $countListings = SJB_ListingDBManager::getActiveJobsNumberForUsers($sids, $listingType);
            foreach ($users as $key => $user) {
                $users[$key]['countListings'] = empty($countListings[$user['sid']]) ? 0 : $countListings[$user['sid']];
            }
        }

        return $users;
    }

    public static function getUserNameByCompanyName($companyName)
    {
        $userName = SJB_DB::queryValue("SELECT `username` FROM `users` WHERE `companyName`=?s", $companyName);
        return $userName ? $userName : false;
    }

    public static function getAllUserSystemProperties()
    {
        return [
            'system' => [
                'id', 'product', 'user_group', 'active', 'featured', 'ip', 'registration_date'
            ]
        ];
    }

    public static function makeFeaturedBySID($user_sid)
    {
        return SJB_DB::query("UPDATE users SET featured = 1 WHERE sid = ?n", $user_sid);
    }

    public static function removeFromFeaturedBySID($user_sid)
    {
        return SJB_DB::query("UPDATE users SET featured = 0 WHERE sid = ?n", $user_sid);
    }

    public static function getUserIdByKeywords($keywords)
    {
        return SJB_DB::queryValue("SELECT `sid` FROM `users` WHERE `username` = ?s OR `companyName` = ?s LIMIT 1", $keywords, $keywords);
    }

    /**
     * @param int $userSID
     * @param string $originalMd5Password
     * @return array|bool|int
     */
    public static function saveUserPassword($userSID, $originalMd5Password)
    {
        return SJB_DB::query('UPDATE `users` SET `password` = ?s WHERE `sid` = ?n', $originalMd5Password, $userSID);
    }

    public static function isUserExistsByUserSid($userSid)
    {
        return SJB_DB::queryValue("SELECT count(*) FROM `users` WHERE `sid` = ?n LIMIT 1", $userSid);
    }

}
