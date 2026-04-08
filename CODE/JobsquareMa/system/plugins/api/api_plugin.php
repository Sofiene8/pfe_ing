<?php

class ApiPlugin extends SJB_PluginAbstract
{

    private static $writeLogs = true;

    /**
     * log filename for API plugin
     * @var string
     */
    private static $logFilename = 'api_plugin.log';

    /**
     * Initialization of plugin functions.
     *
     * This will add new functions in modules. After this, new functions may be
     * called via http://site.url/system/<module_name>/<function_name>/
     *
     */
    public static function init()
    {
        SJB_System::getModuleManager()->addFunction('miscellaneous', 'api', [
            'display_name' => 'api',
            'script' => 'api.php',
            'raw_output' => true,
            'type' => 'user',
            'access_type' => ['user'],
        ]);
    }

 
    /**
     * Write message to plugin log
     *
     * @param string $message
     */
    private static function writeToLog($message)
    {
        if (!is_string($message)) {
            $message = (string)$message;
        }

        $filename = SJB_BASE_DIR . 'system/cache/' . self::$logFilename;

        if (file_exists($filename) && filesize($filename) > 10000000) {
            $fp = fopen($filename, "w");
        } else {
            $fp = fopen($filename, "a");
        }
        flock($fp, LOCK_EX);
        fputs($fp, date("Y-m-d H:i:s") . "\t" . $message . "\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * Get plugin settings
     *
     * @return array
     */
    public function pluginSettings()
    {
        return [];
    }


    /**
     * Main API handler to get incoming request, and route to methods
     * @param $requestData
     * @internal param array $params
     */
    public static function apiHandler($requestData)
{
		
		ob_start();
    try {
        self::writeToLog("Requested Data: " . print_r($requestData, true));

        $rawInput = file_get_contents('php://input');
        self::writeToLog("Raw Input: " . $rawInput);

        $contentType = $_SERVER["CONTENT_TYPE"] ?? '';
        $isFormData = strpos($contentType, 'multipart/form-data') !== false;

        if ($isFormData) {
            $requestFunction = $_POST['function'] ?? '';
            $requestParams = $_POST;
        } else {
            $jsonData = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("JSON decode error: " . json_last_error_msg());
            }
            $requestFunction = $jsonData['function'] ?? '';
            $requestParams = $jsonData['params'] ?? [];
        }

        self::writeToLog("Request Function: " . $requestFunction);
        self::writeToLog("Request Params: " . print_r($requestParams, true));
ob_end_flush(); // End and flush any existing output buffers
    flush();
        $callResult = new stdClass();
        $callResult->session_id = session_id();
        $apiKey = $_GET['api_key'] ?? '';

        /*if ($requestFunction !== 'getToken') {
            // if (!self::verifyClientIp($apiKey)) {
            //     throw new Exception("Forbidden: IP address not authorized");
            // }
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
           if (!$authHeader) {
               throw new Exception("Authorization header is missing");
          }

            $token = str_replace('Bearer ', '', $authHeader);

          if (!self::validateToken($token)) {
                throw new Exception("Invalid or expired token");
            }
        }*/
		
		/*******  eliminated for now  ////*/
	

        if (method_exists('ApiPlugin', $requestFunction)) {
            $functionResult = call_user_func(['ApiPlugin', $requestFunction], $requestParams);
            $callResult->result = "success";
            $callResult->function_result = $functionResult;
        } else {
            throw new Exception("Function not found");
        }
    } catch (\Throwable $e) {
        $callResult->result = "error";
        $callResult->message = "Internal Server Error: " . $e->getMessage();
        $callResult->file = $e->getFile();
        $callResult->line = $e->getLine();
        
        self::writeToLog("Error in apiHandler: " . $e->getMessage() . "\n" . $e->getTraceAsString());
    }
ob_end_clean();
    header('Content-Type: application/json');
    $jsonResponse = json_encode($callResult);
    echo $jsonResponse;

    self::writeToLog("Response: \n" . $jsonResponse);
}


    /**
     * JSON encode PHP array or object
     * @param object|array $php_value
     * @return string
     */
    public static function sjb_json_encode($php_value)
    {
        if (function_exists('json_encode')) {
            return json_encode($php_value);
        }
        return Zend_Json::encode($php_value);
    }

    /**
     * Parse JSON string
     * @param $json_string
     * @return mixed
     * @throws Zend_Json_Exception
     * @internal param array|object $php_value
     */
    public static function sjb_json_decode($json_string)
    {
        if (function_exists('json_decode')) {
            return json_decode($json_string);
        } else {
            return Zend_Json::decode($json_string);
        }
    }

    private static function sjb_get_listing_property_metadata($property_name)
    {
        $empty_listing = new SJB_Listing([], 1);
        $empty_listing->addIDProperty();
        $empty_listing->addActivationDateProperty();
        $empty_listing->addUsernameProperty();
        $empty_listing->addKeywordsProperty();
        $empty_listing->addListingTypeIDProperty();
        $empty_listing->addPostedWithinProperty();

        $search_form_builder = new SJB_SearchFormBuilder($empty_listing);

        // CHECK FIELD TYPE
        if (isset($search_form_builder->object_properties[$property_name]->type->property_info['type'])) {
            $fieldType = $search_form_builder->object_properties[$property_name]->type->property_info['type'];

            if ($fieldType == 'list' || $fieldType == 'multilist') {
                // TRANSLATE
                if (isset($search_form_builder->object_properties[$property_name]->type->list_values)) {
                    $i18n = SJB_I18N::getInstance();
                    $domain = 'Property_' . $property_name;
                    foreach ($search_form_builder->object_properties[$property_name]->type->list_values as $key => $val) {
                        $trans = $i18n->gettext($domain, $val['caption'], 'default');
                        $search_form_builder->object_properties[$property_name]->type->list_values[$key]['caption'] = $trans;
                    }
                }
            }
        }

        return $search_form_builder->object_properties[$property_name];
    }
	


    /***************************************************************************
     * API Functions
     **************************************************************************/

    /**
     * Get configuration options for mobile application
     * @param array $params
     * @return array
     * @deprecated
     */
    public static function get_config($params)
    {
        return ['logo_url' => ''];
    }

    /**
     * API authenticate function
     * @param $params
     * @return array|null|string
     */
    public static function authenticate($params)
    {
        $username = SJB_Array::get($params, 'username', null);
        $password = SJB_Array::get($params, 'password', null);
        $errors = [];
        if ($username == 'anonymous' && $password == 'anonymous') {
            return ['username' => 'anonymous'];
        }
        if (!SJB_UserManager::login($username, $password, $errors, false, false)) {
            return 'INVALID_USERNAME_OR_PASSWORD';
        } else {
            $userInfo = SJB_UserManager::getUserInfoByUserName($username);
            if (isset($userInfo['user_group_sid']) && $userInfo['user_group_sid'] == 41) {
                return 'FORBIDDEN_FOR_EMPLOYER';
            }
            SJB_Authorization::login($username, $password, true, $errors);
            return self::get_filtered_user_info($username);
        }
    }

    public static function get_user_info($params)
    {
        return self::get_filtered_user_info($params['username']);
    }

    private static function get_filtered_user_info($username)
    {
        $userInfo = SJB_UserManager::getUserInfoByUserName($username);
        $userInfo['group'] = $userInfo['user_group_sid'] == 41 ? 'Employer' : 'JobSeeker';

        unset($userInfo['password']);
        unset($userInfo['verification_key']);
        unset($userInfo['ip']);
        unset($userInfo['reference_uid']);

        return $userInfo;
    }
/*public static function get_values($params)
{
    // Start output buffering to catch any warnings
    ob_start();
    
    try {
        if (!isset($params['value'])) {
            return json_encode([
                'session_id' => session_id(),
                'result' => 'error',
                'message' => 'Missing value parameter'
            ]);
        }

        $field = $params['value'];
        $result = [];

        switch ($field) {
            case 'id_Job_Experience':
                $dbResults = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=403");
                break;
            case 'JobCategory':
                $dbResults = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=198");
                break;
				case 'id_Job_Langue':
                    $dbResults= SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=406");
                    break;
                case 'id_Job_Niveaudtude':
                    $dbResults= SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=404");
                    break;
                case 'id_Job_Rmunrationpropose':
                    $dbResults= SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=405");
                    break;
                case 'id_Job_Genre':
                    $dbResults= SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=407");
                    break;
                case 'Location_City':
                    $dbResults= SJB_DB::query("SELECT * FROM `cities`");
                    break;
                case 'EmploymentType':
                    $dbResults= SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=199");
                    break;
                case 'Location_State':
                        $dbResults= SJB_DB::query("SELECT * FROM `states`");
                        break;
       
            default:
                $dbResults = [];
        }

        // Transform to expected format
        $functionResult = array_map(function($row) {
            return [
                'sid' => $row['sid'] ?? null,
                'field_sid' => $row['field_sid'] ?? null,
                'order' => $row['order'] ?? 0,
                'value' => trim($row['value'] ?? ($row['caption'] ?? ''))
            ];
        }, $dbResults);

        $response = [
            'session_id' => session_id(),
            'result' => 'success',
            'function_result' => $functionResult
        ];

    } catch (Exception $e) {
        $response = [
            'session_id' => session_id(),
            'result' => 'error',
            'message' => $e->getMessage()
        ];
    } finally {
        // Clean any output and ensure JSON response
        ob_end_clean();
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}*/

  public static function get_values($params)
    {
	  
    
		//var_dump($params['value']);
	  //var_dump(isset($params['value']);
        if (!isset($params['value'])) {
            return json_encode([
                'session_id' => session_id(),
                'result' => 'error',
                'message' => 'Missing value parameter'
            ]);
        }
		
        $listingPropertyMetadata= self::sjb_get_listing_property_metadata($params['value']);
		
        if($listingPropertyMetadata->function_result==null ){
            
            switch ($params['value']){
                
                case 'id_Job_Experience':
                    return SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=403");
                    break;
                case 'JobCategory':
                    return SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=198");
                    break;
                case 'id_Job_Langue':
                    return SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=406");
                    break;
                case 'id_Job_Niveaudtude':
                    return SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=404");
                    break;
                case 'id_Job_Rmunrationpropose':
                    return SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=405");
                    break;
                case 'id_Job_Genre':
                    return SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=407");
                    break;
                case 'Location_City':
                    return SJB_DB::query("SELECT * FROM `cities`");
                    break;
                case 'EmploymentType':
                    return SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=199");
                    break;
                case 'Location_State':
                        return SJB_DB::query("SELECT * FROM `states`");
                        break;
                default:
                    return $listingPropertyMetadata->type->list_values;
					//return "test";

            }
        }
	
	
	
	  
        
        
    }
	
	/*public static function get_values($params)
{
    // Start output buffering to prevent any accidental output
    ob_start();
    
    try {
        if (!isset($params['value'])) {
            return [
                'session_id' => session_id(),
                'result' => 'error',
                'message' => 'Missing value parameter'
            ];
        }

        $field = $params['value'];
        $result = [];

        switch ($field) {
            case 'id_Job_Experience':
                $result = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=403");
                break;
            case 'JobCategory':
                $result = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=198");
                break;
            case 'id_Job_Langue':
                $result = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=406");
                break;
            case 'id_Job_Niveaudtude':
                $result = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=404");
                break;
            case 'id_Job_Rmunrationpropose':
                $result = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=405");
                break;
            case 'id_Job_Genre':
                $result = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=407");
                break;
            case 'Location_City':
                $result = SJB_DB::query("SELECT * FROM `cities`");
                break;
            case 'EmploymentType':
                $result = SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=199");
                break;
            case 'Location_State':
                $result = SJB_DB::query("SELECT * FROM `states`");
                break;
            default:
                // Fallback to metadata if needed
                $metadata = self::sjb_get_listing_property_metadata($field);
                $result = $metadata->type->list_values ?? [];
        }

        return [
            'session_id' => session_id(),
            'result' => 'success',
            'function_result' => $result
        ];

    } catch (Exception $e) {
        return [
            'session_id' => session_id(),
            'result' => 'error',
            'message' => $e->getMessage()
        ];
    } finally {
        ob_end_clean();
    }
}*/
	
	/*public static function get_values($params)
{
    if (!isset($params['value'])) {
        return ['result' => 'error', 'message' => 'Missing value parameter'];
    }

    $listingPropertyMetadata = self::sjb_get_listing_property_metadata($params['value']);

    // Check if metadata is valid and has list_values
    if ($listingPropertyMetadata && !empty($listingPropertyMetadata->type->list_values)) {
        // Format list_values to match expected response structure
        $listValues = array_map(function ($item) {
            return [
                'sid' => $item['id'],
                'value' => $item['caption'],
                'field_sid' => $listingPropertyMetadata->type->property_info['sid'],
                'order' => $listingPropertyMetadata->type->property_info['order'],
            ];
        }, $listingPropertyMetadata->type->list_values);
        return [
            'result' => 'success',
            'function_result' => $listValues
        ];
    }

    // Fallback to database queries for specific fields
    switch ($params['value']) {
        case 'id_Job_Experience':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=403")];
        case 'JobCategory':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=198")];
        case 'id_Job_Langue':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=406")];
        case 'id_Job_Niveaudtude':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=404")];
        case 'id_Job_Rmunrationpropose':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=405")];
        case 'id_Job_Genre':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=407")];
        case 'Location_City':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `cities`")];
        case 'EmploymentType':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `listing_field_list` WHERE field_sid=199")];
        case 'Location_State':
            return ['result' => 'success', 'function_result' => SJB_DB::query("SELECT * FROM `states`")];
        default:
            return ['result' => 'error', 'message' => 'Invalid value parameter'];
    }
}*/

    // /**
    //  * Get list of search distances values
    //  * @param array $params
    //  * @return array
    //  */
    // public static function get_distances($params)
    // {
    //     $radius_search_unit = SJB_System::getSettingByName('radius_search_unit');
    //     $i18n = SJB_I18N::getInstance();
    //     $radius_search_unit = $i18n->gettext('Frontend', $radius_search_unit);
    //     return [
    //         ['id' => 10, 'caption' => '10 ' . $radius_search_unit],
    //         ['id' => 20, 'caption' => '20 ' . $radius_search_unit],
    //         ['id' => 50, 'caption' => '50 ' . $radius_search_unit],
    //         ['id' => 100, 'caption' => '100 ' . $radius_search_unit],
    //         ['id' => 200, 'caption' => '200 ' . $radius_search_unit],
    //     ];
    // }

    // /**
    //  * Get list of listing types
    //  * @param $params
    //  * @return array
    //  */
    // public static function get_listing_types($params)
    // {
    //     return [
    //         [
    //             'id' => 'Job',
    //             'caption' => 'Job'
    //         ],
    //         [
    //             'id' => 'Resume',
    //             'caption' => 'Resume'
    //         ]
    //     ];
    // }

    // /**
    //  * Get list of listing fields values
    //  * @param $params
    //  * @return array
    //  */
    // public static function get_listing_fields_values($params)
    // {
    //     $items = SJB_DB::query("SELECT * FROM listing_field_list");
    //     $list_items = [];
    //     foreach ($items as $item) {
    //         $list_items[$item['sid']] = $item['value'];
    //     }
    //     return $list_items;
    // }

    // /**
    //  * Get Listing alerts
    //  * @param $params
    //  * @deprecated
    //  * @return array|bool
    //  */
    // public static function get_listing_alerts($params)
    // {
    //     return [];
    // }

    // /**
    //  * Get listings by listing alert
    //  * @param $params
    //  * @return array
    //  */
    // public static function get_listing_alert_entries($params)
    // {
    //     $jobAlert = SJB_GuestAlertManager::getGuestAlertInfoBySID($params['alert_sid']);
    //     if (empty($jobAlert)) {
    //         return [];
    //     } else {
    //         $searchResultsTP = new SJB_SearchResultsTP($jobAlert['data'], 'Job');
    //         return $searchResultsTP->getListingCollectionStructure($searchResultsTP->_getListingSidCollectionFromRequest());
    //     }
    // }




    

    // public static function get_user_listings($params)
    // {
    //     $user_sid = (int)SJB_Array::get($params, 'user_sid', 0);
    //     $result = SJB_DB::query("SELECT sid FROM listings WHERE user_sid = {$user_sid}");

    //     $listings = [];
    //     foreach ($result as $val) {
    //         $listing = SJB_ListingManager::getObjectBySID($val['sid']);
    //         $listing = SJB_ListingManager::createTemplateStructureForListing($listing);
    //         $listings[] = $listing;
    //     }
    //     return $listings;
    // }

    // /**
    //  * Search listings by request data
    //  * @param array $request
    //  * @return array
    //  */
    // private static function search_listings_by_request($request)
    // {
    //     $request['active']['equal'] = '1';
    //     $request['action'] = 'search';
    //     // set default value for listing type id

    //     $searchResultsTP = new SJB_SearchResultsTP($request, $request['listing_type']['equal']);
    //     $searchResultsTP->usePriority(true);
    //     $searchResultsTP->getChargedTemplateProcessor();

    //     // check current criteria_saver for listings
    //     $listings = $searchResultsTP->found_listings_sids;
    //     $searchId = $searchResultsTP->searchId;

    //     $result = [];
    //     foreach ($listings as $sid) {
    //         $listing = SJB_ListingManager::createTemplateStructureForListing(SJB_ListingManager::getObjectBySID($sid));
    //         $listing['JobDescription'] = strip_tags($listing['JobDescription']);

    //         if (isset($listing['ApplicationSettings']) && is_array($listing['ApplicationSettings'])) {
    //             $listing['ApplicationSettingsType'] = $listing['ApplicationSettings']['add_parameter'] == '2' ? 'url' : 'email';
    //             $listing['ApplicationSettingsValue'] = $listing['ApplicationSettings']['value'];
    //         } else {
    //             $listing['ApplicationSettingsType'] = '';
    //             $listing['ApplicationSettingsValue'] = '';
    //         }

    //         // display category in job details as string
    //         $jobCategory = '';
    //         if (!empty($listing['JobCategory'])) {
    //             $jobCategory = implode(', ', $listing['JobCategory']);
    //         }
    //         $listing['JobCategory'] = $jobCategory;

    //         $result[] = $listing;
    //     }

    //     $result = [
    //         'listings' => $result,
    //         'searchId' => (string)$searchId,
    //         'listingsNumber' => $searchResultsTP->listing_search_structure['listings_number']
    //     ];

    //     return $result;
    // }

    // /**
    //  * Generate some request values from $params and search listings by request
    //  * @param array $params
    //  * @return array
    //  */
    // public static function search_listings($params)
    // {
    //     $request = [];
    //     $request['listing_type'] = ['equal' => SJB_Array::get($params, 'listing_type', 'Job')];

    //     $search_id = SJB_Array::get($params, 'search_id', '');
    //     if ($search_id && $search_id != '') {
    //         $request['searchId'] = $search_id;
    //     } else {
    //         $request['keywords'] = ['all_words' => SJB_Array::get($params, 'keywords', '')];
    //         $request['GooglePlace'] = ['location' => ['value' => SJB_Array::get($params, 'location', ''), 'radius' => SJB_Array::get($params, 'radius', '')]];
    //         $request['default_listings_per_page'] = SJB_Request::getInt('listings_per_page', 20);
    //         if (SJB_Array::get($params, 'distance', false) !== false) {
    //             $request['ZipCode'] = [
    //                 'geo_coord' => [
    //                     'latitude' => SJB_Array::get($params, 'latitude', 0.00),
    //                     'longitude' => SJB_Array::get($params, 'longitude', 0.00),
    //                     'distance' => SJB_Array::get($params, 'distance', 0.00),
    //                 ]
    //             ];
    //         }
    //     }

    //     $request['page'] = SJB_Array::get($params, 'page', 1);

    //     return self::search_listings_by_request($request);
    // }

    // /**
    //  * Search listings by Search ID
    //  * @param array $params
    //  * @return array
    //  */
    // public static function search_listings_by_search_id($params)
    // {
    //     $jobAlert = SJB_GuestAlertManager::getGuestAlertInfoBySID((int)SJB_Array::get($params, 'search_sid', 0));

    //     $request = $jobAlert['data'];
    //     $request['page'] = SJB_Array::get($params, 'page', 1);
    //     return self::search_listings_by_request($request);
    // }

    // /**
    //  * Get listings by sids in array
    //  * @param array $params
    //  * @return array
    //  */
    // public static function get_listings($params)
    // {
    //     $listings_structure = [];
    //     foreach ($params as $sid) {
    //         $listing = SJB_ListingManager::getObjectBySID($sid);
    //         if (is_null($listing)) {
    //             continue;
    //         }

    //         $listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
    //         $listings_structure[$listing->getID()] = $listing_structure;
    //     }

    //     $result = [];
    //     foreach ($listings_structure as $sid => $listing) {
    //         $listing['JobDescription'] = strip_tags($listing['JobDescription']);
    //         $jobCategory = '';
    //         if (!empty($listing['JobCategory'])) {
    //             $jobCategory = implode(', ', $listing['JobCategory']);
    //         }
    //         $listing['JobCategory'] = $jobCategory;
    //         $result[] = $listing;
    //     }

    //     return $result;
    // }

    // /**
    //  * Apply now for listing
    //  * @param array $params
    //  * @return string
    //  */
    // public static function apply_listing($params)
    // {
    //     $current_user_sid = SJB_Array::get($params, 'user_sid', null);

    //     $request = [];
    //     $request['listing_id'] = SJB_Array::get($params, 'listing_sid', null);
    //     $request['comments'] = SJB_Array::get($params, 'comment', null);
    //     $request['id_resume'] = SJB_Array::get($params, 'attached_listing_sid', null);
    //     // unregistered user
    //     $request['name'] = SJB_Array::get($params, 'name', null);
    //     $request['email'] = SJB_Array::get($params, 'email', null);

    //     $notRegisterUserData = $request;
    //     $listing_info = '';

    //     $controller = new SJB_SendListingInfoController($request);
    //     if (!$controller->isListingSpecified()) {
    //         return 'listing not found';
    //     }

    //     $post = $controller->getData();

    //     if (!isset($post['submitted_data']['id_resume'])) {
    //         $canApplyWithoutResume = true;
    //         if (!$canApplyWithoutResume) {
    //             return 'cannot apply without resume';
    //         }
    //     }

    //     if (SJB_Applications::isApplied($post['submitted_data']['listing_id'], $current_user_sid) && !is_null($current_user_sid)) {
    //         return 'You already applied to this job';
    //     }

    //     $res = SJB_Applications::create(
    //         $post['submitted_data']['listing_id'],
    //         $current_user_sid,
    //         (isset($post['submitted_data']['id_resume'])) ? $post['submitted_data']['id_resume'] : "",
    //         $post['submitted_data']['comments'],
    //         '',
    //         '',
    //         '',
    //         $params
    //     );

    //     if ($res === false) {
    //         return "cannot apply";
    //     }

    //     if (isset($post['submitted_data']['id_resume']) && $post['submitted_data']['id_resume'] != 0) {
    //         $listing_info = SJB_ListingManager::getListingInfoBySID($post['submitted_data']['id_resume']);
    //         $emp_sid = SJB_ListingManager::getUserSIDByListingSID($post['submitted_data']['listing_id']);
    //         $accessible = SJB_ListingManager::isListingAccessableByUser($post['submitted_data']['id_resume'], $emp_sid);
    //         if (!$accessible) {
    //             SJB_ListingManager::setListingAccessibleToUser($post['submitted_data']['id_resume'], $emp_sid);
    //         }
    //     }

    //     if (!SJB_Notifications::sendApplyNow($post, '', $listing_info, $notRegisterUserData)) {
    //         return 'send error';
    //     }

    //     return 'success';
    // }

    // /**
    //  * Save user
    //  * @param array $params
    //  * @return array|null
    //  */
    // public static function get_user_groups($params)
    // {
    //     return SJB_UserGroupManager::getAllUserGroupsInfo();
    // }

    // /**
    //  * Get user profile fields by user group id / user sid in array
    //  * @param array $params
    //  * @return array
    //  */
    // public static function get_user_profile_fields($params)
    // {
    //     $userSID = SJB_Array::get($params, 'user_sid', null);
    //     $userGroupId = SJB_Array::get($params, 'user_group_id', null);
    //     $errors = SJB_Array::get($params, 'errors', []);
    //     if ($userSID) {
    //         $userInfo = SJB_UserManager::getUserInfoBySID($userSID);
    //         $params = array_merge($userInfo, $params);
    //         $userGroupSid = !empty($userInfo['user_group_sid']) ? $userInfo['user_group_sid'] : null;
    //     } else {
    //         $userGroupSid = SJB_UserGroupManager::getUserGroupSIDByID($userGroupId);
    //     }
    //     $user = SJB_ObjectMother::createUser($params, $userGroupSid);
    //     $user->deleteProperty('active');
    //     $user->deleteProperty('featured');
    //     $registrationForm = SJB_ObjectMother::createForm($user);
    //     $formFields = $registrationForm->getFormFieldsInfo();
    //     foreach ($formFields as $fieldName => $fieldInfo) {
    //         if (in_array($fieldInfo['type'], ['picture', 'logo'])) {
    //             unset($formFields[$fieldName]);
    //         } else {
    //             switch ($fieldInfo['type']) {
    //                 case 'list':
    //                 case 'multilist':
    //                     $property = $user->getPropertyInfo($fieldName);
    //                     $formFields[$fieldName]['list_values'] = $property['list_values'];
    //                     $formFields[$fieldName]['value'] = $property['value'];
    //                     $formFields[$fieldName]['default_value'] = $property['default_value'];
    //                     break;
    //                 case 'location':
    //                     $property = $user->getProperty($fieldName);
    //                     $child = $property->type->child;
    //                     $form = new SJB_Form($child);
    //                     $childFormFields = $form->getFormFieldsInfo();
    //                     foreach ($childFormFields as $childFielName => $childFieldInfo) {
    //                         $childProperty = $child->getPropertyInfo($childFielName);
    //                         switch ($childFieldInfo['type']) {
    //                             case 'list':
    //                             case 'multilist':
    //                                 if ($childFieldInfo['id'] == 'State') {
    //                                     $displayAS = !empty($childFieldInfo['display_as']) ? $childFieldInfo['display_as'] : 'state_name';
    //                                     $AllStates = SJB_DB::query("SELECT `sid`, ?w as `state_name`, `country_sid` FROM `states` WHERE `active` = 1 ORDER BY state_name", $displayAS);
    //                                     $listValues = [];
    //                                     foreach ($AllStates as $state) {
    //                                         $listValues[$state['country_sid']][] = ['id' => $state['sid'], 'caption' => $state['state_name']];
    //                                     }
    //                                     $childFormFields[$childFielName]['list_values'] = $listValues;
    //                                 } else {
    //                                     $childFormFields[$childFielName]['list_values'] = $childProperty['list_values'];
    //                                 }
    //                                 break;
    //                         }
    //                         $childFormFields[$childFielName]['value'] = $childProperty['value'];
    //                     }
    //                     $formFields[$fieldName]['fields'] = $childFormFields;
    //                     break;
    //                 default:
    //                     $property = $user->getPropertyInfo($fieldName);
    //                     $formFields[$fieldName]['value'] = $property['value'];
    //                     $formFields[$fieldName]['default_value'] = $property['default_value'];
    //                     break;
    //             }
    //         }
    //     }
    //     return ['form_fields' => $formFields, 'errors' => $errors];
    // }

    // /**
    //  * Save user
    //  * @param array $params
    //  * @return array|string
    //  */
    // public static function save_user($params)
    // {
    //     $userGroupId = SJB_Array::get($params, 'user_group_id', null);
    //     $userSID = SJB_Array::get($params, 'user_sid', null);
    //     $password = SJB_Array::get($params, 'password', null);
    //     $params['password'] = ['original' => $password, 'confirmed' => $password];
    //     if ($userSID) {
    //         $userInfo = SJB_UserManager::getUserInfoBySID($userSID);
    //         $userInfo = array_merge($userInfo, $params);
    //         $userGroupSid = !empty($userInfo['user_group_sid']) ? $userInfo['user_group_sid'] : null;
    //     } else {
    //         $userGroupSid = SJB_UserGroupManager::getUserGroupSIDByID($userGroupId);
    //     }

    //     if (!empty($userInfo)) {
    //         $user = new SJB_User($userInfo, $userGroupSid);
    //     } else {
    //         $user = SJB_ObjectMother::createUser($params, $userGroupSid);
    //     }
    //     $user->deleteProperty("active");
    //     $user->deleteProperty("featured");

    //     if ($userSID) {
    //         $user->setSID($userSID);
    //         $user->makePropertyNotRequired("password");
    //     }

    //     $errors = [];
    //     $profileForm = new SJB_Form($user);
    //     if ($profileForm->isDataValid($errors)) {
    //         if ($userSID) {
    //             $passworValue = $user->getPropertyValue('password');
    //             if (empty($passworValue['original'])) {
    //                 $user->deleteProperty('password');
    //             }
    //             SJB_UserManager::saveUser($user);
    //             SJB_Authorization::updateCurrentUserSession();
    //         } else {
    //             $defaultProduct = SJB_UserGroupManager::getDefaultProduct($userGroupSid);
    //             SJB_UserManager::saveUser($user);
    //             $availableProductIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($userGroupSid);

    //             if ($defaultProduct && in_array($defaultProduct, $availableProductIDs)) {
    //                 $contract = new SJB_Contract(['product_sid' => $defaultProduct]);
    //                 $contract->setUserSID($user->getSID());
    //                 $contract->saveInDB();
    //             }

    //             // Activation
    //             SJB_UserManager::setStatus($user->getSID(), SJB_User::STATUS_ACTIVE);
    //             SJB_Notifications::sendUserWelcomeLetter($user->getSID());
    //             SJB_Authorization::login($user->getUserName(), $params['password']['original'], false, $errors);
    //         }
    //         return 'success';
    //     } else {
    //         $params['errors'] = $errors;
    //         return self::get_user_profile_fields($params);
    //     }
    // }

    // public static function get_applications($params)
    // {
    //     $user_sid = (int)SJB_Array::get($params, 'user_sid', 0);
    //     $applications = SJB_Applications::getByJobseeker($user_sid);
    //     $result = [];
    //     foreach ($applications as $application) {
    //         $result[] = $application['listing_id'];
    //     }

    //     return $result;
    // }

    // /**
    //  * save job alert
    //  * @param array $params
    //  * @return bool
    //  */
    // public static function save_job_alert($params)
    // {
    //     $result = self::search_listings($params['search_criteria']);

    //     $criteria_saver = new SJB_ListingCriteriaSaver($result['searchId']);
    //     $requested_data = $criteria_saver->getCriteria();

    //     if (is_array($criteria_saver->order_info)) {
    //         $requested_data = array_merge($requested_data, $criteria_saver->order_info);
    //     }
    //     $guestAlert = new SJB_GuestAlert($requested_data);
    //     $guestAlert->setPropertyValue('email', SJB_Array::get($params, 'email'));
    //     $guestAlert->setPropertyValue('email_frequency', SJB_Array::get($params, 'email_frequency'));
    //     $guestAlert->addDataProperty(serialize($requested_data));
    //     $guestAlert->save();
    //     return true;
    // }

        /***************************************************************************
     * NEW API Functions
     **************************************************************************/
    private static function verifyClientIp($apiKey)
{
    // Fetch the client's IP address from the database
    $clientIp = SJB_DB::queryValue("SELECT ip FROM users_featured WHERE api_key = ?s", $apiKey);

    // Get the request's IP address (the IP address of the website making the request)
   
    $requestIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    if (!$clientIp) {
        throw new Exception("IP address not found for this API key");
    }

    // Check if the IP addresses match
    if ($requestIp !== $clientIp) {
        throw new Exception("Access forbidden: IP address mismatch");
    }

    // If IP addresses match, return true
    return true;
}
   /**
     * Generate a new token
     * @param string $apiKey
     * @return string
     */
private static function generateToken($apiKey){
    

    $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
    $issuedAt = time();
    $expiration = $issuedAt + 86400000;

    $payload = json_encode([
        'iss' => 'a7b3c9d4e8f6g2h1j5k9m3n8p7q2r4s6',
        'iat' => $issuedAt,
        'exp' => $expiration,
        'api_key' => $apiKey,
    ]);

    // Encode Header
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

    // Encode Payload
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

    // Create Signature Hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, "d2FzZWRrJ3Mkc2VjcmV0LWtleS1mb3ItdGVzdC1hcHBsaWNhdGlvbg==", true);

    // Encode Signature to Base64Url
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    // Create JWT
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    return $jwt;
}


private static function validateToken($jwt){
    $tokenParts = explode('.', $jwt);
    $header = base64_decode($tokenParts[0]);
    $payload = base64_decode($tokenParts[1]);
    $signatureProvided = $tokenParts[2];

     // Check if the token has expired
     $payloadArray = json_decode($payload, true);
     if ($payloadArray['exp'] < time()) {
         throw new Exception("Token has expired");
     }
 
     // Build a signature based on the header and payload using the secret
     $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
     $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
     $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, "d2FzZWRrJ3Mkc2VjcmV0LWtleS1mb3ItdGVzdC1hcHBsaWNhdGlvbg==", true);
     $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

     // Verify the provided signature matches the built signature
    if ($base64UrlSignature !== $signatureProvided) {
        throw new Exception("Invalid token signature");
    }

    return $payloadArray;
}

/**
     * Get a new token (public API method)
     * @param array $params
     * @return array
     * @throws Exception
     */

public static function getToken($params){
    $apiKey = $params['api_key'] ?? '';

    if (empty($apiKey)) {
        throw new Exception("API key is required");
    }

    // Verify API key here (e.g., by checking the database)
    // Assuming the API key is valid

    $token = self::generateToken($apiKey);

    return ['token' => $token];
}

public static function updateUserData($params)
{

    // Proceed with the update operation
    $apiKey = $_GET['api_key'] ?? '';

    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    if (empty($params)) {
        throw new Exception("No Data provided for update");
    }

    // Fetch user data based on the API key
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }

