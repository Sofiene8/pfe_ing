<?php

class SJB_Classifieds_FeaturedListings extends SJB_Function
{
    public function execute()
    {
        $template = SJB_Request::getVar('template', 'featured_listings.tpl');
        $listingType = SJB_Request::getVar('listing_type', 'Job');
         $group_banner = SJB_Request::getVar("group_banner", false);
       $bannersObj = new SJB_Banners();
		$bannersIDs = $bannersObj->getActiveBannerIdByGroupID($group_banner);
			
        $searches['data']['listing_type']['equal'] = $listingType;
        $searches['data']['featured']['equal'] = 1;
        $searches['data']['default_listings_per_page'] = SJB_Request::getVar('items_count', 1);
        $searches['data']['sorting_field'] = 'featured_last_showed';
        $searches['data']['default_sorting_field'] = 'featured_last_showed';
        $searches['data']['default_sorting_order'] = 'ASC';
        $searches['data']['sorting_order'] = 'ASC';
 
        // фичерные листинги кешировать не будем
        $cache = SJB_Cache::getInstance();
        $caching = $cache->getOption('caching');
        $cache->setOption('caching', false);

        $searchResultsTP = new SJB_SearchResultsTP($searches['data'], $listingType);
        $searchResultsTP->setLimit(SJB_Request::getVar('items_count', 1));
        $tp = $searchResultsTP->getChargedTemplateProcessor();

        $featuredListingSIDs = $searchResultsTP->found_listings_sids;
        if ($featuredListingSIDs) {
            SJB_DB::query('UPDATE `listings` SET `featured_last_showed` = ?s WHERE `sid` in (?w)', SJB_DateType::mysqlNow(), implode(',', $featuredListingSIDs));
        }
        $cache->setOption('caching', $caching);
        $tp->assign('listing_type', $listingType);
		$tp->assign('group_banner', $group_banner);
        $tp->assign('isbanner', $bannersIDs?1:0);
        $tp->display($template);
    }
}
