<?php

class SJB_Admin_Classifieds_DeleteSecteur extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }
	
	public function execute()
	{
		$state_sid = SJB_Request::getVar('sid', null);

		if (!is_null($state_sid)) {
			$listingFieldID = SJB_SecteurManager::getSecteurInfoBySID($state_sid);
				SJB_SecteurManager::deleteSecteurBySID($state_sid);
			
		}
SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage_secteurs/");
		echo 'The system  cannot proceed as Listing Field SID is not set';
	}
}

