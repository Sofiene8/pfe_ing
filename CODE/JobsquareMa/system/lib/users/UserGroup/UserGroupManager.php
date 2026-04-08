<?php

class SJB_UserGroupManager
{
    public static function getAllUserGroups()
    {
        $user_groups_info = SJB_UserGroupDBManager::getAllUserGroupsInfo();
        $user_groups = [];
        foreach ($user_groups_info as $user_group_info) {
            $user_group = new SJB_UserGroup($user_group_info);
            $user_group->setSID($user_group_info['sid']);
            $user_groups[] = $user_group;
        }
        return $user_groups;
    }

    public static function getAllUserGroupsInfo()
    {
        return SJB_UserGroupDBManager::getAllUserGroupsInfo();
    }

    public static function getUserGroupInfoBySID($user_group_sid)
    {
        $cacheId = md5('SJB_UserGroupManager::getUserGroupInfoBySID' . $user_group_sid);
        $cache = SJB_Cache::getInstance();
        if ($cache->test($cacheId)) {
            return $cache->load($cacheId);
        }
        $groupInfo = SJB_UserGroupDBManager::getUserGroupInfoBySID($user_group_sid);
        $cache->save($groupInfo, $cacheId, [SJB_Cache::TAG_FIELDS, SJB_Cache::TAG_USERS]);
        return $groupInfo;
    }

    public static function getUserGroupSIDByID($user_group_id)
    {
        return SJB_UserGroupDBManager::getUserGroupSIDByID($user_group_id);
    }

    public static function getUserGroupIDBySID($user_group_sid)
    {
        return SJB_UserGroupDBManager::getUserGroupIDBySID($user_group_sid);
    }

    public static function getUserGroupIDByUserSID($userSid)
    {
        return SJB_UserGroupDBManager::getUserGroupIDByUserSID($userSid);
    }

    public static function getUserGroupIDByUserName($userSid)
    {
        return SJB_UserGroupDBManager::getUserGroupIDByUserName($userSid);
    }

    public static function getUserGroupNameBySID($user_group_sid)
    {
        return SJB_UserGroupDBManager::getUserGroupNameBySID($user_group_sid);
    }

    public static function getUserGroupSIDByName($user_group_name)
    {
        return SJB_UserGroupDBManager::getUserGroupSIDByName($user_group_name);
    }

    public static function getAllUserGroupsIDsAndCaptions()
    {
        $cacheId = 'UserGroupManager::getAllUserGroupsIDsAndCaptions';
        if (SJB_MemoryCache::has($cacheId))
            return SJB_MemoryCache::get($cacheId);
        $user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
        $user_groups_ids_and_captions = [];
        foreach ($user_groups_info as $user_group_info) {
            $user_groups_ids_and_captions[] = [
                'id' => $user_group_info['sid'],
                'key' => $user_group_info['id'],
                'caption' => $user_group_info['name']
            ];
        }
        SJB_MemoryCache::set($cacheId, $user_groups_ids_and_captions);
        return $user_groups_ids_and_captions;
    }

    public static function createTemplateStructureForUserGroups()
    {
        $user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
        $structure = [];
        foreach ($user_groups_info as $user_group_info) {
            $structure[$user_group_info['id']] = [
                'sid' => $user_group_info['sid'],
                'id' => $user_group_info['id'],
                'caption' => $user_group_info['name'],
            ];
        }

        return $structure;
    }

    public static function setDefaultProduct($groupSID, $productSID)
    {
        SJB_Cache::getInstance()->clean('matchingAnyTag', [SJB_Cache::TAG_FIELDS, SJB_Cache::TAG_USERS]);
        SJB_DB::query('UPDATE `user_groups`	SET `default_product` = ?n WHERE `sid` = ?n', $productSID, $groupSID);
        return true;
    }

    /**
     * @param integer $groupSID
     * @return integer|false
     */
    public static function getDefaultProduct($groupSID)
    {
        $defaultProduct = SJB_DB::queryValue('SELECT `default_product` from `user_groups` WHERE `sid` = ?n', $groupSID);
        if (empty($defaultProduct))
            return false;
        return (is_numeric($defaultProduct) && $defaultProduct != 0) ? intval($defaultProduct) : false;
    }

    public static function getEmailTemplateSIDByUserGroupAndField($userGroupSID, $field)
    {
        $userGroupInfo = SJB_UserGroupManager::getUserGroupInfoBySID($userGroupSID);
        return SJB_Array::get($userGroupInfo, $field);
    }

    public static function getRedirectUrlByPageID()
    {
        $redirectUrl = SJB_System::getSystemSettings('SITE_URL') . '/my-account/?';
        $user = SJB_UserManager::getCurrentUserInfo();
        if ($user['user_group_sid'] == SJB_UserGroup::EMPLOYER) {
            $redirectUrl = SJB_System::getSystemSettings('SITE_URL') . '/my-listings/job/';
        }
        if (SJB_Request::getVar('return_url')) {
            $redirectUrl = base64_decode(SJB_Request::getVar('return_url'));
        }
        return $redirectUrl;
    }
}
