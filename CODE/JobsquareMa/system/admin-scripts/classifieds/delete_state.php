<?php

class SJB_Admin_Classifieds_DeleteState extends SJB_Function
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
			$listingFieldID = SJB_StateManager::getStateInfoBySID($state_sid);
				SJB_StateManager::deleteStateBySID($state_sid);
			
		}
SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage_states/");
		echo 'The system  cannot proceed as Listing Field SID is not set';
	}
}

