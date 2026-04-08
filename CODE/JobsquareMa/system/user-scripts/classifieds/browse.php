<?php

class SJB_Classifieds_Browse extends SJB_Function
{
    var $parameters = [];
    private $manager = null;
    private $uri = '';

    public function isAccessible()
    {
        $browseUrl = SJB_Request::getVar('browseUrl', false);
        if ($browseUrl) {
            $parameters = SJB_BrowseDBManager::getBrowseParametersByUri($browseUrl);
            $this->parameters = array_merge($_REQUEST, unserialize($parameters));
        } else {
            $this->parameters = $_REQUEST;
        }

        $listingTypeId = SJB_Request::getVar('listing_type_id', '');

        if (empty($this->parameters['passed_parameters_via_uri'])) {
            $this->parameters['passed_parameters_via_uri'] = '';
        }
        // Map region vanity URL slugs to actual state names
        $regionResolved = false;
        if (strpos($_SERVER['REQUEST_URI'], '/regions/') !== false && !empty($this->parameters['passed_parameters_via_uri'])) {
            $slug = trim($this->parameters['passed_parameters_via_uri'], '/');
            $stateName = SJB_DB::queryValue("SELECT name FROM states WHERE url LIKE ?s LIMIT 1", '%' . $slug . '%');
            if ($stateName) {
                $this->parameters['passed_parameters_via_uri'] = $stateName;
                $regionResolved = true;
            }
        }
        if (!$regionResolved) {
            $this->parameters['passed_parameters_via_uri'] = str_replace('jobs-in-', '', $this->parameters['passed_parameters_via_uri']);
            $this->parameters['passed_parameters_via_uri'] = str_replace('-', ' ', $this->parameters['passed_parameters_via_uri']);
        }
        $uri = str_replace('jobs-in-', '', $_SERVER['REQUEST_URI']);
        $uri = parse_url(str_replace('-', ' ', $uri));
        if (!preg_match("/\\/$/", $uri['path'])) {
            $uri = parse_url($_SERVER['REQUEST_URI']);
            $query = isset($uri['query']) ? '?' . $uri['query'] : '';
            SJB_HelperFunctions::redirect($uri['path'] . '/' . $query);
        } else {
            $uri = SJB_Request::getVar('browseUrl', $this->getUri());
        }
        $this->uri = $uri;
        $this->manager = SJB_ObjectMother::createBrowseManager($listingTypeId, $this->parameters);
        if (!$this->manager->getParams()) {
            return true;
        }
        return parent::isAccessible();
    }

    public function execute()
    {
        $listingTypeId = SJB_Request::getVar('listing_type_id', '');
        $browseItems = [];
        if ($this->manager->canBrowse()) {
            $browseItems = $this->manager->getItemsFromDB($this->uri, true);
        }
        $tp = $this->getTemplateProcessor($listingTypeId);

        // if we did't find anything then try to math browse and url (for cities with dashes)
		// modifier par CHED le 21-08-2023 pour passer a PHP 8.2
		// if (!$this->manager->canBrowse() && !$tp->getVariable('listings')->value) {
        if (!$this->manager->canBrowse() ) {
            $browseItems = $this->manager->getItemsFromDB($this->uri, false);
            $rawUrl = rawurldecode($_REQUEST['passed_parameters_via_uri']);
            foreach (array_keys($browseItems) as $item) {
                $url = SJB_TemplateProcessor::pretty_url($item, false);
                if (strpos($rawUrl, $url) !== false) {
                    $this->parameters['passed_parameters_via_uri'] = mb_strtolower($url);
                    $this->manager = SJB_ObjectMother::createBrowseManager($listingTypeId, $this->parameters);
                    $tp = $this->getTemplateProcessor($listingTypeId);
                    break;
                }
            }
        }
        $tp->assign('browseItems', $browseItems);
        $tp->assign('recordsNumToDisplay', SJB_Array::get($this->params, 'recordsNumToDisplay', 45));
        $tp->assign('user_page_uri', $this->uri);
        $tp->assign('sitePageUri', SJB_HelperFunctions::getSiteUrl() . $this->getUri());
        $tp->assign('browse_level', $this->manager->getLevel() + 1);
        $tp->assign('browse_navigation_elements', $this->manager->getNavigationElements($this->uri));
        $tp->assign('browse_request_data', $this->manager->getRequestDataForSearchResults());
        $tp->display(SJB_Request::getVar('browse_template', 'browse_items_and_results.tpl'));
    }

    protected function getUri()
    {
        $globalTemplateVariables = SJB_System::getGlobalTemplateVariables();
        $uri = $globalTemplateVariables['GLOBALS']['user_page_uri'];
        return preg_match("/\\/$/", $uri) ? $uri : $uri . '/';
    }

    /**
     * @param $listingTypeId
     * @return SJB_TemplateProcessor
     */
    protected function getTemplateProcessor($listingTypeId)
    {
        if ($this->manager->canBrowse()) {
            $browsing_meta_data = $this->manager->getBrowsingMetaData();
            $tp = SJB_System::getTemplateProcessor();
            $tp->assign('METADATA', $browsing_meta_data);
        } else {
            $requestData = $this->manager->getRequestDataForSearchResults();
            $requestData['default_listings_per_page'] = SJB_Array::get($this->params, 'recordsNumToDisplay', 45);
            $requestData['default_sorting_field'] = SJB_Request::getVar('sorting_field', 'activation_date');
            $requestData['default_sorting_order'] = SJB_Request::getVar('sorting_order', 'DESC');
            if (isset($_REQUEST['restore'])) {
                $requestData['restore'] = 1;
            } else {
                $requestData['action'] = 'search';
            }
            if (isset($_REQUEST['searchId'])) {
                $requestData['searchId'] = SJB_Request::getVar('searchId');
            }
            $requestData['listings_per_page'] = SJB_Request::getVar('listings_per_page', $requestData['default_listings_per_page']);
            $requestData['page'] = SJB_Request::getInt('page', 1);
            if (!$requestData['page']) {
                $requestData['page'] = 1;
            }

            $searchResultsTP = new SJB_SearchResultsTP($requestData, $listingTypeId, false);
            $searchResultsTP->usePriority(true);
            $tp = $searchResultsTP->getChargedTemplateProcessor();
            $tp->assign('errors', $searchResultsTP->pluginErrors);
            $tp->assign('listing_type', $listingTypeId);
        }
        $tp->assign('columns', SJB_Request::getVar('columns', 1));
        return $tp;
    }
}
