<?php

class SJB_SearchResultsTP
{
    var $requested_data;
    var $listing_type_sid;
    var $listing_type_id;
    private $listingsLimit = 0;

    /**
     * SJB_ListingCriteriaSaver
     *
     * @var SJB_ListingCriteriaSaver
     */
    var $criteria_saver;
    var $found_listings_sids;
    var $listing_search_structure;
    var $searchId;
    var $relevance;
    var $useRefine = false;
    private $usePriority = false;

    public $pluginErrors = [];

    function _filter_data(&$array, $key, $pattern)
    {
        if (isset($array[$key])) {
            if (is_array($array[$key])) {
                foreach ($array[$key] as $itemNumber => $filter) {
                    if (!preg_match($pattern, $filter)) {
                        unset($array[$key][$itemNumber]);
                    }
                }
                if (!$array[$key]) {
                    unset($array[$key]);
                }

            } elseif (!preg_match($pattern, $array[$key])) {
                unset($array[$key]);
            }
        }
    }

    public function usePriority($usePriority)
    {
        $this->usePriority = $usePriority;
    }

    public function __construct($requested_data, $listing_type_id, $relevance = false, $useRefine = false)
    {
        $this->_filter_data($requested_data, 'sorting_field', '/^[_\w\d]+$/');
        $this->_filter_data($requested_data, 'sorting_order', '/(^DESC$)|(^ASC$)/i');
        $this->_filter_data($requested_data, 'default_sorting_field', '/^[_\w\d]+$/');
        $this->_filter_data($requested_data, 'default_sorting_order', '/(^DESC$)|(^ASC$)/i');

        $this->requested_data = $requested_data;
        $this->listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
        $this->listing_type_id = $listing_type_id;
        $this->relevance = $relevance;
        $this->useRefine = $useRefine;
        $this->searchId = microtime(true);
        if (isset($requested_data['searchId'])) {
            $this->searchId = strip_tags($requested_data['searchId']);
        }
        $this->criteria_saver = new SJB_ListingCriteriaSaver($this->searchId);
        $this->found_listings_sids = [];
    }

