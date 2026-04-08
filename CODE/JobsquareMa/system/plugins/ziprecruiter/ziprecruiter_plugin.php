<?php

class ZiprecruiterPlugin extends SJB_PluginAbstract
{
    public static $ziprecruiterListings = [];

    private static $countries = [
        'us' => [
            'caption' => 'United States',
            'domain' => 'www.ziprecruiter.com',
        ],
        'uk' => [
            'caption' => 'United Kingdom',
            'domain' => 'www.ziprecruiter.co.uk',
        ],
    ];

    function pluginSettings()
    {
        $countryList = [];
        foreach (self::$countries as $id => $country) {
            $countryList[] = [
                'id' => $id,
                'caption' => $country['caption']
            ];
        }
        return [
            [
                'id' => 'ZiprecruiterApiKey',
                'caption' => 'Api Key',
                'type' => 'string',
                'comment' => 'Please contact ZipRecruiter at <a href="mailto:steve@ziprecruiter.com">steve@ziprecruiter.com</a> to get your own API key.',
                'length' => '50',
                'order' => null,
                'class' => 'input__small',
            ],
            [
                'caption' => 'Default Filtering Parameters',
                'type' => 'panel_separator',
            ],
            [
                'id' => 'ZiprecruiterKeywords',
                'caption' => 'Keyword Query',
                'type' => 'string',
                'comment' => 'Search query to filter your backfill jobs. You can enter keywords, job categories or roles.',
                'length' => '50',
                'order' => null,
            ],
            [
                'id' => 'ZiprecruiterCountry',
                'caption' => 'Country',
                'type' => 'list',
                'list_values' => $countryList,
                'comment' => 'Search within country specified',
                'length' => '50',
                'order' => null,
                'required' => true,
            ],
            [
                'id' => 'ZiprecruiterLocation',
                'caption' => 'Location',
                'type' => 'string',
                'comment' => 'Limits your backfill jobs to a specific location. Use a "city, state" combination for United States and "city, UK" for United Kingdom.',
                'length' => '50',
                'order' => null,
            ],
            [
                'id' => 'ZiprecruiterRadius',
                'caption' => 'Radius',
                'type' => 'list',
                'list_values' => [
                    [
                        'id' => '10',
                        'caption' => '10',
                    ],
                    [
                        'id' => '20',
                        'caption' => '20'
                    ],
                    [
                        'id' => '50',
                        'caption' => '50'
                    ],
                    [
                        'id' => '100',
                        'caption' => '100'
                    ],
                    [
                        'id' => '200',
                        'caption' => '200'
                    ],
                ],
                'comment' => 'Distance from search location. Default is 50.',
                'length' => '50',
                'required' => true,
                'order' => null,
            ],
        ];
    }

    /**
     * Register this plugin as listings provider for ajax requests
     *
     * @static
     * @param array $arrayOfProviders
     * @return array
     */
    public static function registerAsListingsProvider($arrayOfProviders = [])
    {
        $arrayOfProviders[] = 'ziprecruiter';
        return $arrayOfProviders;
    }

