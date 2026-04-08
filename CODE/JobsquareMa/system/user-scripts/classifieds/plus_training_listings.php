<?php
//classe ajouté pour les annonces de la page detail empploi
class SJB_Classifieds_PlusTrainingListings extends SJB_Function
{
    public function execute()
    {
       
	   $template = SJB_Request::getVar('template', 'plus_training_listings.tpl');
        $listingType = SJB_Request::getVar('listing_type', 'Training');
		$listingID = SJB_Request::getVar('listing_id', false);
         
			
        $searches['data']['listing_type']['equal'] = $listingType;
       // $searches['data']['featured']['equal'] = 1;
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
		     
		
        $tp->display($template);
    }
}
