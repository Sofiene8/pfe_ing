<?php

class SJB_Admin_Users_EditUserProfile extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
		$tp = SJB_System::getTemplateProcessor();
		$user_group_sid = SJB_Request::getVar('user_group_sid', null);
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
		$errors = null;

        switch (SJB_Request::getVar('field_action'))
        {
            case 'save_order':
                foreach (array_keys(SJB_Request::getVar('item_order', [])) as $key => $item) {
                    SJB_DB::query('update `user_profile_fields` set `order` = ?n where sid = ?n', $key + 1, $item);
                }
                break;
        }

		if (!is_null($user_group_sid)) {
			$user_profile_fields = SJB_UserProfileFieldManager::getFieldsInfoByUserGroupSID($user_group_sid);
		} else {
			$errors['USER_GROUP_SID_NOT_SET'] = 1;
			$user_profile_fields = null;
		}

		$tp->assign('errors', $errors);
		$tp->assign('user_profile_fields', $user_profile_fields);
		$tp->assign('user_group_sid', $user_group_sid);
		$tp->assign('user_group_info', $user_group_info);
		$tp->display('edit_user_profile_fields.tpl');
	}
}