    // Define allowed fields
    $allowedFields = [
        'CompanyName', 'Phone', 'FullName', 'WebSite', 'Location_City',
        'Location_Country', 'CompanyDescription', 'PrivateSpace', 'Gender',
        'Gouvernorat', 'Location_State', 'Location_ZipCode', 'birth',
        'Location_Latitude', 'Location_Longitude', 'GooglePlace', 'Location'
    ];

    // Prepare the update query and values
    $updateFields = [];
    $updateValues = [];
    foreach ($allowedFields as $field) {
        if (isset($params[$field])) {
            $updateFields[] = "`$field` = ?s";
            $updateValues[] = $params[$field];
        }
    }

    if (empty($updateFields)) {
        throw new Exception("No valid fields provided for update");
    }

    // Add the API key to the end of the update values
    $updateValues[] = $apiKey;

    // Create the update query
    $updateQuery = "UPDATE users_featured SET " . implode(', ', $updateFields) . " WHERE api_key = ?s";

    // Execute the query
    $result = SJB_DB::query($updateQuery, ...$updateValues);
    
    if ($result === false) {
        error_log("Failed to update user data. Error: " );
        throw new Exception("Failed to update user data");
        
    }

    return ['message' => 'User data updated successfully'];
}
public static function uploadCompanyLogo($params)
{
    try {
        error_log("uploadCompanyLogo function called");
        error_log("POST data: " . print_r($_POST, true));
        error_log("FILES data: " . print_r($_FILES, true));

        $apiKey = $_GET['api_key'] ?? '';
        if (!$apiKey) {
            throw new Exception("Missing API Key");
        }

        // Fetch user data based on the API key
        $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
        if (!$userData) {
            throw new Exception("User Not Found");
        }
        $savedFileId='Logo_'.$userData[0]['sid'];

        // Check if file was uploaded
        if (!isset($_FILES['logo']) || $_FILES['logo']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("No 'logo' file uploaded or upload error occurred");
        }

        $file = $_FILES['logo'];

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
        }

        // Use the original filename
        $originalFilename = $file['name'];
        
        // Set upload directory
        $dateBasedDir = date('Y/m/d');
        $uploadDir =  SJB_BASE_DIR. 'files/pictures/' . $dateBasedDir . '/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception("Failed to create upload directory");
            }
        }
        $uploadPath = $uploadDir . $originalFilename;
        
        // Move the uploaded file
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new Exception("Failed to move uploaded file to: " . $uploadPath);
        }

        // Create a thumbnail
        $thumbnailPath = $uploadDir . pathinfo($originalFilename, PATHINFO_FILENAME) . '_thumb.' . pathinfo($originalFilename, PATHINFO_EXTENSION);

        self::createThumbnail($uploadPath, $thumbnailPath);
        // Set up temporary session storage
        $tmpUploadsStorage = SJB_Session::getValue('tmp_uploads_storage') ?? [];
        $formToken = uniqid('logo_upload_');
        $fieldId = 'Logo';  // Assuming 'Logo' is the field ID for the company logo
        $tmpUploadsStorage[$formToken][$fieldId] = [
            'file_id' => $originalFilename,
            'file_name' => $file['name'],
            'file_size' => $file['size'],
            'file_type' => $file['type']
        ];
        SJB_Session::setValue('tmp_uploads_storage', $tmpUploadsStorage);

        // Create a user object
        $user = new SJB_User($userData, $userData['user_group_sid']);
        $user->setSID($userData['sid']);

        // Correct the ID in the uploaded_files table
        $profilePropertyId = $fieldId . '_' . $userData['sid'];
        
        SJB_DB::query("DELETE FROM `uploaded_files` WHERE `id` = ?s", $savedFileId);
        $insertQuery = "INSERT INTO `uploaded_files` 
                        (`id`, `file_name`, `file_group`, `saved_file_name`, `mime_type`, `creation_time`) 
                        VALUES (?s, ?s, ?s, ?s, ?s, ?s)";

       
        
        $result = SJB_DB::query($insertQuery, 
                                $savedFileId, 
                                $file['name'],
                                'pictures',  
                                pathinfo($originalFilename,PATHINFO_FILENAME) ,  // Store the relative path
                                $file['type'],
                                time()
        
        );
        $result2 = SJB_DB::query($insertQuery, 
                                $savedFileId, 
                                $file['name'],
                                'pictures',  
                                pathinfo($originalFilename,PATHINFO_FILENAME).'_thumb' ,  // Store the relative path
                                $file['type'],
                                time()
    );
        if ($result === false) {
            error_log("Failed to insert into uploaded_files. Error: " );
            throw new Exception("Failed to update uploaded_files table");
        }

        // Set the logo property
        $user->setPropertyValue($fieldId, $profilePropertyId);

        // Save the user
        SJB_UserManager::saveUser($user);
        SJB_Authorization::updateCurrentUserSession();

        // Update users_featured table
        $updateQuery = "UPDATE users_featured SET Logo = ?s WHERE api_key = ?s";
        $result = SJB_DB::query($updateQuery, $savedFileId, $apiKey);

        if ($result === false) {
            error_log("Failed to update logo. Error: " );
            throw new Exception("Failed to update logo in users_featured table");
        }

        return [
            'message' => 'Company logo uploaded successfully',
            'filename' => $originalFilename,
            'path' => $dateBasedDir . '/' . $originalFilename,
            'form_token' => $formToken
        ];
    } catch (Exception $e) {
        error_log("Error in uploadCompanyLogo: " . $e->getMessage());
        throw $e;
    }
}

