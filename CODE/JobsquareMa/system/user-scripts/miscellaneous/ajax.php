<?php

class SJB_Miscellaneous_Ajax extends SJB_Function
{
    public function execute()
    {
        if (preg_match('/googlebot|jobrapido|yandexbot/iu', SJB_Request::getUserAgent())) {
            exit();
        }

        $action = SJB_Request::getVar('action', null);

        // set for debug call via GET request
        if (empty($action)) {
            $action = SJB_Request::getVar('action', '');
        }

        switch ($action) {
            case 'request_for_listings':
                SJB_AjaxRequests::requestToListingsProviders();
                break;

            case 'get_refine_search_block':
                SJB_AjaxRequests::getRefineSearchBlock();
                break;

            default :
                exit();
        }
        exit();
    }
}

class SJB_AjaxRequests
{
    /**
     * Method gets request for listings to listings providers and dispatch individual events for providers plugins.
     * After dispatch will be created usual listings structure and than will be returned as JSON, marked to jQuery callback.
     *
     * @static
     * @return mixed
     */
    public static function requestToListingsProviders()
    {
        if (!SJB_Settings::getValue('enable_backfilling')) {
            return;
        }
        // get list of listing providers
        $listingProviders = [];
        SJB_Event::dispatch('registerListingProviders', $listingProviders, true);

        $_REQUEST['listing_type']['equal'] =
            $listing_type_id = 'Job';

        $searchResultsTP = new SJB_SearchResultsTP($_REQUEST, $listing_type_id);
        // manually create listing_search_structure (in main search for listings this called in getChargedTemplateProcessor)
        // This need to properly work of listings providers per page search
        $searchResultsTP->listing_search_structure = $searchResultsTP->criteria_saver->createTemplateStructureForSearch();

        // dispatch event to given listings providerName
        $listingsStructure = [];
        foreach ($listingProviders as $providerName) {
            try {
                SJB_Event::dispatch($providerName . 'BeforeGenerateListingStructure', $searchResultsTP, true);
            } catch (Exception $e) {
                error_log($e->getMessage() . ' ' . $e->getTraceAsString());
            }
            // fill listings structure with provider listings
            SJB_Event::dispatch($providerName . 'AfterGenerateListingStructure', $listingsStructure, true);
        }

        $tp = $searchResultsTP->getChargedTemplateProcessorForListingStructure($listingsStructure);

        $tp->display('../classifieds/search_results_jobs_listings.tpl');
    }

    public static function getRefineSearchBlock()
    {
//        ini_set('display_errors', 1);
//        ini_set('display_startup_errors', 1);
//        error_reporting(E_ALL);
       // set_time_limit(0);

        $tp = SJB_System::getTemplateProcessor();
        $listingTypeId = SJB_Request::getVar('listing_type');
        if (!isset($listingTypeId['equal'])) {
            $_REQUEST['listing_type']['equal'] = SJB_Session::getValue('listing_type_id');
        }


        $searchResultsTP = new SJB_SearchResultsTP($_REQUEST, $listingTypeId['equal']);

        $searchCriteria = $searchResultsTP->getCriteriaSaver()->getCriteria();
        if (SJB_Request::getVar('showRefineFields', false)) {
            $refineFields = SJB_RefineSearch::getRefineFieldsByCriteria($searchResultsTP, $searchCriteria);
            $tp->assign('refineFields', $refineFields);
        }
//        echo 'asdf';exit;
        $currentSearch = SJB_RefineSearch::getCurrentSearchByCriteria($searchCriteria);
        $tp->assign('currentSearch', $currentSearch);
        $tp->assign('searchId', SJB_Request::getVar('searchId'));
		$tp->assign('listing_type', SJB_Session::getValue('listing_type_id'));
        $tp->display('../classifieds/search_results_refine_block.tpl');
    }

}
