<?php

class SJB_Admin_Classifieds_ListingActions extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_JOB_BOARD);
        return parent::isAccessible();
    }

	public function execute()
	{
		$restore = 'restore=';

		if (isset($_REQUEST['action_name'], $_REQUEST['listings'])) {
			$listings_ids = $_REQUEST['listings'];

			switch (strtolower($_REQUEST['action_name'])) {
				case 'activate':
                    SJB_ListingManager::activateListingBySID(array_keys($listings_ids));
					break;

				case 'deactivate':
					$this->executeAction($listings_ids, 'deactivate');
					break;

				case 'delete':
					$this->executeAction($listings_ids, 'delete');
					break;

				default:
					$restore = '';
					break;
			}
		}
		$listingTypeId = SJB_Request::getVar('listingTypeId', null);
        $listingType = $listingTypeId !='Job' && $listingTypeId !='Resume' ? $listingTypeId . 's' : $listingTypeId . 's';
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/manage-' . strtolower($listingType) . '/?action=search&' . $restore);
	}

	/**
	 * @param array  $listingsIds Used listing sids
	 * @param string $action      Actions performed with the listings(delete, deactivate)
	 */
	protected function executeAction(array $listingsIds, $action)
	{
		if (empty($listingsIds)) {
			return;
		}

		$processListingsIds = array();
		foreach ($listingsIds as $key => $value) {
			$processListingsIds[] = $key;
		}
		
		switch($action) {
			case 'delete':
				SJB_ListingManager::deleteListingBySID($processListingsIds);
				return;
			case 'deactivate':
				SJB_ListingManager::deactivateListingBySID($processListingsIds);
				return;
		}
	}
}
