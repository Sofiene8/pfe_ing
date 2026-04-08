<?php

class Jobs2careersPlugin extends SJB_PluginAbstract
{
    public static $jobs2careersListings = [];

    function pluginSettings()
    {
        return [
            [
                'id' => 'Jobs2careersPublisherId',
                'caption' => 'Publisher ID',
                'type' => 'string',
                'comment' => 'To get your own publisher ID please apply here:<br /><a href="http://www.jobs2careers.com/publisher_services.php" target="_blank">http://www.jobs2careers.com/publisher_services.php</a>',
                'length' => '50',
                'order' => null,
                'class' => 'input__small',
            ],
            [
                'id' => 'Jobs2careersPublisherPassword',
                'caption' => 'Publisher Password',
                'type' => 'string',
                'comment' => 'Your unique Publisher Password (as shown in your Feed Manager)',
                'length' => '50',
                'order' => null,
                'class' => 'input__small',
            ],
            [
                'caption' => 'Default Filtering Parameters',
                'type' => 'panel_separator',
            ],
            [
                'id' => 'Jobs2careersKeywords',
                'caption' => 'Keyword Query',
                'type' => 'string',
                'comment' => 'Search query to filter your backfill jobs. You can enter keywords, job categories or roles.',
                'length' => '50',
                'order' => null,
            ],
            [
                'id' => 'Jobs2careersLocation',
                'caption' => 'Location',
                'type' => 'string',
                'comment' => 'Limits your backfill jobs to a specific location. Use a postal code or a "city, state/province/region" combination.',
                'length' => '50',
                'order' => null,
            ],
            [
                'id' => 'Jobs2careersRadius',
                'caption' => 'Radius',
                'type' => 'list',
                'list_values' => [
                    [
                        'id' => '20',
                        'caption' => '20',
                    ],
                    [
                        'id' => '40',
                        'caption' => '40'
                    ],
                    [
                        'id' => '80',
                        'caption' => '80'
                    ],
                ],
                'comment' => 'Distance from search location.',
                'length' => '50',
                'order' => null,
            ],
            [
                'id' => 'Jobs2careersIndustry',
                'caption' => 'Industry',
                'type' => 'multilist',
                'list_values' => [
                    [
                        'id' => '1',
                        'caption' => 'Accounting',
                    ],
                    [
                        'id' => '2',
                        'caption' => 'Administrative / Clerical',
                    ],
                    [
                        'id' => '3',
                        'caption' => 'Advertising / Marketing / PR',
                    ],
                    [
                        'id' => '4',
                        'caption' => 'Aerospace',
                    ],
                    [
                        'id' => '5',
                        'caption' => 'Agriculture',
                    ],
                    [
                        'id' => '6',
                        'caption' => 'Airline / Aviation',
                    ],
                    [
                        'id' => '7',
                        'caption' => 'Architecture',
                    ],
                    [
                        'id' => '8',
                        'caption' => 'Arts / Entertainment',
                    ],
                    [
                        'id' => '9',
                        'caption' => 'Automotive / Mechanic',
                    ],
                    [
                        'id' => '10',
                        'caption' => 'Banking / Mortgage / Finance',
                    ],
                    [
                        'id' => '11',
                        'caption' => 'Bilingual Services / Interpretation / Translation',
                    ],
                    [
                        'id' => '12',
                        'caption' => 'Biotech / Pharmaceutical',
                    ],
                    [
                        'id' => '13',
                        'caption' => 'Caregiving / Babysitting',
                    ],
                    [
                        'id' => '14',
                        'caption' => 'Chemical',
                    ],
                    [
                        'id' => '15',
                        'caption' => 'Construction / Facilities / Trades',
                    ],
                    [
                        'id' => '16',
                        'caption' => 'Consulting / Professional Services',
                    ],
                    [
                        'id' => '17',
                        'caption' => 'Consumer Products / CPG / Packaging',
                    ],
                    [
                        'id' => '18',
                        'caption' => 'Customer Service / Call Center / Telemarketing',
                    ],
                    [
                        'id' => '19',
                        'caption' => 'Design / Decorating',
                    ],
                    [
                        'id' => '20',
                        'caption' => 'Driver / Transportation / Maritime',
                    ],
                    [
                        'id' => '21',
                        'caption' => 'Education / Teaching',
                    ],
                    [
                        'id' => '22',
                        'caption' => 'Electronics / Computer Hardware',
                    ],
                    [
                        'id' => '23',
                        'caption' => 'Energy / Power / Utilities',
                    ],
                    [
                        'id' => '24',
                        'caption' => 'Environmental / Green / Waste Management',
                    ],
                    [
                        'id' => '25',
                        'caption' => 'Fashion / Beauty / Grooming',
                    ],
                    [
                        'id' => '26',
                        'caption' => 'General Labor / Entry-Level',
                    ],
                    [
                        'id' => '27',
                        'caption' => 'Government / Civil Service',
                    ],
                    [
                        'id' => '28',
                        'caption' => 'Graphic Design / CAD',
                    ],
                    [
                        'id' => '29',
                        'caption' => 'Healthcare / Allied Health / Wellness',
                    ],
                    [
                        'id' => '30',
                        'caption' => 'Healthcare / Physician / Nursing',
                    ],
                    [
                        'id' => '31',
                        'caption' => 'Hospitality / Hotel',
                    ],
                    [
                        'id' => '32',
                        'caption' => 'HR / Staffing / Training',
                    ],
                    [
                        'id' => '33',
                        'caption' => 'Insurance',
                    ],
                    [
                        'id' => '34',
                        'caption' => 'Internet / E-commerce',
                    ],
                    [
                        'id' => '35',
                        'caption' => 'IT / Software / Systems',
                    ],
                    [
                        'id' => '36',
                        'caption' => 'Law Enforcement / Security',
                    ],
                    [
                        'id' => '37',
                        'caption' => 'Legal / Lawyer',
                    ],
                    [
                        'id' => '38',
                        'caption' => 'Management (Non-Executive)',
                    ],
                    [
                        'id' => '39',
                        'caption' => 'Management (Executive)',
                    ],
                    [
                        'id' => '40',
                        'caption' => 'Manufacturing / Industrial / Mining',
                    ],
                    [
                        'id' => '41',
                        'caption' => 'Military / Defense',
                    ],
                    [
                        'id' => '42',
                        'caption' => 'Non-Profit / Fundraising',
                    ],
                    [
                        'id' => '43',
                        'caption' => 'Publishing / Journalism / Media',
                    ],
                    [
                        'id' => '44',
                        'caption' => 'Purchasing / Merchandising / Procurement',
                    ],
                    [
                        'id' => '45',
                        'caption' => 'Real Estate / Property Mgmt',
                    ],
                    [
                        'id' => '46',
                        'caption' => 'Restaurant / Food Service',
                    ],
                    [
                        'id' => '47',
                        'caption' => 'Retail',
                    ],
                    [
                        'id' => '48',
                        'caption' => 'Sales / Sales Management / Business Development',
                    ],
                    [
                        'id' => '49',
                        'caption' => 'Science / Research',
                    ],
                    [
                        'id' => '50',
                        'caption' => 'Social Services / Counseling',
                    ],
                    [
                        'id' => '51',
                        'caption' => 'Sports / Fitness / Recreation',
                    ],
                    [
                        'id' => '52',
                        'caption' => 'Telecom / Wireless / Cable',
                    ],
                    [
                        'id' => '53',
                        'caption' => 'Veterinary Services',
                    ],
                    [
                        'id' => '54',
                        'caption' => 'Warehouse / Logistics / Distribution',
                    ],
                    [
                        'id' => '55',
                        'caption' => 'Work at Home / Business Opp',
                    ],
                    [
                        'id' => '56',
                        'caption' => 'Other / Miscellaneous',
                    ]
                ],
                'comment' => '',
                'length' => '50',
                'required' => true,
                'order' => null,
            ],
            [
                'id' => 'Jobs2careersJobTypes',
                'caption' => 'Job Type',
                'type' => 'multilist',
                'list_values' => [
                    [
                        'id' => '1',
                        'caption' => 'Full Time/Professional',
                    ],
                    [
                        'id' => '2',
                        'caption' => 'Part Time'
                    ],
                    [
                        'id' => '4',
                        'caption' => 'Gigs'
                    ],
                ],
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
        $arrayOfProviders[] = 'jobs2careers';
        return $arrayOfProviders;
    }

    /**
     * @param SJB_SearchResultsTP $params
     * @return mixed
     * @throws Exception
     */
    public static function getListingsFromJobs2careers($params)
    {
        $listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($params->listing_type_sid);
        if ($listingTypeID == 'Job' && $GLOBALS['uri'] == '/jobs/' || $GLOBALS['uri'] == '/ajax/') {
            $page = intval(SJB_Request::getVar('page', $params->listing_search_structure['current_page']));

            $limit = $params->getCriteriaSaver()->getListingsPerPage();
            if (!$limit) {
                $limit = 10;
            }

            // SET PARAMS FOR REQUEST
            $keywords = SJB_Settings::getValue('Jobs2careersKeywords');
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

            $location = SJB_Settings::getValue('Jobs2careersLocation');
            $radius = SJB_Settings::getValue('Jobs2careersRadius');
            if (!empty($criteria['GooglePlace']['location']['value'])) {
                $locationInfo = \SJB\Location\Helper::getLocationFromGoogle($criteria['GooglePlace']['location']['value']);
                if ($locationInfo) {
                    if (!empty($criteria['GooglePlace']['location']['radius'])) {
                        $radius = $criteria['GooglePlace']['location']['radius'];
                    }
                    $location = trim($locationInfo['City'] . ', ' . $locationInfo['State'], ' ,');
                } else {
                    $location = $criteria['GooglePlace']['location']['value'];
                }
            } else {
                $locationFields = ['City', 'State'];
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
                }
            }

            $ip = $_SERVER['REMOTE_ADDR'];
            if ($ip == '::1') {
                $ip = '127.0.0.1';
            }

            $query = [
                'id' => SJB_Settings::getSettingByName('Jobs2careersPublisherId'),
                'pass' => SJB_Settings::getSettingByName('Jobs2careersPublisherPassword'),
                'industry' => str_replace(',', '|', SJB_Settings::getSettingByName('Jobs2careersIndustry')),
                'jobtype' => str_replace(',', '|', SJB_Settings::getSettingByName('Jobs2careersJobTypes')),
                'ip' => $ip,
                'q' => $keywords,
                'l' => $location,
                'start' => $limit * ($page - 1),
                'format' => 'json',
                'd' => $radius,
                'useragent' => SJB_Request::getUserAgent(),
                'limit' => $limit,
                'link' => 1,
            ];
            $url = "http://api.jobs2careers.com/api/search.php?" . http_build_query($query);

            $jobs2careersListings = [];
            try {
                $json = SJB_H::getUrlContentByCurl($url);
                $results = json_decode($json, true);
                if (empty($results) || !empty($results['error'])) {
                    throw new Exception('Jobs2careers - ' . print_r($results, true));
                }
                $totalResults = $results['total'];
                if ($totalResults) {
                    $totalPages = ceil(((integer)$totalResults) / $limit);

                    foreach ($results['jobs'] as $job) {
                        $jobs2careersListings[$job['id']] = [
                            'Title' => $job['title'],
                            'CompanyName' => $job['company'],
                            'JobDescription' => $job['description'],
                            'Location' => [
                                'Country' => '',
                                'State' => '',
                                'City' => preg_replace('/,(\\w)/u', ', $1', $job['city'][0]),
                            ],
                            'url' => $job['url'],
                            'onmousedown' => '',
                            'target' => ' target="_blank" ',
                            'jobkey' => $job['id'],
                            'activation_date' => $job['date'],
                            'api' => 'jobs2careers',
                            'code' => sprintf('<a href="http://www.jobs2careers.com/" class="backfilling__from"><span>jobs</span> by <img id="zr_logo" src="%s/templates/_system/admin/main/images/jobs2careersplugin-logo.png" alt="Jobs by Jobs2Careers" width="120" /></a>', SJB_H::getUserSiteUrl()),
                            'pageNumber' => $page,
                            'totalPages' => $totalPages,
                        ];
                    }
                }
            } catch (ErrorException $e) {
                SJB_Logger::error($e->getMessage());
            }
            self::$jobs2careersListings = $jobs2careersListings;
        }
        return $params;
    }

    public static function addJobs2careersListingsToListingStructure($listings_structure)
    {
        foreach (self::$jobs2careersListings as $jobs2careersListing)
            $listings_structure[$jobs2careersListing['jobkey']] = $jobs2careersListing;
        return $listings_structure;
    }
}