private static function createThumbnail($sourcePath, $thumbnailPath)
{
    $thumbnailWidth = 150; // Define thumbnail width

    list($width, $height) = getimagesize($sourcePath);
    $thumbnailHeight = intval($height * $thumbnailWidth / $width);

    $thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);

    $sourceImage = null;
    $fileType = mime_content_type($sourcePath);
    if ($fileType == 'image/jpeg') {
        $sourceImage = imagecreatefromjpeg($sourcePath);
    } elseif ($fileType == 'image/png') {
        $sourceImage = imagecreatefrompng($sourcePath);
    } elseif ($fileType == 'image/gif') {
        $sourceImage = imagecreatefromgif($sourcePath);
    }

    if ($sourceImage) {
        imagecopyresampled($thumbnail, $sourceImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $width, $height);
        imagejpeg($thumbnail, $thumbnailPath);
        imagedestroy($sourceImage);
    }
    imagedestroy($thumbnail);
}
/**
     * Get listings by user
     * @param $params
     * @return array
     */
    public static function get_user_listings()
    {
        $apiKey = $_GET['api_key'] ?? '';

        if (!$apiKey) {
            throw new Exception("Missing API Key");
        }
    // Fetch user data based on the API key
        $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
        if (!$userData) {
            throw new Exception("User Not Found");
        }

        $user_sid = $userData[0]['sid'];
        $result = SJB_DB::query("SELECT sid FROM listings WHERE user_sid = {$user_sid}");

        $listings = [];
        foreach ($result as $val) {
            $listing = SJB_ListingManager::getObjectBySID($val['sid']);
            $listing = SJB_ListingManager::createTemplateStructureForListing($listing);
            $listings[] = $listing;
        }        
        return $listings;
    }


    public static function get_user_listingById($params){
        $apiKey = $_GET['api_key'] ?? '';
        $listing_id=$params['listing_id'];
        if (!$apiKey ) {
            throw new Exception("Missing API Key");
        }
        if (!$listing_id ) {
            throw new Exception("Missing Listing_id");
        }
    // Fetch user data based on the API key
        $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
        if (!$userData) {
            throw new Exception("User Not Found");
        }

        $user_sid = $userData[0]['sid'];
        
        $result = SJB_DB::query("SELECT * FROM listings WHERE user_sid = {$user_sid} and sid={$listing_id}");     
        return $result;
    }



    private static function selectContract() {
        $apiKey = $_GET['api_key'] ?? '';
        if (!$apiKey) {
            throw new Exception("Missing API Key");
        }
        
        // Fetch user data based on the API key
        $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
        if (!$userData) {
            throw new Exception("User Not Found");
        }

        $contracts = SJB_ContractManager::getAllContractsInfoByUserSID($userData[0]['sid']);
        
        
    $availableContracts = array_map(function($contract) {
        $products_info=SJB_ProductsManager::getProductInfoBySID($contract['product_sid']);
        $remaining_listing=unserialize($contract['serialized_extra_info']);
        return [
            'contract_id' => $contract['id'],
            'product' =>$products_info['name'],
            'remaining_listing'=>$remaining_listing["number_of_listings"],
			'is_active' => ($remaining_listing["number_of_listings"] ?? null) > 0
             // Or relevant details about the contract
        ];
    }, $contracts);

    return ['success' => true, 'contracts' => $availableContracts];
    }    
    public static function addJobOffer($params) {
        $apiKey = $_GET['api_key'] ?? '';
        if (!$apiKey) {
            throw new Exception("Missing API Key");
        }
        
        // Fetch user data based on the API key
        $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
        if (!$userData) {
            throw new Exception("User Not Found");
        }
        $user_sid = $userData[0]['sid'];
        
        // Contract and listing number update logic
        $contractResult = self::selectContract();

        if (!$contractResult['success']) {
            throw new Exception("Could not retrieve contracts.");
        }

    // Assuming you want to use the first contract ID from the result
        
        $contracts = SJB_ContractManager::getInfo($params['contract_id']);
        //$contracts = SJB_ContractManager::getInfo($contractResult['contracts'][0]['contract_id']);
        $serializedInfo = unserialize($contracts['serialized_extra_info']);
        $nb_post = $contracts['number_of_postings'];
        
        if (isset($serializedInfo['number_of_listings']) && $serializedInfo['number_of_listings'] !== '') {
            $number_of_listings = intval($serializedInfo['number_of_listings']);
            
            if ($number_of_listings > 0) {
                $serializedInfo['number_of_listings'] = $number_of_listings - 1;
                $nb_post++;
        
                $serializedData = serialize($serializedInfo);
                SJB_DB::query("UPDATE contracts SET serialized_extra_info = ?s, number_of_postings = ?n WHERE id = ?n", $serializedData, $nb_post, $params['contract_id']);
                echo json_encode(["success" => true, "message" => "Listing updated successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "You have reached the maximum number of postings. Please renew your offer."]);
                return;
            }
        } else {
            SJB_DB::query("UPDATE contracts SET number_of_postings = ?n WHERE id = ?n", $nb_post, $params['contract_id']);
        }
    
        // Validate required fields
        $required_fields = ['id_Job_Vacancies', 'Title', 'GooglePlace', 'expiration_date', 'JobCategory', 'EmploymentType'];
        foreach ($required_fields as $field) {
            if (empty($params[$field])) {
                return ['error' => "Missing required field: $field"];
            }
        }
        
        // Validate multiple selections
        $multipleSelectionFields = [
            'JobCategory' => ['max' => 5, 'name' => 'job categories'],
            'EmploymentType' => ['max' => PHP_INT_MAX, 'name' => 'employment types'],
            'id_Job_Langue' => ['max' => 4, 'name' => 'languages']
        ];
        
        foreach ($multipleSelectionFields as $field => $config) {
            if (!empty($params[$field])) {
                $values = explode(',', $params[$field]);
                if (count($values) > $config['max'] && $config['max'] !== PHP_INT_MAX) {
                    return ['error' => "You can select a maximum of {$config['max']} {$config['name']}"];
                }
            }
        }
        $contract_id = intval($params['contract_id']);
        
        
        
        $cityResult = SJB_DB::query("SELECT name FROM `cities` WHERE sid=?n", $params['Location_ville']);
        $stateResult = SJB_DB::query("SELECT name FROM `states` WHERE sid=?n", $params['Location_gouvernorat']);
        $cityName = $cityResult ? $cityResult[0]['name'] : '';
        $stateName = $stateResult ? $stateResult[0]['name'] : '';
        $details = [
            'featured' => 0,
            'Title' => $params['Title'],
            'JobCategory' => $params['JobCategory'],
            'EmploymentType' => $params['EmploymentType'],
            'expiration_date' => date('Y-m-d 00:00:00', strtotime("+1 month")),
            'contract_id' => $contract_id,
            'views' => 0,
            'activation_date' => date('Y-m-d H:i:s'),
            'update_date' => date('Y-m-d H:i:s'),
            'date_add' => date('Y-m-d H:i:s', strtotime('-1 minute')),  // Slightly different timestamp
            'JobDescription' => $params['JobDescription'],
            'JobRequirements' => $params['JobRequirements'],
            'GooglePlace' => $params['GooglePlace'],
            'Location_City' => $cityName,
            'id_Job_Vacancies' => $params['id_Job_Vacancies'],
            'id_Job_Langue' => $params['id_Job_Langue'] ?? '',
            'id_Job_Experience' => $params['id_Job_Experience'] ?? '',
            'id_Job_Niveaudtude' => $params['id_Job_Niveaudtude'] ?? '',
            'id_Job_Rmunrationpropose' => $params['id_Job_Rmunrationpropose'] ?? '',
            'id_Job_Genre'=>$params['id_Job_Genre']??'',
            'id_Job_MotsCls' => $params['id_Job_MotsCls'],
            'Location_pays' =>1,
            'Location_gouvernorat' => $params['Location_gouvernorat'] ?? 0,
            'Location_ville' => $params['Location_ville'] ?? 0,
            'email_notify' => 1,
            'Location_ZipCode' => $params['Location_ZipCode'] ?? '',
            'Location_State' => $stateName,
            'Location_Country' => "Maroc",
            'Location' => "Maroc"." ".$stateName." ".$params['Location_ville']." ".$cityName." ".$params['Location_ZipCode'],
            'Location_Latitude' => $params['Location_Latitude'] ?? 0,
            'Location_Longitude' => $params['Location_Longitude'] ?? 0,
            
            
        ];
        // $post_value="";
        // $email=$params['email']??$userData[0]['email'];
        // $url=$params['url']??'';
        // $add_param=1;
        // if(isset($url)){
        //     $post_value=$email;
            
        // }else {
        //     $post_value= $url;
        //     $add_param=2;
        // }
        $post_value = "";
        $email = $params['email'] ?? $userData[0]['email'];
        $url = $params['url'] ?? '';
        $add_param = 1;

        if (!empty($url)) { // Check if URL is provided and not empty
            $post_value = $url;
            $add_param = 2;
        } else {
            $post_value = $email;
        }   
        $listing = new SJB_Listing($details, 6); // Assuming 6 is for job listings
        $listing->setUserSID($userData[0]['sid']);
        
        $product_info = [
            'listing_type_sid' => '6',
            'price' => '0.00',
            'post_job' => '1',
            'listing_duration' => '30',
            'featured' => '0',
            'featured_employer' => '0',
            'resume_access' => '0',
            'expiration_period' => '365',
            'product_sid' => '13'
        ];
        
        $listing->setProductInfo($product_info);
        $listing->details->addKeywordsProperty($params['Title'].$userData[0]['CompanyName'].$params['JobDescription'].$params['id_Job_MotsCls']);
        $contract =SJB_ContractManager::getInfo($contract_id) ;
		$contractID=$contract_id;
        $productSID=$contract['product_sid'];    
        $listing->deleteProperty('username');
        $listing->deleteProperty('product_sid');
        $productInfo = SJB_ProductsManager::getProductInfoBySID($productSID);
            $extraInfo = is_null($productInfo['serialized_extra_info']) ? null : unserialize($productInfo['serialized_extra_info']);
            if (!empty($extraInfo)) {
                $extraInfo['product_sid'] = $productSID;
            }

            $listing->setUserSID($user_sid);
            $listing->setProductInfo($extraInfo);

         SJB_ListingManager::saveListing($listing);
		 $listingSid = $listing->getSID();
   if ($contractID) {
             $contract = new SJB_Contract(['contract_id' => $contractID]);
             $contract->incrementPostingsNumber();
             SJB_ProductsManager::incrementPostingsNumber($contract->product_sid);
         }
         SJB_DB::query("UPDATE `listings_properties` SET `add_parameter` = '$add_param', `value` = '$post_value' WHERE `object_sid`=".$listingSid);
          $listing_sid =  $listingSid;

        
		
		
		
		
        if (!$listing_sid) {
            return ['error' => 'Failed to insert listing'];
        }else {
            $newListing=SJB_DB::query("SELECT `sid` From `listings` WHERE user_sid=?n ORDER BY `sid` DESC 
            LIMIT 1",$userData[0]['sid']);
            $listing_id=$newListing[0]['sid'];
            $newListing = SJB_DB::query("SELECT sid FROM listings WHERE user_sid=?n ORDER BY sid DESC LIMIT 1", $userData[0]['sid']);
            $listing_id = $newListing[0]['sid'];
            $update_result = SJB_DB::query(
                "UPDATE `listings` 
                 SET contract_id = ?n,id_Job_MotsCls= ?s,
                     Location_ZipCode = ?s, 
                     Location_Country = ?s, 
                     Location = ?s, 
                     Location_pays = ?n, 
                     Location_gouvernorat = ?n,
                     Location_State = ?s,
                     Location_City = ?n,
                     Location_ville = ?n
                 WHERE sid = ?n",
                $contract_id, $params['id_Job_MotsCls'],
                $params['Location_ZipCode'] ?? '',
                'Maroc',
                'Maroc ' . ($stateName ?? '') . ' ' . ($params['Location_ville'] ?? '') . ' ' . ($cityName ?? '') . ' ' . ($params['Location_ZipCode'] ?? ''),
                1,
                $params['Location_gouvernorat'],
                $stateName ,
                $cityName ,
                $params['Location_ville'],
                $listing_id
            );
            SJB_ListingManager::setStatus($listing_id,2);
        }
    
        return ['success' => true, 'listing_sid' => $listing_sid];
    }    

  



/**
 * Delete a user's listing
 * @return bool
 */

public static function delete_user_all_listings(){
    $apiKey = $_GET['api_key'] ?? '';
    if (!$apiKey) {
        throw new Exception("Missing API Key or Public ID");
    }
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }
    $user_sid = $userData[0]['sid'];

    $listingSids=SJB_DB::query("DELETE FROM `listings` WHERE user_sid=?n",$user_sid);
     return ['success' => true, 'listing_sid' => $listingSids];


}
    
/**
 * Delete a user's listing
 * @return bool
 */
public static function delete_user_listing($params)
{
    $apiKey = $_GET['api_key'] ?? '';
    $listing_id=$params['listing_sid']??'';

    

    if (!$apiKey|| !$listing_id) {
        throw new Exception("Missing API Key or Public ID");
    }
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }

    return SJB_DB::query("UPDATE `listings` set active = ?n WHERE `sid`=?n",0,$listing_id);
    
}

public static function retrive_applications_byJobs()
{
        // Get API Key from the request
        $apiKey = $_GET['api_key'] ?? '';
        if (!$apiKey) {
            throw new Exception("Missing API Key");
        }
    
        // Fetch user data based on the provided API key
        $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
        if (!$userData) {
            throw new Exception("User Not Found");
        }
    
        // Get the user SID
        $user_sid = $userData[0]['sid'];
    
        // Fetch the active listings by user SID
        $listings = SJB_ListingManager::getActiveListingsByUserSID($user_sid);
        $applications = [];
    
        if (!empty($listings)) {
            foreach ($listings as $list) {
                $listing_id = $list->getSID();
                $applicationsByJob =SJB_Applications::getByJob($listing_id);
                if (!empty($applicationsByJob)) {
                    foreach ($applicationsByJob as &$application) {
                        // Fetch jobseeker details from users table using jobseeker_id
                        $jobseeker_id = $application['jobseeker_id'];
                        $jobSeekerData=SJB_UserManager::getUserInfoBySID($jobseeker_id);

                         
                        print_r($jobSeekerData[0]);
                        // If jobseeker details are found, merge them into the application data
                        if (!empty($jobSeekerData)) {
                            
                            $application['jobseeker_details'] = $jobSeekerData;
                        }
                        if (!empty($application)) {
                            
                            $applications[] = $application;
                        
                        }
                    }
                }
            }
        } else {
            throw new Exception("No active listings found for the user.");
        }
    
        // Return the applications array
        return $application;
}
public static function retrive_applications_byJob($params)
{
    // Get API Key from the request
    $apiKey = $_GET['api_key'] ?? '';
    $listing_id = $params['listing_id'];
    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }
    if (!$listing_id) {
        throw new Exception("Missing params");
    }

    // Fetch user data based on the provided API key
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }

    // Get the user SID
    $user_sid = $userData[0]['sid'];

    $applications = [];

    // Fetch applications for the specific listing_id
    $applicationsByJob = SJB_Applications::getByJob($listing_id);
    if (!empty($applicationsByJob)) {
        foreach ($applicationsByJob as &$application) {
            // Fetch jobseeker details from users table using jobseeker_id
            $jobseeker_id = $application['jobseeker_id'];
            $jobSeekerData = SJB_UserManager::getUserInfoBySID($jobseeker_id);

            // If jobseeker details are found, merge them into the application data
            if (!empty($jobSeekerData)) {
                $application['jobseeker_details'] = $jobSeekerData;
            }

            // Add the modified application to the result array
            if (!empty($application)) {
                $applications[] = $application;
            }
        }
    } else {
        throw new Exception("No applications found for the specified job listing.");
    }

    // Return all applications
    return $applications;
}


