<?php

class SJB_Admin_Classifieds_EditListingType extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        $listingTypeSID = SJB_Request::getVar('sid');
        if ($listingTypeSID == '6') {
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . '/posting-pages/job/edit/11');
        }
        if ($listingTypeSID == '7') {
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . '/posting-pages/resume/edit/19');
        }
        if ($listingTypeSID == '26') {
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . '/posting-pages/training/edit/38');
        }
    }
}
