<?php

class SJB_Classifieds_MyListings extends SJB_Function
{
    protected $listingTypeID = null;
    protected $listingTypeSID = null;
    protected $requestCriteria = [];

    public function execute()
    {
        if (!function_exists('_filter_data')) {
            function _filter_data(&$array, $key, $pattern)
            {
                if (isset($array[$key])) {
                    if (!preg_match($pattern, $array[$key]))
                        unset($array[$key]);
                }
            }
        }

        _filter_data($_REQUEST, 'sorting_field', "/^[_\\w\\d]+$/");
        _filter_data($_REQUEST, 'sorting_order', "/(^DESC$)|(^ASC$)/i");
        _filter_data($_REQUEST, 'default_sorting_field', "/^[_\\w\\d]+$/");
        _filter_data($_REQUEST, 'default_sorting_order', "/(^DESC$)|(^ASC$)/i");

        $tp = SJB_System::getTemplateProcessor();
        if (!SJB_UserManager::isUserLoggedIn()) {
            $errors['NOT_LOGGED_IN'] = true;
            $tp->assign("ERRORS", $errors);
            $tp->display("error.tpl");
            return;
        }

        $this->defineRequestedListingTypeID();
        $currentUser = SJB_UserManager::getCurrentUser();

        if (!$this->listingTypeID) {
            SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/my-listings/' . ($currentUser->getUserGroupSID() == SJB_UserGroup::EMPLOYER ? 'job' : 'resume') . '/');
        }

        $this->listingTypeSID = SJB_ListingTypeManager::getListingTypeSIDByID($this->listingTypeID);

        $this->requestCriteria = [
            'user_sid' => ['equal' => $currentUser->getSID()],
            'listing_type_sid' => ['equal' => $this->listingTypeSID]
        ];

        $acl = SJB_Acl::getInstance();

        SJB_ListingManager::deletePreviewListingsByUserSID($currentUser->getSID());

        $searcher = new SJB_ListingSearcher();

        // to save criteria in the session different from search_results
        $criteriaSaver = new SJB_ListingCriteriaSaver('MyListings');

        if (isset($_REQUEST['restore'])) {
            $_REQUEST = array_merge($_REQUEST, $criteriaSaver->getCriteria());
        }

        if (isset($_REQUEST['listings'])) {
            $listingsSIDs = $_REQUEST['listings'];
            $userListingsSIDs = array_flip(
                SJB_ListingDBManager::getListingsSIDByUserSID($currentUser->getSID())
            );
            $listingsSIDs = array_intersect_key($listingsSIDs, $userListingsSIDs);
        }

        if (!empty($listingsSIDs)) {
            if (SJB_Request::getVar('action')) {
                $this->executeAction($listingsSIDs, SJB_Request::getVar('action'));
            }
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/my-listings/" . mb_strtolower($this->listingTypeID) . '/');
        }

        $listing = new SJB_Listing([], $this->listingTypeSID);
        $idAliasInfo = $listing->addIDProperty();
        $listing->addKeywordsProperty();
        $listing->addActiveProperty();
        $listing->addNumberOfViewsProperty();
        if (!$listing->getProperty('expiration_date')) {
            $listing->addExpirationDateProperty();
        }
        $listingTypeIdAliasInfo = $listing->addListingTypeIDProperty();

        $sortingFields = [];
        $innerJoin = [];
        $sortingField = SJB_Request::getVar("sorting_field", null);
        $sortingOrder = SJB_Request::getVar("sorting_order", null);
        if (isset($sortingField, $sortingOrder)) {
            $orderInfo = [
                'sorting_field' => $sortingField,
                'sorting_order' => $sortingOrder
            ];
        } else {
            $orderInfo = $criteriaSaver->getOrderInfo();
            $sortingField = isset($orderInfo['sorting_field']) ? $orderInfo['sorting_field'] : null;
        }

        if ($orderInfo['sorting_field'] == 'id') {
            $sortingFields['sid'] = $orderInfo['sorting_order'];
        } else {
            $property = $listing->getProperty($sortingField);
            if (!empty($property) && $property->isSystem()) {
                $sortingFields[$orderInfo['sorting_field']] = $orderInfo['sorting_order'];
            } else {
                $sortingFields['activation_date'] = 'DESC';
            }
        }

        $this->requestCriteria['sorting_field'] = $orderInfo['sorting_field'];
        $this->requestCriteria['sorting_order'] = $orderInfo['sorting_order'];

        $criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData(array_merge($_REQUEST, $this->requestCriteria), $listing);
        $aliases = new SJB_PropertyAliases();
        $aliases->addAlias($idAliasInfo);
        $aliases->addAlias($listingTypeIdAliasInfo);

        // получим информацию о имеющихся листингах
        $listingsInfo = [];
        $contractInfo['extra_info']['listing_amount'] = 0;

        if ($acl->isAllowed('post_' . $this->listingTypeID)) {
            $permissionParam = $acl->getPermissionParams('post_' . $this->listingTypeID);
            if (empty($permissionParam)) {
                $contractInfo['extra_info']['listing_amount'] = 'unlimited';
            } else {
                $contractInfo['extra_info']['listing_amount'] = $permissionParam;
            }
        }
        $contractsSIDs = $currentUser->getContractID();
        $listingsInfo['listingsNum'] = SJB_ContractManager::getListingsNumberByContractSIDsListingType($contractsSIDs, $this->listingTypeID);
        $listingsInfo['listingsMax'] = $contractInfo['extra_info']['listing_amount'];
        if ($listingsInfo['listingsMax'] === 'unlimited') {
            $listingsInfo['listingsLeft'] = 'unlimited';
        } else {
            $listingsInfo['listingsLeft'] = $listingsInfo['listingsMax'] - $listingsInfo['listingsNum'];
            $listingsInfo['listingsLeft'] = $listingsInfo['listingsLeft'] < 0 ? 0 : $listingsInfo['listingsLeft'];
        }

        $tp->assign('listingTypeID', $this->listingTypeID);
        $tp->assign('listingTypeName', SJB_ListingTypeManager::getListingTypeNameBySID($this->listingTypeSID));
        $tp->assign('listingsInfo', $listingsInfo);

        $page = SJB_Request::getVar('page', 1);
        $criteriaSaver->setSessionForListingsPerPage(10);
        $criteriaSaver->setSessionForCurrentPage($page);
        $criteriaSaver->setSessionForCriteria($_REQUEST);
        $criteriaSaver->setSessionForOrderInfo($orderInfo);

        // get Applications
        $appsGroups = SJB_Applications::getAppGroupsByEmployer($currentUser->getSID());
        $apps = [];
        foreach ($appsGroups as $group) {
            $apps[$group['listing_id']] = $group['count'];
        }

        /************* S T R U C T U R E **************/
        $listingsStructure = [];
        $listingStructureMetaData = [];
        $searcher->setLimit(($page - 1) * $criteriaSaver->getListingsPerPage() . ', ' . $criteriaSaver->getListingsPerPage());
        $foundListingsSIDs = $searcher->getObjectsSIDsByCriteria($criteria, $aliases, $sortingFields, $innerJoin);
        $criteriaSaver->setTotal($searcher->getAffectedRows());
        $listingSearchStructure = $criteriaSaver->createTemplateStructureForSearch();
        foreach ($foundListingsSIDs as $sid) {
            $listing = SJB_ListingManager::getObjectBySID($sid);
            $listingStructure = SJB_ListingManager::createTemplateStructureForListing($listing);
            $listingsStructure[$listing->getID()] = $listingStructure;

            if (isset($listingStructure['METADATA'])) {
                $listingStructureMetaData = array_merge($listingStructureMetaData, $listingStructure['METADATA']);
            }
        }

        /*************** D I S P L A Y ****************/
        $metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
        $metadata = [];
        $metadata['listing'] = $metaDataProvider->getMetaData($listingStructureMetaData);
		foreach($listingsStructure as &$listing_item)
		{
		$date_activation=$listing_item["activation_date"];
		if($currentUser->getUserGroupSID() == SJB_UserGroup::EMPLOYER)
		{
		$order_annonce=SJB_DB::queryValue("SELECT count(`sid`) FROM `listings` WHERE `activation_date` >'".$date_activation."'  and  listing_type_sid=6 and active=1");
		$listing_item["page_annonce"]=ceil($order_annonce/20);
		}
		}
        $tp->assign('METADATA', $metadata);
        $tp->assign('sorting_field', $listingSearchStructure['sorting_field']);
        $tp->assign('sorting_order', $listingSearchStructure['sorting_order']);
        $tp->assign('property', $this->getSortableProperties());
        $tp->assign('listing_search', $listingSearchStructure);
        $tp->assign('listings', $listingsStructure);
		$tp->assign('update_date', $listing->getUpdateDate());
		$tp->assign('update_date_3month', strtotime($listing->getUpdateDate()));
		$tp->assign('today_date_3month', strtotime('-3 month'));
		
        $tp->assign('apps', $apps);
        if ($currentUser->user_group_sid != '36') {
//            $tp->assign('my_products', SJB_ContractManager::getExtendedContractsInfoByUserSID($currentUser->getSID(), $this->acl));
            $my_products = SJB_ContractManager::getExtendedContractsInfoByUserSID($currentUser->getSID(), $this->acl);
            foreach ($my_products as $key => $my_product) {
                if ($my_product['price'] == 0) {
                    unset($my_products[$key]);
                }
            }
            $tp->assign('my_products', $my_products);
        }
        if ($currentUser->user_group_sid == '36') {
		
            $photoUrl = false;
            $percentage = 0;
            foreach ($listingsStructure as $listingInfoForPercentage) {
                $photoUrl = $listingInfoForPercentage['Photo']['file_url'];
                $percentage = SJB_ListingManager::getListingPercentage($listingInfoForPercentage['id']);
                $listingIDforPDF = $listingInfoForPercentage['id'];
            }
            $tp->assign('photoUrl', $photoUrl);
            $tp->assign('listingIDforPDF', $listingIDforPDF);
            $tp->assign('percentage', $percentage);
        }
		
		   if ($currentUser->user_group_sid == '36') {
		   $user_group_sid=$currentUser->user_group_sid;

				if(count($listingsStructure)>0)
				{
				  $tp->display('my_listings.tpl');
				}
				else{
			$my_products = SJB_ContractManager::getExtendedContractsInfoByUserSID($currentUser->getSID(), $this->acl);

				if(count($my_products) > 0){
				// User has contracts - check if any have listings left
				$nolistingsLeft = true;
				foreach($my_products as $product)
				{
					if(!empty($product['listingAmount']))
					{
						foreach($product['listingAmount'] as $listingAmount)
						{
							if($listingAmount["listingsLeft"]>0)
								$nolistingsLeft=false;
							else if($listingAmount["listingsLeft"]<=0)
							{
								SJB_ContractManager::deleteContract($product['id']);
							}
						}
					}
					else
					{
						// Contract exists but has no listingAmount (missing ACL permissions)
						// Do not treat as exhausted - keep the contract
						$nolistingsLeft=false;
					}
				}

				if($nolistingsLeft==true)
				{
					// All contracts exhausted - create a new default one
					$defaultProduct = SJB_UserGroupManager::getDefaultProduct($user_group_sid);
					$availableProductIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($user_group_sid);
					if ($defaultProduct && in_array($defaultProduct, $availableProductIDs)) {
						$contract = new SJB_Contract(['product_sid' => $defaultProduct]);
						$contract->setUserSID($currentUser->getSID());
						$contract->saveInDB();
						if ($contract->isFeaturedProfile()) {
							SJB_UserManager::makeFeaturedBySID($currentUser->getSID());
						}
					}
				}
				}
				else
				{
				// No contracts at all - create default one
				$defaultProduct = SJB_UserGroupManager::getDefaultProduct($user_group_sid);
				$availableProductIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($user_group_sid);
				if ($defaultProduct && in_array($defaultProduct, $availableProductIDs)) {
					$contract = new SJB_Contract(['product_sid' => $defaultProduct]);
					$contract->setUserSID($currentUser->getSID());
					$contract->saveInDB();
					if ($contract->isFeaturedProfile()) {
						SJB_UserManager::makeFeaturedBySID($currentUser->getSID());
					}
				}
				}

                    SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/add-listing/?listing_type_id=Resume');
                }
				}
		else
        $tp->display('my_listings.tpl');
    }