public static function getCandidatsDetails($params){
    $apiKey = $_GET['api_key'] ?? '';
    $candidat = $params['id'] ?? '';
    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    $jobSeekerData = SJB_UserManager::getUserInfoBySID($candidat);
    return $jobSeekerData;
    

}
public static function update_job_application_status    ($params) {
    // Get the API key and parameters
    $apiKey = $_GET['api_key'] ?? '';
    $app = $params['app_id'] ?? '';
    $selected_stage = $params['status'] ?? 'Nouveau';

    // Define an array of valid statuses
    $validStatuses = [
        'Nouveau', 
        'Interview', 
        'Sélectionné',  // Proper UTF-8 encoding
        'Disqualifié'    // Proper UTF-8 encoding
    ];

    // Check if API key is provided
    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    if (!in_array($selected_stage, $validStatuses)) {
        return [
            "error" => true,
            "message" => "The selected status must be one of the following values: [Nouveau (initial status), Interview (Pre-selected), S├®lectionn├® (Selected), Disqualifié (Rejected)]"
        ];
    }

    // Update the application status
    $application = SJB_Applications::setStatus($app, $selected_stage, 0.5);

    // Return success response
    return [
        "success" => true,
        "message" => "Success: Application status updated to " . $selected_stage
    ];
}

	
	public static function downloadResume($params) {
    error_log("Received params: " . print_r($params, true)); // Debug log
    $apiKey = $_GET['api_key'] ?? '';
    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    // Get the resume ID (profile resume or application resume)
    $resumeId = $params['applicationResume'] 
        ?? $params['params']['applicationResume'] 
        ?? null;

    if (!$resumeId) {
        $input = file_get_contents('php://input');
        error_log("Raw input: " . $input); // Debug log
        $body = json_decode($input, true);
        $resumeId = $body['params']['applicationResume'] ?? '';
        error_log("Received resumeId from body: " . $resumeId); // Debug log
    }
    if (!$resumeId) {
        throw new Exception("Missing resume ID");
    }

    // Fetch file data from the database
    $fileData = SJB_DB::query("SELECT * FROM uploaded_files WHERE id=?s", $resumeId);
    if (empty($fileData)) {
        throw new Exception("File not found in uploaded_files for ID: " . $resumeId);
    }
    error_log("File data: " . print_r($fileData, true)); // Debug log

    // Fetch listing_id from applications table
    $listing = SJB_DB::query("SELECT listing_id FROM applications WHERE file_id=?s", $resumeId);
    if (empty($listing)) {
        throw new Exception("No listing found for applicationResume: " . $resumeId);
    }
    $listingId = $listing[0]['listing_id'];
    error_log("Retrieved listing_id: " . $listingId); // Debug log

    // Extract file details
    $fileName = $fileData[0]['file_name'];
    $fileName = str_replace(' ', '_', $fileName);
    $mimeType = $fileData[0]['mime_type'];

	$listingData =SJB_DB::query("SELECT * From `listings` WHERE sid=?n ",$listingId);
    if (empty($listingData)) {
        throw new Exception("No listing data found for ID: " . $listingId);
    }

    $dateAdded = $listingData[0]['date_add'];
    if (!$dateAdded) {
        throw new Exception("Missing date_add for listing: " . $listingId);
    }

    try {
        $listingDate = new DateTime($dateAdded);
        $year = $listingDate->format('Y');
        $month = $listingDate->format('m');
        $day = $listingDate->format('d');
    } catch (Exception $e) {
        throw new Exception("Invalid date format in listing: " . $dateAdded);
    }
    // Construct the full file path (directory + file name)
    $filePath = SJB_BASE_DIR . 'files/applications/' . $year . '/' . $month . '/' . $day . '/' . $listingId . '/' . $fileName;
    error_log("Constructed file path: " . $filePath); // Debug log

    // Check if the file exists
    if (!file_exists($filePath)) {
        throw new Exception("File does not exist on the server: " . $filePath);
    }

    // Send file headers
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Expires: 0');
    header('Accept-Ranges: bytes');

    // Read and output the file to the browser
    readfile($filePath);
    exit;
}
	
	/*public static function downloadResume($params) {
    error_log("Received params: " . print_r($params, true)); // Debug log
    $apiKey = $_GET['api_key'] ?? '';
    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    // Get the resume ID (profile resume or application resume)
    $resumeId = $params['applicationResume'] 
        ?? $params['params']['applicationResume'] 
        ?? null;

    if (!$resumeId) {
        $input = file_get_contents('php://input');
        error_log("Raw input: " . $input); // Debug log
        $body = json_decode($input, true);
        $resumeId = $body['params']['applicationResume'] ?? '';
        error_log("Received resumeId from body: " . $resumeId); // Debug log
    }
    if (!$resumeId) {
        throw new Exception("Missing resume ID");
    }

    // Fetch file data from the database
    $fileData = SJB_DB::query("SELECT * FROM uploaded_files WHERE id=?s", $resumeId);
    if (empty($fileData)) {
        throw new Exception("File not found in uploaded_files for ID: " . $resumeId);
    }
    error_log("File data: " . print_r($fileData, true)); // Debug log

    // Fetch listing_id from applications table
    $listing = SJB_DB::query("SELECT listing_id FROM applications WHERE file_id=?s", $resumeId);
    if (empty($listing)) {
        throw new Exception("No listing found for applicationResume: " . $resumeId);
    }
    $listingId = $listing[0]['listing_id'];
    error_log("Retrieved listing_id: " . $listingId); // Debug log

    // Extract file details
    $fileName = $fileData[0]['file_name'];
    $fileName = str_replace(' ', '_', $fileName);
    $mimeType = $fileData[0]['mime_type'];
    $creationTime = $fileData[0]['creation_time'];

    // Format creation time to build the file path
    $year = date('Y', $creationTime);
    $month = date('m', $creationTime);
    $day = date('d', $creationTime);

    // Construct the full file path (directory + file name)
    $filePath = SJB_BASE_DIR . 'files/applications/' . $year . '/' . $month . '/' . $day . '/' . $listingId . '/' . $fileName;
    error_log("Constructed file path: " . $filePath); // Debug log

    // Check if the file exists
    if (!file_exists($filePath)) {
        throw new Exception("File does not exist on the server: " . $filePath);
    }

    // Send file headers
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Expires: 0');
    header('Accept-Ranges: bytes');

    // Read and output the file to the browser
    readfile($filePath);
    exit;
}*/



	
	