    function getChargedTemplateProcessor()
    {
        $order_info = $this->criteria_saver->getOrderInfo();

        if (isset($this->requested_data['sorting_field'], $this->requested_data['sorting_order'])) {
            $order_info = [
                'sorting_field' => $this->requested_data['sorting_field'],
                'sorting_order' => $this->requested_data['sorting_order']
            ];
        }
        if (!isset($order_info['sorting_field']) && !isset($order_info['sorting_order']) && SJB_Request::getVar('searchId', false)) {
            $this->requested_data['sorting_field'] = $order_info['sorting_field'] = !empty($this->requested_data['default_sorting_field']) ? $this->requested_data['default_sorting_field'] : null;
            $this->requested_data['sorting_order'] = $order_info['sorting_order'] = !empty($this->requested_data['default_sorting_order']) ? $this->requested_data['default_sorting_order'] : null;
        }
//var_dump($order_info);
        $this->criteria_saver->setSessionForOrderInfo($order_info);

        $this->requested_data['active']['equal'] = '1';
        $this->criteria_saver->setSessionForCriteria(array_merge(
            ['active' => ['equal' => '1']], // Duplicate for sql query optimization
            $this->criteria_saver->getCriteria(),
            $this->requested_data));

        $lpp = $this->criteria_saver->getListingsPerPage();
        if (!empty($this->requested_data['default_listings_per_page']) && empty($lpp))
		{
             if (intval($this->requested_data['default_listings_per_page'])>20)     
              $this->criteria_saver->setSessionForListingsPerPage(20);				 
				 else
		   $this->criteria_saver->setSessionForListingsPerPage(intval($this->requested_data['default_listings_per_page']));
		}
        if (isset($this->requested_data['listings_per_page']))
		{ 
	          if (intval($this->requested_data['listings_per_page'])>20)     
              $this->criteria_saver->setSessionForListingsPerPage(20);				 
				 else
            $this->criteria_saver->setSessionForListingsPerPage(intval($this->requested_data['listings_per_page']));
		}
        // Forcer le nombre par page à 20 par CHED
		
	//	$this->criteria_saver->setSessionForListingsPerPage(20);
        $this->criteria_saver->setSessionForCurrentPage(1);
        if (isset($this->requested_data['page']))
            $this->criteria_saver->setSessionForCurrentPage(intval($this->requested_data['page']));

        $this->found_listings_sids = $this->_getListingSidCollectionFromRequest();
        $this->listing_search_structure = $this->criteria_saver->createTemplateStructureForSearch();
        if ($this->affectedRows) {
            $this->listing_search_structure['listings_number'] = $this->affectedRows;
        }
        if (empty($this->listing_search_structure['sorting_field'])) {
            $this->listing_search_structure['sorting_field'] = 'activation_date';
        }
//var_dump($this->listing_search_structure);exit;
        $listings_structure = [];
        if ($this->listing_search_structure['listings_number'] > 0) {
            $currentUserSID = SJB_UserManager::getCurrentUserSID();
            $isUserLoggedIn = SJB_UserManager::isUserLoggedIn();
            $listings_structure = new SJB_Iterator;
            $listings_structure->setListingsSids($this->found_listings_sids);
            $listings_structure->setListingTypeSID($this->listing_type_sid);
            $listings_structure->setCriteria($this->criteria_saver->criteria);
            $listings_structure->setUserLoggedIn($isUserLoggedIn);
            $listings_structure->setCurrentUserSID($currentUserSID);
        }
		//------------- pagination en smarty ajouté par CHED
		if ($this->affectedRows) {
            $this->listing_search_structure['num_results'] = $this->affectedRows;
        }
          else
			  $this->listing_search_structure['num_results'] = 0;
		 
		
   		$this->listing_search_structure['total_pages'] = ceil($this->listing_search_structure['num_results'] / 20);
		
		 if (isset($this->requested_data['page']))
		 {
             
			$this->listing_search_structure['current_page'] = intval($this->requested_data['page']);
		 }
		 else
		 {
			$this->listing_search_structure['current_page'] = 1;
		 }
		 if($this->listing_search_structure['current_page']<16)
		 {
		        $this->listing_search_structure['first_page']=1;
				
					
		 }
		 else
		 {
			   $this->listing_search_structure['first_page']=$this->listing_search_structure['current_page']-15;
         }			 
		 
		 if($this->listing_search_structure['total_pages']>($this->listing_search_structure['current_page']+15))
				{
					$this->listing_search_structure['last_page']=$this->listing_search_structure['current_page']+15;
				}
				else
				{
					$this->listing_search_structure['last_page']=$this->listing_search_structure['total_pages'];
				}
		  //----------------------
		  //---- Ajouté par ched pour les Cv déja vu - acheté par un recruteur 
	
		  if($this->listing_type_id == 'Resume' )
		{  
              
			  if (SJB_UserManager::isUserLoggedIn()) 
			{
                $currentUser = SJB_UserManager::getCurrentUser();
               	$sql = "SELECT listing_id  FROM  user_listing WHERE user_id = ".$currentUser->getUserInfo()['sid'] ;
		      $res  = SJB_DB::query($sql);
			  $mescv=array();
			  foreach($res  as $resume)
			  {
				
				   $mescv[]=$resume["listing_id"];
				  	
			  }
			 $this->listing_search_structure['mescv']=$mescv;
		
			}
		     if (isset($this->requested_data['moncvtheque']))
			 {
				$this->listing_search_structure['moncvtheque']=1;
			 }
			 else
				 $this->listing_search_structure['moncvtheque']=0;
		}
		  //----------------------
        SJB_Event::dispatch('afterGenerateListingStructure', $listings_structure, true);
        return $this->_getChargedTemplateProcessor($listings_structure);
    }

    /**
     * use this function to create listings structure for plugin listings (Indeed etc.)
     * This will use for ajax request from search results page
     *
     * @param array $listingsStructure
     * @return SJB_TemplateProcessor
     */
    public function getChargedTemplateProcessorForListingStructure($listingsStructure = [])
    {
        return $this->_getChargedTemplateProcessor($listingsStructure);
    }