    /**
     * @param SJB_SearchResultsTP $params
     * @return mixed
     * @throws Exception
     */
    public static function getListingsFromZiprecruiter($params)
    {
        $listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($params->listing_type_sid);
        if ($listingTypeID == 'Job' && $GLOBALS['uri'] == '/jobs/' || $GLOBALS['uri'] == '/ajax/') {
            $page = intval(SJB_Request::getVar('page', $params->listing_search_structure['current_page']));

            $limit = $params->getCriteriaSaver()->getListingsPerPage();
            if (!$limit) {
                $limit = 10;
            }

            // SET PARAMS FOR REQUEST
            $keywords = SJB_Settings::getValue('ZiprecruiterKeywords');
            $criteria = $params->criteria_saver->criteria;
            $fieldSID = SJB_ListingFieldManager::getListingFieldSIDByID('JobCategory');
            $fieldInfo = SJB_ListingFieldDBManager::getListValuesBySID($fieldSID);
            $fieldList = [];
            foreach ($fieldInfo as $val) {
                $fieldList[$val['id']] = $val['caption'];
            }

            $categoryCriteria = isset($criteria['JobCategory']['multi_like']) ? $criteria['JobCategory']['multi_like'] : '';

            if (!empty($categoryCriteria)) {
                $categoryKeywords = [];
                foreach ($categoryCriteria as $category) {
                    if (!empty($category) && !empty($fieldList[$category])) {
                        $categoryKeywords[] = $fieldList[$category];
                    }
                }
                if ($categoryKeywords) {
                    $keywords .= ' ' . join(' ', $categoryKeywords);
                }
            }
            foreach ($criteria as $fieldName => $field) {
                if (is_array($field)) {
                    foreach ($field as $fieldType => $values) {
                        if ($fieldType === 'multi_like_and') {
                            foreach ($values as $val) {
                                $keywords .= ' ' . $val;
                            }
                        }
                    }
                }
            }
            if (isset($criteria['keywords']) && !empty($criteria['keywords'])) {
                foreach ($criteria['keywords'] as $key => $item) {
                    if ($key == 'all_words') {
                        $keywords .= ' ' . $item;
                    }
                }
            }
            $keywords = trim($keywords);

            $location = SJB_Settings::getValue('ZiprecruiterLocation');
            $country = SJB_Settings::getValue('ZiprecruiterCountry', 'us');
            $radius = SJB_Settings::getValue('ZiprecruiterRadius');
            if (!empty($criteria['GooglePlace']['location']['value'])) {
                $locationInfo = \SJB\Location\Helper::getLocationFromGoogle($criteria['GooglePlace']['location']['value']);
                if ($locationInfo) {
                    if (!empty($criteria['GooglePlace']['location']['radius'])) {
                        $radius = $criteria['GooglePlace']['location']['radius'];
                    }
                    if ($locationInfo['Country'] == 'United Kingdom') {
                        $country = 'uk';
                        $location = trim($locationInfo['City'] . ', UK', ', ');
                    } else {
                        $location = trim($locationInfo['City'] . ', ' . $locationInfo['State'], ' ,');
                    }
                } else {
                    $location = $criteria['GooglePlace']['location']['value'];
                    if ($locationInfo['Country'] == 'United Kingdom') {
                        $location .= ', UK';
                    }
                }
            } else {
                $locationFields = ['City', 'State'];
                if ($country == 'uk') {
                    $locationFields = ['City'];
                }
                $fieldVals = [];
                foreach ($locationFields as $locationField) {
                    if (!empty($criteria['Location_' . $locationField])) {
                        $fieldVal = current($criteria['Location_' . $locationField]);
                        if (!empty($fieldVal)) {
                            if (is_array($fieldVal)) {
                                $fieldVals[] = current($fieldVal);
                            } else {
                                $fieldVals[] = $fieldVal;
                            }
                        }
                    }
                }
                if ($fieldVals) {
                    $location = trim(join(', ', $fieldVals), ' ,');
                    if ($location && $country == 'uk') {
                        $location .= ', UK';
                    }
                }
                if (empty($location)) {
                    $location = $country == 'uk' ? 'UK' : 'United States';
                }
            }

            $query = [
                'api_key' => SJB_Settings::getSettingByName('ZiprecruiterApiKey'),
                'search' => $keywords,
                'location' => $location,
                'radius_miles' => $radius,
                'page' => $page,
                'jobs_per_page' => $limit,
            ];
            $url = "https://api.ziprecruiter.com/jobs/v1?" . http_build_query($query);

            $ziprecruiterListings = [];
            try {
                $json = SJB_H::getUrlContentByCurl($url);
                $results = json_decode($json, true);
                if (empty($results) || !empty($results['error'])) {
                    throw new Exception('Ziprecruiter - ' . print_r($results, true));
                }
                $totalResults = $results['total_jobs'];
                if ($totalResults) {
                    $totalPages = ceil(((integer)$totalResults) / $limit);
                    $ziprecruiterDomain = self::$countries[$country]['domain'];

                    foreach ($results['jobs'] as $job) {
                        if (is_numeric($job['state'])) {
                            $job['state'] = '';
                        }
                        $ziprecruiterListings[$job['id']] = [
                            'Title' => $job['name'],
                            'CompanyName' => $job['hiring_company']['name'],
                            'JobDescription' => $job['snippet'],
                            'Location' => [
                                'Country' => $job['country'],
                                'State' => $job['state'],
                                'City' => $job['city'],
                            ],
                            'url' => $job['url'],
                            'onmousedown' => '',
                            'target' => ' target="_blank" ',
                            'jobkey' => $job['id'],
                            'activation_date' => $job['posted_time'],
                            'api' => 'ziprecruiter',
                            'code' => sprintf('<a href="https://%s/jobs" id="jobs_widget_link" class="backfilling__from"><span>Job Search by</span> <span id="zr_logo_container"><img id="zr_logo" src="https://%s/img/logos/logo-sm-black-304px.png" alt="ZipRecruiter" width="120" /></span></a>', $ziprecruiterDomain, $ziprecruiterDomain),
                            'pageNumber' => $page,
                            'totalPages' => $totalPages,
                        ];
                    }
                }
            } catch (ErrorException $e) {
                SJB_Logger::error($e->getMessage());
            }
            self::$ziprecruiterListings = $ziprecruiterListings;
        }
        return $params;
    }

    public static function addZiprecruiterListingsToListingStructure($listings_structure)
    {
        foreach (self::$ziprecruiterListings as $ziprecruiterListing)
            $listings_structure[$ziprecruiterListing['jobkey']] = $ziprecruiterListing;
        return $listings_structure;
    }
}
