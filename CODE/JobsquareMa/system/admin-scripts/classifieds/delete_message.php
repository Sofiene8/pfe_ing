<?php

class SJB_Admin_Classifieds_DeleteMessage extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }
	
	public function execute()
	{
		$message_sid = SJB_Request::getVar('sid', null);

		if (!is_null($message_sid)) {
			$listingFieldID = SJB_MessageManager::getMessageInfoBySID($message_sid);
				SJB_MessageManager::deleteMessageBySID($message_sid);
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage_messages/");
		}

		echo 'The system  cannot proceed as Listing Field SID is not set';
	}
}

