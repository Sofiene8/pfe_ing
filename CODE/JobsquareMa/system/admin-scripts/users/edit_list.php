<?php

class SJB_Admin_Users_EditList extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
        $controller = new SJB_UserProfileDisplayListController($_REQUEST);
        $controller->display("user_profile_list_editing.tpl");
	}
}
