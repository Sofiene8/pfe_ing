<?php

class SJB_UserProfileFieldDBManager extends SJB_ObjectDBManager
{
	public static function getFieldsInfoByUserGroupSID($user_group_sid)
	{
		$fields = SJB_DB::query("SELECT sid FROM user_profile_fields WHERE user_group_sid = ?n AND `parent_sid` IS NULL ORDER BY `order`", $user_group_sid);
		$fields_info = array();
		foreach ($fields as $field) {
			$fields_info[] = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($field['sid']);
		}
		return $fields_info;
	}
	
	public static function getAllFieldsInfo()
	{
		$fields = SJB_DB::query("SELECT sid FROM user_profile_fields  ORDER BY `order`");
		$fields_info = array();
		foreach ($fields as $field) {
			$fields_info[] = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($field['sid']);
		}
		foreach ($fields_info as $key => $field_info) {
			$newArr = $fields_info;
			unset($newArr[$key]);
			foreach ($newArr as $value) {
				if ($field_info['id']==$value['id'])
					unset($fields_info[$key]);
			}
		}
		return $fields_info;
	}
	
	public static function getUserProfileFieldInfoBySID($user_profile_field_sid)
	{
		$field_info = parent::getObjectInfo("user_profile_fields", $user_profile_field_sid);
		if (in_array($field_info['type'], array('list', 'multilist'))) {
			$field_info['list_values'] = SJB_UserProfileFieldDBManager::getListValuesBySID($user_profile_field_sid);
		} elseif ($field_info['type'] == 'location') {
			$field_info['fields'] = SJB_UserProfileFieldManager::getUserProfileFieldsInfoByParentSID($user_profile_field_sid);
		}
		$field_info['typeCaption'] = SJB_ListingFieldDBManager::typeToCaption($field_info);
        $field_info['is_reserved'] = strpos($field_info['id'], 'id_') !== 0;
		
		return $field_info;
	}
	
	public static function getListValuesBySID($user_profile_field_sid)
	{
		$UserProfileFieldListItemManager = new SJB_UserProfileFieldListItemManager;
		$values = $UserProfileFieldListItemManager->getHashedListItemsByFieldSID($user_profile_field_sid);
		$field_values = array();
		
		foreach ($values as $key => $value) 
			$field_values[] = array('id' => $key, 'caption' => $value);
			
		return $field_values;
	}

	public static function saveUserProfileField($user_profile_field)
	{
		$user_group_sid = $user_profile_field->getUserGroupSID();
		if ($user_group_sid) {
			$fieldID = false;
			$sid = $user_profile_field->getSID();
			if ($sid) {
				$fieldInfo = parent::getObjectInfo('user_profile_fields', $sid);
				if (!empty($fieldInfo['id']))
					$fieldID = $fieldInfo['id'];
			}
			parent::saveObject("user_profile_fields", $user_profile_field);
            parent::saveField("users", "user_profile_fields", $user_profile_field, $fieldID);
			if ($user_profile_field->getOrder()) {
			    return true;
			}
			
			$max_order = SJB_DB::queryValue("SELECT MAX(`order`) FROM user_profile_fields WHERE user_group_sid = ?n", $user_group_sid);
            return SJB_DB::query("UPDATE user_profile_fields SET user_group_sid = ?n, `order` = ?n WHERE sid = ?n", $user_group_sid, $max_order + 1, $user_profile_field->getSID());
		
		}
		return false;
	}

	public static function deleteUserProfileFieldInfo($user_profile_field_sid)
	{
		$field_info = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($user_profile_field_sid);
//		if (!strcasecmp("list", $field_info['type'])) {
//			SJB_DB::query("DELETE FROM user_profile_field_list WHERE field_sid = ?n" . $user_profile_field_sid);
//		} else
		if (!strcasecmp('location', $field_info['type']))
			SJB_DB::query('DELETE FROM user_profile_fields WHERE parent_sid = ?n', $user_profile_field_sid);
			
		if (parent::deleteObjectInfoFromDB('user_profile_fields', $user_profile_field_sid)) {
			$result = SJB_DB::query("SELECT * FROM `user_profile_fields` WHERE `id` = ?s", $field_info['id']);
			if (count($result) == 0) {
				return parent::deleteField('users', $field_info['id']);
			} else {
				SJB_DB::query("UPDATE users SET `{$field_info['id']}` = null WHERE `user_group_sid` = ?n", $field_info['user_group_sid']);
			}
		}
		return false;
	}

}