    /**
     * @param array $listingsIds Used listing sids
     * @param string $action Actions performed with the listings(delete, deactivate, activate)
     */
    private function executeAction(array $listingsIds, $action)
    {
        if (empty($listingsIds)) {
            return;
        }

        $listingsIds = array_flip($listingsIds);

        switch ($action) {
            case 'delete':
                SJB_ListingManager::deleteListingBySID($listingsIds);
                return;
            case 'deactivate':
                SJB_ListingManager::deactivateListingBySID($listingsIds);
                return;
        }
    }

    protected function defineRequestedListingTypeID()
    {
        if (isset($_REQUEST['passed_parameters_via_uri'])) {
            $params = SJB_FixedUrlParamProvider::getParams($_REQUEST);
            if ($params) {
                $this->listingTypeID = array_pop($params);
            }
        } else {
            $this->listingTypeID = SJB_Request::getVar('listing_type_id');
        }
    }

    /**
     * Returns sortable properties by listing
     * @return array
     */
    private function getSortableProperties()
    {
        $emptyListing = new SJB_Listing([], $this->listingTypeSID);
        $emptyListing->addIDProperty();
        $emptyListing->addListingTypeIDProperty();
        $emptyListing->addActivationDateProperty();
        $emptyListing->addNumberOfViewsProperty();
        $emptyListing->addApplicationsProperty();
        $emptyListing->addActiveProperty();
        $emptyListing->addExpirationDateProperty(null);

        $sortableProperties = [];
        $propertyList = $emptyListing->getPropertyList();

        foreach ($propertyList as $property) {
            $sortableProperties[$property]['is_sortable'] = true;
        }
        return $sortableProperties;
    }
}
