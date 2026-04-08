<?php

class SJB_Admin_Classifieds_DeleteListingTypeField extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        $fieldId = SJB_Request::getVar('sid', null);
        if (!is_null($fieldId)) {
            $fieldInfo = SJB_ListingFieldManager::getFieldInfoBySID($fieldId);
            if ($fieldInfo) {
                SJB_ListingFieldManager::deleteListingFieldBySID($fieldId);
                SJB_HelperFunctions::redirect(SJB_H::getSiteUrl() . '/edit-listing-type/?sid=' . $fieldInfo['listing_type_sid']);
            }
        }
        echo SJB_I18N::getInstance()->gettext(null, 'Unable to find listing field');
    }
}