    function getListingCollectionStructure($sorted_found_listings_sids_for_current_page)
    {
        $listings_structure = [];
        foreach ($sorted_found_listings_sids_for_current_page as $sid) {
            $listing = SJB_ListingManager::getObjectBySID($sid);
            $listings_structure[$listing->getID()] = SJB_ListingManager::createTemplateStructureForListing($listing);
        }

        return $listings_structure;
    }

    function _normalizeCurrentPage()
    {
        if ($this->listing_search_structure['current_page'] < 1)
            $this->listing_search_structure['current_page'] = 1;
    }

    public function getLocationProperty($fieldName, $listing, $sortingField)
    {
        $property = $listing->getProperty($fieldName);
        if ($property && $fields = @$property->type->child) {
            $sortingFieldName = str_replace($fieldName . "_", '', $sortingField);
            $property = $fields->getProperty($sortingFieldName);
            $property->setID($sortingField);
        }
        return $property;
    }

    function _getChargedTemplateProcessor(&$listings_structure)
    {
        $tp = SJB_System::getTemplateProcessor();
        $searchCriteria = $this->criteria_saver->getCriteria();

        $tp->assign("sorting_field", $this->listing_search_structure['sorting_field']);
        $tp->assign("sorting_order", $this->listing_search_structure['sorting_order']);
        $tp->assign("listing_search", $this->listing_search_structure);
        $tp->assign("listings", $listings_structure);
        $tp->assign("searchId", $this->searchId);

        $listing = new SJB_Listing([], $this->listing_type_sid);
        $user = new SJB_User([]);
        $listing_structure_meta_data = SJB_ListingManager::createMetadataForListing($listing, $user);
//var_dump($searchCriteria);
        if (isset($searchCriteria['listing_type']['equal']) && SJB_System::getSettingByName('turn_on_refine_search_' . $searchCriteria['listing_type']['equal']) && $this->useRefine) {
            $tp->assign("refineSearch", true);
            $currentSearch = SJB_RefineSearch::getCurrentSearchByCriteria($searchCriteria);
            $tp->assign('currentSearch', $currentSearch);
        }
        $metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
        $metadata = ["listing" => $metaDataProvider->getMetaData($listing_structure_meta_data)];
        $tp->assign("METADATA", $metadata);

        return $tp;
    }

