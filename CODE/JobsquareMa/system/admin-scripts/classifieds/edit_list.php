<?php

class SJB_Admin_Classifieds_EditList extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
		$template_processor = SJB_System::getTemplateProcessor();
        $display_list_controller = new SJB_ListingDisplayListController($_REQUEST);
        $display_list_controller->setTemplateProcessor($template_processor);
        $display_list_controller->display("listing_list_editing.tpl");
	}
}
