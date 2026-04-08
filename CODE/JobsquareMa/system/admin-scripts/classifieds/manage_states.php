<?php


class SJB_Admin_Classifieds_ManageStates extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
	
		$template_processor = SJB_System::getTemplateProcessor();
	 $states = SJB_DB::query("SELECT * FROM `states` order by `sid`"); 	 
		
		//$messages = array();
		$states_sids = array();

		foreach ($states as $state) {
			//$listing_field = new SJB_ListingField($message);
			//$listing_field->setSID($message['sid']);

			//$listing_fields[] = $listing_field;
			$states_sids[] = $state['sid'];
		}

		//$form_collection = new SJB_FormCollection($messages);
		//$form_collection->registerTags($template_processor);

		$template_processor->assign("states", $states);
		$template_processor->display("manage_states.tpl");
	}
}