    function _getListingSidCollectionFromRequest()
    {
        $listing = new SJB_Listing([], $this->listing_type_sid);
        $id_alias_info = $listing->addIDProperty();
        $listing->addActivationDateProperty();
        $listing->addFeaturedProperty();
        $listing->addFeaturedLastShowedProperty();
        $username_alias_info = $listing->addUsernameProperty();
        $listing_type_id_info = $listing->addListingTypeIDProperty();
        $listing->addCompanyNameProperty();

        // select only accessible listings by user sid
        // see SearchCriterion.php, AccessibleCriterion class
        if ($this->listing_type_id == 'Resume')
            $this->requested_data['access_type'] = ['accessible' => SJB_UserManager::getCurrentUserSID()];

        $criteria = $this->criteria_saver->getCriteria();
        if (!empty($this->requested_data['PostedWithin']['multi_like'][0]) || !empty($criteria['PostedWithin']['multi_like'][0])) {
            $within_period = '';
            if (!empty($this->requested_data['PostedWithin']['multi_like'][0])) {
                $within_period = $this->requested_data['PostedWithin']['multi_like'][0];
                unset ($this->requested_data['PostedWithin']['multi_like']);
            }
            if (!empty($criteria['PostedWithin']['multi_like'][0])) {
                $within_period = $criteria['PostedWithin']['multi_like'][0];
                unset($criteria['PostedWithin']);
            }
            $i18n = SJB_I18N::getInstance();
            $this->requested_data['activation_date']['not_less'] = $i18n->getDate(date('Y-m-d', strtotime("- {$within_period} days")));
        }

        if (isset($this->requested_data['CompanyName']['multi_like_and'][0]) || isset($criteria['CompanyName']['multi_like_and'][0])) {
            if (isset($this->requested_data['CompanyName']['multi_like_and'][0])) {
                $companyName = $this->requested_data['CompanyName']['multi_like_and'][0];
                unset($this->requested_data['CompanyName']);
            }
            if (isset($criteria['CompanyName']['multi_like_and'][0])) {
                $companyName = $criteria['CompanyName']['multi_like_and'][0];
                unset($criteria['CompanyName']);
            }
            $userName = SJB_UserManager::getUserNameByCompanyName($companyName);

            if ($userName) {
                $this->requested_data['username']['equal'] = $userName;
            }
        }

        $criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData(array_merge($criteria, $this->requested_data), $listing);

        $aliases = new SJB_PropertyAliases();
        $aliases->addAlias($id_alias_info);
        $aliases->addAlias($username_alias_info);
        $aliases->addAlias($listing_type_id_info);

        $sortingFields = [];
        if ($this->usePriority) {
            $sortingFields['featured'] = 'DESC';
            $sortingFields['featured'] = 'DESC, RAND()';
        }
        $innerJoin = [];
        $orderInfo = $this->criteria_saver->getOrderInfo();
        $property = $listing->getProperty($orderInfo['sorting_field']);
        if (!empty($property) && $property->isSystem()) {
            $sortingFields[$orderInfo['sorting_field']] = $orderInfo['sorting_order'];
            $this->requested_data['sorting_field'] = $orderInfo['sorting_field'];
            $this->requested_data['sorting_order'] = $orderInfo['sorting_order'];
        } else {
            $sortingFields['activation_date'] = 'DESC';
            $this->requested_data['sorting_field'] = 'activation_date';
            $this->requested_data['sorting_order'] = 'DESC';
        }
        $searcher = new SJB_ListingSearcher();
  // modif par ched pour la pagination Smarty
  //---------------------
      //  if ($this->listingsLimit) {
       //     $searcher->setLimit($this->listingsLimit);
      //  } else {
            $searcher->setLimit(($this->criteria_saver->getCurrentPage() - 1) * $this->criteria_saver->getListingsPerPage() . ', ' . $this->criteria_saver->getListingsPerPage());
       // }

        $this->listing_search_structure['sorting_field'] = $this->requested_data['sorting_field'];
        $this->listing_search_structure['sorting_order'] = $this->requested_data['sorting_order'];
        $sids = $searcher->getObjectsSIDsByCriteria($criteria, $aliases, $sortingFields, $innerJoin, $this->relevance);
        $this->affectedRows = $searcher->getAffectedRows();
        $this->criteria_saver->setTotal($this->affectedRows);
        return $sids;
    }

    private $affectedRows;

    function _getEmptyListing()
    {
        $listing = new SJB_Listing([], $this->listing_type_sid);
        $listing->addIDProperty();
        $listing->addListingTypeIDProperty();
        $listing->addActivationDateProperty();
        $listing->addUsernameProperty();
        $listing->addCompanyNameProperty();
        $listing->addFeaturedProperty();
        $listing->addFeaturedLastShowedProperty();
        return $listing;
    }

    public function setLimit($listingsLimit)
    {
        $this->listingsLimit = $listingsLimit;
    }

    public function getListingCollectionStructureForMap(&$listings_structure)
    {
        $remove_keys = [];
        foreach ($listings_structure as $key => $listing_structure) {
            if (empty($listing_structure['Location']['ZipCode']) && empty($listing_structure['latitude']) && empty($listing_structure['longitude'])) {
                $remove_keys[] = $key;
            }
        }
        foreach ($remove_keys as $remove_key) {
            $listings_structure->offsetUnset($remove_key);
        }
        $listings_number = $listings_structure->count();
        $first = ($this->listing_search_structure['current_page'] - 1) * $this->listing_search_structure['listings_per_page'];
        $last = $this->listing_search_structure['listings_per_page'] * $this->listing_search_structure['current_page'] - 1;
        $remove_keys = [];
        $index = 0;
        foreach ($listings_structure as $key => $listing_structure) {
            if ($index < $first || $index > $last) {
                $remove_keys[] = $key;
            }
            $index++;
        }
        foreach ($remove_keys as $remove_key) {
            $listings_structure->offsetUnset($remove_key);
        }
        $this->listing_search_structure['listings_number'] = $listings_number;
        $this->listing_search_structure['pages_number'] = ceil($listings_number / $this->listing_search_structure['listings_per_page']);
    }

    /**
     * @return \SJB_ListingCriteriaSaver
     */
    public function getCriteriaSaver()
    {
        return $this->criteria_saver;
    }
}
