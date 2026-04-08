<?php

class SJB_Classifieds_FeaturedListingsHome extends SJB_Function
{
    public function execute()
    {
        $template = SJB_Request::getVar('template', 'featured_listings_home.tpl');
        $listingType = SJB_Request::getVar('listing_type', 'Job');
     /*
	  // modifier par Ched le 27-02-2024
	 $group_banner = SJB_Request::getVar("group_banner", false);
       $bannersObj = new SJB_Banners();
	  
		$bannersIDs = $bannersObj->getActiveBannerIdByGroupID($group_banner);
		 */	
        $searches['data']['listing_type']['equal'] = $listingType;
        $searches['data']['featured']['equal'] = 1;
        $searches['data']['default_listings_per_page'] = SJB_Request::getVar('items_count', 1);
        $searches['data']['sorting_field'] = 'featured_last_showed';
        $searches['data']['default_sorting_field'] = 'featured_last_showed';
        $searches['data']['default_sorting_order'] = 'ASC';
        $searches['data']['sorting_order'] = 'ASC';
 
        $cache = SJB_Cache::getInstance();

        $searchResultsTP = new SJB_SearchResultsTP($searches['data'], $listingType);
        $searchResultsTP->setLimit(SJB_Request::getVar('items_count', 1));
        $tp = $searchResultsTP->getChargedTemplateProcessor();

        // Update featured_last_showed at most once every 5 minutes via cache flag
        $featuredListingSIDs = $searchResultsTP->found_listings_sids;
        if ($featuredListingSIDs) {
            $cacheKey = 'featured_showed_' . md5(implode(',', $featuredListingSIDs));
            if (!$cache->load($cacheKey)) {
                SJB_DB::query('UPDATE `listings` SET `featured_last_showed` = ?s WHERE `sid` in (?w)', SJB_DateType::mysqlNow(), implode(',', $featuredListingSIDs));
                $cache->save(true, $cacheKey, array(), 300);
            }
        }
        $tp->assign('listing_type', $listingType);
		$tp->assign('group_banner', $group_banner);
      //  $tp->assign('isbanner', $bannersIDs?1:0);
		  $tp->assign('isbanner', 0);
        $tp->display($template);
    }
}
