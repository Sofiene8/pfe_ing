<?php
//classe ajouté pour les annonces de la page detail empploi
class SJB_Classifieds_ListingsUserProfile extends SJB_Function
{
    public function execute()
    {
       
	   $template = SJB_Request::getVar('template', 'listings_user_profile.tpl');
        $listingType = SJB_Request::getVar('listing_type', 'Job');
		$listingID = SJB_Request::getVar('listing_id', false);
		$tab=array();
		$tab['listing_type']['equal'] = $listingType;
		//$searches['data']['featured']['equal'] = 1;
        $tab['default_listings_per_page'] = SJB_Request::getVar('items_count', 1);
        $tab['sorting_field'] = 'activation_date';
        $tab['default_sorting_field'] = 'activation_date';
        $tab['default_sorting_order'] = 'ASC';
        $tab['sorting_order'] = 'DESC';
		
			if (is_numeric($listingID)) {
               
			   $listing = SJB_ListingManager::getObjectBySID($listingID);
			    $listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
				}
				
				 if (is_numeric($listingID)) {
			    Foreach ($listing_structure['JobCategory'] as $key => $JobCategory)
				{
			        $tab['JobCategory']['equal'] = $key;
				
				  break;
				}
				$tab['Title']['like'] = $listing_structure['Title'];				
			 
				/* Foreach ($listing_structure['id_Job_Langue'] as $key => $id_Job_Langue)
				{
			        $searches['data']['id_Job_Langue']['equal'] = $key;
				
				  break;
				}
				*/
				
			//	$tab['Experience']['like'] =$listing_structure['Experience'];
				
			//	$searches['data']['id_Job_MotsCls']['like'] = $listing_structure['Title'];
				$tab['City']['like'] = $listing_structure['City'];
				$tab['State']['like'] = $listing_structure['State'];
				$tab['JobDescription']['like'] = $listing_structure['Title'];
				/*Foreach ($listing_structure['EmploymentType'] as $key => $EmploymentType)
				{
			        $tab['EmploymentType']['equal'] = $key;
				
				  break;
				}*/
				$tab['Experience']['like'] =$listing_structure['Experience'];
	    }

		$searches['data']=$tab;

        // фичерные листинги кешировать не будем
        $cache = SJB_Cache::getInstance();
        $caching = $cache->getOption('caching');
        $cache->setOption('caching', false);

        $searchResultsTP = new SJB_SearchResultsTP($searches['data'], $listingType);
        $searchResultsTP->setLimit(SJB_Request::getVar('items_count', 1));
        $tp = $searchResultsTP->getChargedTemplateProcessor();

        $featuredListingSIDs = $searchResultsTP->found_listings_sids;

	
		//echo count($featuredListingSIDs);exit;

	/*$count=count($tab);
	
	while(count($featuredListingSIDs)<3&&$count>7)
		{
		
		$searches['data']=array();
		end($tab);
		$key=key($tab);
		
		if($count>7)
		{
		unset($tab[$key]);
		$count--;
		$searches['data']=$tab;
		}
		
		
		$searchResultsTP = new SJB_SearchResultsTP($searches['data'], $listingType);
        $searchResultsTP->setLimit(SJB_Request::getVar('items_count', 1));
        $tp = $searchResultsTP->getChargedTemplateProcessor();

        $featuredListingSIDs = $searchResultsTP->found_listings_sids;
		}*/
		//var_dump($searches['data']);exit;
        /*if ($featuredListingSIDs) {
            SJB_DB::query('UPDATE `listings` SET `featured_last_showed` = ?s WHERE `sid` in (?w)', SJB_DateType::mysqlNow(), implode(',', $featuredListingSIDs));
        }*/
        $cache->setOption('caching', $caching);
        $tp->assign('listing_type', $listingType);
		  $tp->assign('category', $category);
	     $tp->display($template);
    }
}