/*public static function downloadResume($params) {
    $apiKey = $_GET['api_key'] ?? '';
    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    // Get the resume ID (profile resume or application resume)
    $resumeId = $params['applicationResume'];
    error_log("Received resumeId: " . $resumeId); // Debug log

    // Fetch file data from the database
    $fileData = SJB_DB::query("SELECT * FROM uploaded_files WHERE id=?s", $resumeId);
    if (empty($fileData)) {
        throw new Exception("File not found in uploaded_files for ID: " . $resumeId);
    }
    error_log("File data: " . print_r($fileData, true)); // Debug log

    // Fetch listing_id from applications table
    $listing = SJB_DB::query("SELECT listing_id FROM applications WHERE file_id=?s", $resumeId);
    if (empty($listing)) {
        throw new Exception("No listing found for applicationResume: " . $resumeId);
    }
    $listingId = $listing[0]['listing_id'];
    error_log("Retrieved listing_id: " . $listingId); // Debug log

    // Extract file details
    $fileName = $fileData[0]['file_name'];
    $fileName = str_replace(' ', '_', $fileName);
    $mimeType = $fileData[0]['mime_type'];
    $creationTime = $fileData[0]['creation_time'];

    // Format creation time to build the file path
    $year = date('Y', $creationTime);
    $month = date('m', $creationTime);
    $day = date('d', $creationTime);

    // Construct the full file path (directory + file name)
    $filePath = SJB_BASE_DIR . 'files/applications/' . $year . '/' . $month . '/' . $day . '/' . $listingId . '/' . $fileName;
    error_log("Constructed file path: " . $filePath); // Debug log

    // Check if the file exists
    if (!file_exists($filePath)) {
        throw new Exception("File does not exist on the server: " . $filePath);
    }

    // Send file headers
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Expires: 0');
    header('Accept-Ranges: bytes');

    // Read and output the file to the browser
    readfile($filePath);
    exit;
}*/
/*public static function updateJobOffer($params) {
    $apiKey = $_GET['api_key'] ?? '';
    $listing_sid = $params['listing_sid'] ?? null;

    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    if (!$listing_sid) {
        throw new Exception("Missing Listing SID");
    }

    // Fetch user data based on the API key
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }

    // Fetch listing based on listing SID
    $listingData = SJB_DB::query("SELECT * FROM listings WHERE sid=?n", $listing_sid);
    if (!$listingData) {
        return ['error' => 'Job listing not found'];
    }
	if ($listingData[0]['active'] == 0) {
    SJB_DB::query("UPDATE listings SET active = 1 WHERE sid = ?n", $listing_sid);
    // Refresh listing data after activation
    $listingData = SJB_DB::query("SELECT * FROM listings WHERE sid=?n", $listing_sid);
}

    // Validate and prepare the fields to update
    $allowedFields = [
        'Title', 'id_Job_Vacancies', 'EmploymentType', 'JobCategory', 'GooglePlace',
        'JobDescription', 'Location_City', 'Location_Ville', 'Location_gouvernorat',
        'Location_ZipCode', 'Location_State', 'JobRequirements', 'id_Job_Experience',
        'id_Job_Niveaudtude', 'id_Job_Rmunrationpropose', 'id_Job_Langue', 'id_Job_Genre', 'id_Job_MotsCls'
    ];

    $updateData = [];
    foreach ($allowedFields as $field) {
        if (isset($params[$field])) {
            $updateData[$field] = $params[$field];
        }
    }

    // Handle Location Formatting
    $cityResult = SJB_DB::query("SELECT name FROM `cities` WHERE sid=?n", $params['Location_ville'] ?? $listingData[0]['Location_ville']);
    $stateResult = SJB_DB::query("SELECT name FROM `states` WHERE sid=?n", $params['Location_gouvernorat'] ?? $listingData[0]['Location_gouvernorat']);
    $cityName = $cityResult ? $cityResult[0]['name'] : '';
    $stateName = $stateResult ? $stateResult[0]['name'] : '';
    $updateData['Location'] = 'Maroc ' . ($stateName ?? '') . ' ' . ($cityName ?? '') . ' ' . ($params['Location_ZipCode'] ?? $listingData[0]['Location_ZipCode']);

    // Construct Update Query
    $updateQuery = "UPDATE `listings` SET ";
    $updateValues = [];
    foreach ($updateData as $field => $value) {
        $updateQuery .= "`$field` = ?s, ";
        $updateValues[] = $value;
    }
    $updateQuery = rtrim($updateQuery, ', ') . " WHERE sid = ?n";
    $updateValues[] = $listing_sid;

    $updateResult = SJB_DB::query($updateQuery, ...$updateValues);

    if (!$updateResult) {
        return ['error' => 'Failed to update listing'];
    }

    $post_value = "";
    $email = $params['email'] ?? $userData[0]['email'];
    $url = $params['url'] ?? '';
    $add_param = 1;

    if (!empty($url)) { // Check if URL is provided and not empty
        $post_value = $url;
        $add_param = 2;
    } else {
        $post_value = $email;
    } 

    SJB_DB::query("UPDATE `listings_properties` SET `add_parameter` = ?n, `value` = ?s WHERE `object_sid` = ?n", $add_param, $post_value, $listing_sid);

    // Optionally: Update status
    SJB_ListingManager::setStatus($listing_sid, 2);

    return ['success' => true, 'listing_sid' => $listing_sid];
}
*/
	public static function updateJobOffer($params) {
    $apiKey = $_GET['api_key'] ?? '';
    $listing_sid = $params['listing_sid'] ?? null;

    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    if (!$listing_sid) {
        throw new Exception("Missing Listing SID");
    }

    // Fetch user data based on the API key
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }

    // Fetch listing with user verification to prevent cross-user updates
    $listingData = SJB_DB::query(
        "SELECT * FROM listings WHERE sid=?n AND user_sid=?n", 
        $listing_sid,
        $userData[0]['sid']
    );
    
    if (!$listingData) {
        return [
            'result' => 'error',
            'message' => 'Job listing not found or not owned by user',
            'code' => 'job_not_found'
        ];
    }

    // Reactivate if listing was soft-deleted
    if ($listingData[0]['active'] == 0) {
        SJB_DB::query("UPDATE listings SET active = 1 WHERE sid = ?n", $listing_sid);
        // Refresh listing data after activation
        $listingData = SJB_DB::query("SELECT * FROM listings WHERE sid=?n", $listing_sid);
    }

    // Validate and prepare the fields to update
    $allowedFields = [
        'Title', 'id_Job_Vacancies', 'EmploymentType', 'JobCategory', 'GooglePlace',
        'JobDescription', 'Location_City', 'Location_Ville', 'Location_gouvernorat',
        'Location_ZipCode', 'Location_State', 'JobRequirements', 'id_Job_Experience',
        'id_Job_Niveaudtude', 'id_Job_Rmunrationpropose', 'id_Job_Langue', 'id_Job_Genre', 'id_Job_MotsCls'
    ];

    $updateData = [];
    foreach ($allowedFields as $field) {
        if (isset($params[$field])) {
            $updateData[$field] = $params[$field];
        }
    }

    // Handle Location Formatting
    $cityResult = SJB_DB::query("SELECT name FROM `cities` WHERE sid=?n", 
        $params['Location_ville'] ?? $listingData[0]['Location_ville']);
    $stateResult = SJB_DB::query("SELECT name FROM `states` WHERE sid=?n", 
        $params['Location_gouvernorat'] ?? $listingData[0]['Location_gouvernorat']);
    
    $cityName = $cityResult ? $cityResult[0]['name'] : '';
    $stateName = $stateResult ? $stateResult[0]['name'] : '';
    
    $updateData['Location'] = 'Maroc ' . ($stateName ?? '') . ' ' . ($cityName ?? '') . ' ' .
        ($params['Location_ZipCode'] ?? $listingData[0]['Location_ZipCode']);

    // Construct Update Query with strict WHERE clause
    $updateQuery = "UPDATE `listings` SET ";
    $updateValues = [];
    foreach ($updateData as $field => $value) {
        $updateQuery .= "`$field` = ?s, ";
        $updateValues[] = $value;
    }
    $updateQuery = rtrim($updateQuery, ', ') . " WHERE sid = ?n AND user_sid = ?n";
    $updateValues[] = $listing_sid;
    $updateValues[] = $userData[0]['sid'];

    $updateResult = SJB_DB::query($updateQuery, ...$updateValues);

    if (!$updateResult) {
        return [
            'result' => 'error',
            'message' => 'Failed to update listing',
            'db_error' => SJB_DB::getError()
        ];
    }

    // Update application method
    $post_value = "";
    $email = $params['email'] ?? $userData[0]['email'];
    $url = $params['url'] ?? '';
    $add_param = 1;

    if (!empty($url)) {
        $post_value = $url;
        $add_param = 2;
    } else {
        $post_value = $email;
    } 

    SJB_DB::query(
        "UPDATE `listings_properties` SET `add_parameter` = ?n, `value` = ?s 
         WHERE `object_sid` = ?n",
        $add_param, $post_value, $listing_sid
    );

    // Set status to pending (2)
    SJB_ListingManager::setStatus($listing_sid, 2);

    // Return consistent response format
    return [
        'result' => 'success',
        'function_result' => [
            'success' => true,
            'listing_sid' => $listing_sid  // Return original SID, not a new one
        ]
    ];
}

