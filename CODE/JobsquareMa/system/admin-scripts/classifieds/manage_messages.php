<?php


class SJB_Admin_Classifieds_ManageMessages extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
	
		$template_processor = SJB_System::getTemplateProcessor();
	 $messages = SJB_DB::query("SELECT * FROM `messages` order by `sid`"); 	 
		
		//$messages = array();
		$messages_sids = array();

		foreach ($messages as $message) {
			//$listing_field = new SJB_ListingField($message);
			//$listing_field->setSID($message['sid']);

			//$listing_fields[] = $listing_field;
			$messages_sids[] = $message['sid'];
		}

		//$form_collection = new SJB_FormCollection($messages);
		//$form_collection->registerTags($template_processor);

		$template_processor->assign("messages", $messages);
		$template_processor->display("manage_messages.tpl");
	}
}
