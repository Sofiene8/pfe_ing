<?php


class SJB_Admin_Classifieds_ManageSecteurs extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
	
		$template_processor = SJB_System::getTemplateProcessor();
	 $secteurs = SJB_DB::query("SELECT * FROM `secteurs` order by `sid`"); 	 
		
		//$messages = array();
		$secteurs_sids = array();

		foreach ($secteurs as $secteur) {
			//$listing_field = new SJB_ListingField($message);
			//$listing_field->setSID($message['sid']);

			//$listing_fields[] = $listing_field;
			$secteurs_sids[] = $secteur['sid'];
		}

		//$form_collection = new SJB_FormCollection($messages);
		//$form_collection->registerTags($template_processor);

		$template_processor->assign("secteurs", $secteurs);
		$template_processor->display("manage_secteurs.tpl");
	}
}
