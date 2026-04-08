<?php


class SJB_Admin_Classifieds_ListingFields extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
		$template_processor = SJB_System::getTemplateProcessor();

		$listing_fields_info = SJB_ListingFieldManager::getCommonListingFieldsInfo();
		$listing_fields = array();
		$listing_field_sids = array();

		foreach ($listing_fields_info as $listing_field_info) {
			$listing_field = new SJB_ListingField($listing_field_info);
			$listing_field->setSID($listing_field_info['sid']);

			$listing_fields[] = $listing_field;
			$listing_field_sids[] = $listing_field_info['sid'];
		}

		$form_collection = new SJB_FormCollection($listing_fields);
		$form_collection->registerTags($template_processor);

		$template_processor->assign("listing_field_sids", $listing_field_sids);
		$template_processor->display("listing_fields.tpl");
	}
}
