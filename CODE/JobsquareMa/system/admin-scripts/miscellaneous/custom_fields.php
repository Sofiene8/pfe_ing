<?php

class SJB_Admin_Miscellaneous_CustomFields extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
		$tp = SJB_System::getTemplateProcessor();
		$tp->display('custom_fields.tpl');
	}
}
