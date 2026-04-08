<?php

class SJB_Admin_Users_DeleteUserProfileField extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
		$fieldId = SJB_Request::getVar('sid', null);
        if (!$fieldId) {
            // todo: 404
            return;
        }
        $fieldInfo = SJB_UserProfileFieldManager::getFieldInfoBySID($fieldId);
        if (!empty($fieldInfo['is_reserved'])) {
            return;
        }
        SJB_UserProfileFieldManager::deleteUserProfileFieldBySID($fieldId);
        SJB_HelperFunctions::redirect(SJB_H::getSiteUrl() . '/edit-user-profile/?user_group_sid=' . $fieldInfo['user_group_sid']);
	}
}