public static function getAllApplicationsByJobSekkerId($params){
    $apiKey = $_GET['api_key'] ?? '';
    $user_sid = $params['jobbseeker_id'];

    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    // Fetch user data based on the API key
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }
    $applications=SJB_DB::query("SELECT * FROM applications WHERE jobseeker_id=?n",$user_sid);

    return $applications;


}
public static function getJobDetails($params){
    $apiKey = $_GET['api_key'] ?? '';
    $listing_sid = $params['listing_id'];

    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    $listingData = SJB_DB::query("SELECT title FROM listings WHERE sid=?n", $listing_sid);

    
    return $listingData;

}

public static function getListingProperty($params){
    $apiKey = $_GET['api_key'] ?? '';
    $listing_sid = $params['listing_id'];

    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    $listingData = SJB_DB::query("SELECT * FROM listings_properties WHERE object_sid=?n", $listing_sid);

    
    return $listingData;
}
public static function markJobDeleted($params){
    $apiKey = $_GET['api_key'] ?? '';
    $listing_sid = $params['listing_sid'] ?? null;

    if (!$apiKey) {
        throw new Exception("Missing API Key");
    }

    if (!$listing_sid) {
        throw new Exception("Missing Listing SID");
    }

    // Fetch user data based on the API key
    $userData = SJB_DB::query("SELECT * FROM users_featured WHERE api_key=?s", $apiKey);
    if (!$userData) {
        throw new Exception("User Not Found");
    }

    // Fetch listing based on listing SID
    $listingData = SJB_DB::query("SELECT * FROM listings WHERE sid=?n", $listing_sid);
    if (!$listingData) {
        return ['error' => 'Job listing not found'];
    }

        SJB_ListingManager::setStatus($listing_sid, 0);

        return ['success' => true, 'listing_sid' => $listing_sid];

}
}

