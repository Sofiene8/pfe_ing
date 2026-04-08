<?php

class SJB_Classifieds_DisplayListing extends SJB_Function
{

    public function isAccessible()
    {
        $listingTypeID = SJB_Array::get($this->params, 'listing_type_id');
        if ($listingTypeID) {
            if ($listingTypeID == 'Resume' && !SJB_Settings::getValue('public_resume_access')) {
                $this->setPermissionLabel('resume_access');
            }
            $allow = parent::isAccessible();
            $listingID = SJB_Request::getVar('listing_id', false);
            $passedParametersViaUri = SJB_Request::getVar('passed_parameters_via_uri', false);
            if (!$listingID && $passedParametersViaUri) {
                $passedParametersViaUri = SJB_UrlParamProvider::getParams();
                if (isset($passedParametersViaUri[0])) {
                    $listingID = $passedParametersViaUri[0];
                }
            }
            if (!is_numeric($listingID)) {
                echo SJB_System::executeFunction('miscellaneous', '404_not_found');
                exit();
            }
            if (SJB_UserManager::isUserLoggedIn()) {
                $currentUser = SJB_UserManager::getCurrentUser();
                if (!$allow && 'Resume' == $listingTypeID && $listingID) {
                    // if view resume not allowed by ACL, check applications table
                    // for current resume ID, applied for one of current user jobs
                    // if present in applications - allow current user to view resume
                    // check for all jobs of current user

                    $listings = SJB_ListingDBManager::getListingsSIDByUserSID($currentUser->getSID());
                    if (in_array($listingID, $listings) || SJB_Applications::isListingAppliedForCompany($listingID, $currentUser->getSID())) {
                        return true;
                    }
                }
            }
            return $allow;
        }

        return parent::isAccessible();
    }

    public function execute()
    {
	
        $tp = SJB_System::getTemplateProcessor();
        $tp->assign('searchID', SJB_Request::getVar('searchID', false));
        $tp->assign('backPage', SJB_Request::getInt('backPage', false));
        $display_form = new SJB_Form();
        $display_form->registerTags($tp);
        $errors = [];
        $template = SJB_Request::getVar('display_template', 'display_listing.tpl');
        $listing_id = SJB_Request::getVar("listing_id");
	
		
        if (isset($_REQUEST['passed_parameters_via_uri'])) {
            $passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
            $listing_id = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] : null;
        }

       $currentUser = SJB_UserManager::getCurrentUser();
	  if($currentUser)
	  {
		$CounterCvAccess = $currentUser->getUserInfo()["CounterCvAccess"]?$currentUser->getUserInfo()["CounterCvAccess"]:-1;
		if(isset($_GET["voircv"]) && $_GET["voircv"])
		{
			$sql = "SELECT * FROM  user_listing WHERE user_id = ".$currentUser->getUserInfo()['sid']." and listing_id =".$_GET["listing_id"];
			$res  = SJB_DB::query($sql);
			$sql = "SELECT app.id FROM  applications app
			inner join listings l on (app.listing_id = l.sid)
			WHERE l.user_sid = ".$currentUser->getUserInfo()['sid']." and app.resume =".$_GET["listing_id"];
			$res1  = SJB_DB::query($sql);
			if(!$res || !$res1 && intval($CounterCvAccess)>0)
		{
				$CounterCvAccess = intval($CounterCvAccess)-1;

				SJB_DB::query("UPDATE `users` SET `CounterCvAccess`= ?s WHERE `sid` = ?s", $CounterCvAccess, $currentUser->getUserInfo()['sid']);
				SJB_DB::query("INSERT INTO user_listing SET user_id = ?s, listing_id = ?n, date_add = NOW()", $currentUser->getUserInfo()['sid'], $_GET["listing_id"]);
				die("1");
			}elseif($res || $res1 )
		{
				die("2");
		}else
			die("0");
		}

		if(SJB_Array::get($this->params, 'listing_type_id') == 'Resume' && $listing_id)
		{
	
			
					
		
		
			$sql = "SELECT * FROM  user_listing WHERE user_id = ".$currentUser->getUserInfo()['sid']." and listing_id =".$listing_id;
			$res  = SJB_DB::query($sql);
			$sql = "SELECT app.id FROM  applications app
			inner join listings l on (app.listing_id = l.sid)
			WHERE l.user_sid = ".$currentUser->getUserInfo()['sid']." and app.resume =".$listing_id;
			$res1  = SJB_DB::query($sql);
			$sql2 = "SELECT * FROM  listings WHERE user_sid = ".$currentUser->getUserInfo()['sid']." and sid =".$listing_id;
			$res2  = SJB_DB::query($sql2);
			$tp->assign('is_my_resume', (bool)($res || $res1 || $res2));
			
				
		}
}
        if (is_null($listing_id)) {
            $errors['404'] = true;
        } elseif (is_null($listing = SJB_ListingManager::getObjectBySID($listing_id)) || !SJB_ListingManager::isListingAccessableByUser($listing_id, SJB_UserManager::getCurrentUserSID())) {
            $errors['404'] = true;
        } elseif (!$listing->isActive() && $listing->getUserSID() != SJB_UserManager::getCurrentUserSID() && (SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid) != 'Job')&& (SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid) != 'Training')) {
            $errors['404'] = true;
        } elseif ((SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid) == 'Resume' && ($template == 'display_job.tpl')) ||
            (SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid) == 'Job' && ($template == 'display_resume.tpl'))
        ) {
		
            SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . SJB_TemplateProcessor::listing_url($listing));
        } else {
			
            $listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid);
            // $color=$listing->details->properties['modele_color'];
			//template modele cv
			 if ($listing_type_id == 'Resume') {
			
				$color=$listing->details->properties['modele_color'];
				$modele=$listing->details->properties['resume_modele_sid'];
				$resumeModel = SJB_DB::query("SELECT * FROM resume_models where sid=".$modele->value); 
				$resumeColor = SJB_DB::query("SELECT * FROM  resume_colors where `sid`=".$color->value );
				
				if(!empty($resumeModel)&&$resumeModel[0]['sid'])
				$template='display_resume_'.$resumeModel[0]['sid'].'.tpl';
			else
                $template = 'display_resume.tpl';
				
				
				$tp->assign('resumeColor', (!empty($resumeColor))?$resumeColor[0]:null);
			
				$tp->assign('resumeModel', (!empty($resumeModel))?$resumeModel[0]:null);
			
			}
		
            // canonical url goes here
            if ($listing_type_id == 'Job') {
                $listingUrl = SJB_TemplateProcessor::listing_url($listing);

                if (strpos(rawurldecode(SJB_Navigator::getURIThis()), $listingUrl) === false) {
                    SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . $listingUrl, SJB_HelperFunctions::REDIRECT_302);
                }
            }

//            echo '<pre>';var_dump($listing->getPropertyValue('Location'));echo '</pre>';
            $googlePlace = $listing->getPropertyValue('GooglePlace');
            if (empty($googlePlace)) {

                \SJB\Location\Helper::fixLocation($listing);
//                echo '<pre>';var_dump($listing->getPropertyValue('GooglePlace'));echo '</pre>';

                $listing_type_sid = $listing->getListingTypeSID();
                if (!is_null($listing_type_sid)) {
                    SJB_ObjectDBManager::saveObject('listings', $listing, false, []);
                    SJB_Cache::getInstance()->clean('matchingAnyTag', [SJB_Cache::TAG_LISTINGS]);
//                    $listing = SJB_ListingManager::getObjectBySID($listing_id);
                }

            }
//            echo '<pre>';var_dump($listing->getPropertyValue('GooglePlace'));echo '</pre>';
            $display_form = new SJB_Form($listing);

            $display_form->registerTags($tp);

            $pages = SJB_PostingPagesManager::getPagesByListingTypeSID($listing->getListingTypeSID());
            $form_fields = [];
            foreach ($pages as $page) {
                $form_fields = array_merge(SJB_PostingPagesManager::getAllFieldsByPageSIDForForm($page['sid']), $form_fields);
            }


            $listingOwner = SJB_UserManager::getObjectBySID($listing->user_sid);

			
        // get Applications
        $appsGroups = SJB_Applications::getAppGroupsByEmployer($listing->user_sid);
        $apps = [];
        foreach ($appsGroups as $group) {
            $apps[$group['listing_id']] = $group['count'];
        }
		$count_new = SJB_DB::query('select count(*) as total from `applications` where `status` = "Nouveau"  and `listing_id`='.$listing_id);
		$count_rejected = SJB_DB::query('select count(*) as total from `applications` where `status` = "Disqualifié"  and `listing_id`='.$listing_id);
		$count_interview = SJB_DB::query('select count(*) as total from `applications` where `status` = "Interview"  and `listing_id`='.$listing_id);
		$count_selected = SJB_DB::query('select count(*) as total from `applications` where `status` = "Selectionné"  and `listing_id`='.$listing_id);
		$count_seen = SJB_DB::query('select count(*) as total from `applications` where ( `status` = "Interview" or `status` = "Disqualifié" or `status` = "Selectionné" ) and `listing_id`='.$listing_id);
		$count_applicants = SJB_DB::query('select count(*) as total from `applications` where  `listing_id`='.$listing_id);
		

			//var_dump($listing->user_sid);exit;
            SJB_ListingManager::incrementViewsCounterForListing($listing_id);
            $listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
            $filename = SJB_Request::getVar('filename', false);
            if ($filename) {
                $file = SJB_UploadFileManager::openFile($filename, $listing_id);
                $errors['NO_SUCH_FILE'] = true;
            }

            $metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
            $tp->assign(
                "METADATA", [
                "listing" => $metaDataProvider->getMetaData($listing_structure['METADATA']),
                "form_fields" => $metaDataProvider->getFormFieldsMetadata($form_fields)
            ]);

			
	
            $page = SJB_Request::getVar("page", "");
		
            $tp->assign("isApplied", SJB_Applications::isApplied($listing_id, SJB_UserManager::getCurrentUserSID()));
            $tp->assign('listing_id', $listing_id);
            $tp->assign("form_fields", $form_fields);
            $tp->assign('uri', base64_encode(SJB_Navigator::getURIThis()));
            $tp->assign('listingOwner', $listingOwner);
			$tp->assign('apps', $apps);
			$tp->assign('count_new', $count_new[0]['total']);
			$tp->assign('count_rejected', $count_rejected[0]['total']);
			$tp->assign('count_selected', $count_selected[0]['total']);
			$tp->assign('count_seen', $count_seen[0]['total']);
			$tp->assign('count_interview', $count_interview[0]['total']);
			$tp->assign('count_applicants', $count_applicants[0]['total']);
			$tp->assign('update_date', $listing->getUpdateDate());
			$tp->assign('update_date_3month', strtotime($listing->getUpdateDate()));
			$tp->assign('today_date_3month', strtotime('-3 month'));
			  $currentUser = SJB_UserManager::getCurrentUser();
			  
			if(SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid) == 'Resume')
			{
			$percentage = SJB_ListingManager::getListingPercentage($listing_id);
			$tp->assign('percentage', $percentage);
			}
            // SJB-1197: ajax autoupload.
            // Fix to view file from temporary uploaded storage.
            $sessionFilesStorage = SJB_Session::getValue('tmp_uploads_storage');

            // NEED TO CHECK FOR COMPLEX PARENT AND COMPLEX STEP PARAMETERS!
            $complexParent = SJB_Request::getVar('complexParent');
            $complexStep = SJB_Request::getVar('complexEnum');
            $fieldId = SJB_Request::getVar('field_id');
            $isComplex = false;
            if ($complexParent && $complexStep) {
                $fieldId = $complexParent . ":" . $fieldId . ":" . $complexStep;
                $isComplex = true;
            }
            $tempFileValue = SJB_Array::getPath($sessionFilesStorage, "listings/{$listing_id}/{$fieldId}");

            if ($isComplex) {
            } else {
                if (!empty($tempFileValue)) {
                    $fileUniqueId = isset($tempFileValue['file_id']) ? $tempFileValue['file_id'] : '';
                    if (!empty($fileUniqueId)) {
                        $upload_manager = new SJB_UploadFileManager();

                        // file structure for file
                        $fileInfo = [
                            'file_url' => $upload_manager->getUploadedFileLink($fileUniqueId),
                            'file_name' => $upload_manager->getUploadedFileName($fileUniqueId),
                            'saved_file_name' => $upload_manager->getUploadedSavedFileName($fileUniqueId),
                            'file_id' => $fileUniqueId,
                        ];
                        $listing_structure[$fieldId] = $fileInfo;
                    }
                }
            }
            // SJB-1197
        //  var_dump($listing_structure);exit;
            $tp->filterThenAssign("listing", $listing_structure);
            $tp->assign("page", $page);
			$EmploymentType=$listing_structure['EmploymentType'];
			$Type="";
		foreach($EmploymentType as $key=>$value)
		{
		$Type=$value;
		}

            if ($listing->getListingTypeSID() == SJB_ListingTypeManager::JOB) {
				if($listing->isActive())
			  {
                $listingInfo = [
                    '@context' => 'http://schema.org',
                    '@type' => 'JobPosting',
                    'datePosted' => $listing_structure['activation_date'],
					'validThrough' => $listing_structure['expiration_date'],
                    'description' => strip_tags($listing_structure['JobDescription']),
                    'employmentType' => $Type,
                    'title' => $listing_structure['Title'],
                    'url' => SJB_HelperFunctions::getUserSiteUrl() . $listingUrl,
                    'jobLocation' => [
                        '@type'   => 'Place',
                        'address' => [
                            '@type'           => 'PostalAddress',
                            'addressLocality' => $listing_structure['Location']['City'],
                            'addressRegion'   => $listing_structure['Location']['State'],
                            'postalCode'      => $listing_structure['Location']['ZipCode'],
                            'addressCountry'  => [
                                '@type' => 'Country',
                                'name'  => $listing_structure['Location']['Country'],
                            ]
                        ],
                    ],
                    'hiringOrganization' => [
                        '@type' => 'Organization',
                        'name' => $listing_structure['user']['CompanyName'],
                    ],
                    'occupationalCategory' => join(', ', $listing_structure['JobCategory']),
                ];
                if (!empty($listing_structure['user']['Logo']['file_url'])) {
                    $listingInfo['hiringOrganization']['logo'] = $listing_structure['user']['Logo']['file_url'];
                }
                if (!empty($listing_structure['user']['WebSite'])) {
                    $website = trim($listing_structure['user']['WebSite']);
                    if ($website) {
                        if (!preg_match('/http/i', $website)) {
                            $website = 'http://' . $website;
                        }
                        $listingInfo['hiringOrganization']['sameAs'] = $website;
                    }
                }
                $json = '<script type="application/ld+json">' . json_encode($listingInfo) . '</script>';
                SJB_TemplateProcessor::_tpl_javascript([], $json);


                $listingInfo = [
                    '@context' => 'http://schema.org',
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'item' => [
                                '@id' => SJB_HelperFunctions::getUserSiteUrl() . '/jobs/',
                                'name' => 'Jobs',
                            ]
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'item' => [
                                '@id' => SJB_HelperFunctions::getUserSiteUrl() . $listingUrl,
                                'name' => $listing_structure['Title'],
                            ]
                        ],
                    ]
                ];
                $json = '<script type="application/ld+json">' . json_encode($listingInfo) . '</script>';
              
			  SJB_TemplateProcessor::_tpl_javascript([], $json);
			  
            }
		}

            if ($field_id = SJB_Request::getVar('field_id')) {
                $tp->assign('field_id', $field_id);
            }

            if (SJB_UserManager::isUserLoggedIn()) {
                $currentUser = SJB_UserManager::getCurrentUser();
                if ($currentUser->user_group_sid == '36' && $listing_type_id == 'Job') {
                    $resumeListingSID = SJB_DB::queryValue("SELECT `sid` FROM `listings` WHERE `user_sid` = ?n", $currentUser->sid);
                    $percentage = SJB_ListingManager::getListingPercentage($resumeListingSID);
                    if ($percentage < 90) {
                        $tp->assign('resumeListingSID', $resumeListingSID);
                    }
                }
            }
			if ($listing_type_id == 'Job') {
				
				$breadCrumbs = new SJB_Breadcrumbs();			
				$ISbreadCrumbs = $breadCrumbs->getElementByUri('/job/'.$listing_id.'/');
				
				$breadCrumbs_link ="";
	         $breadCrumbs_html="";
				if(!$ISbreadCrumbs)
				{
					
			
					
					if($listing_structure['Location']['City'])
					{  
				
				       $city=str_replace(" ","-",$listing_structure['Location']['City']);
						$parentUri= '/cities/jobs-in-'.$city. '/';
						
								$breadCrumbs_link=$parentUri;
								$breadCrumbs_html='Offres d\'emploi à '.$listing_structure['Location']['City'];
								
						/*$parentId = $breadCrumbs->getElementByUri($parentUri);
						if(!$parentId)
						{
						    $parentId2 = $breadCrumbs->getElementByUri('/jobs/');
						    $breadCrumbs->addElement('Offres d\'emploi à '.$listing_structure['Location']['City'], $parentUri, $parentId2);
							
                                $parentId = $breadCrumbs->getElementByUri($parentUri);
						}
						*/
						
					}
					elseif($listing_structure['Location']['State'])	
					{
						  $state=str_replace(" ","-",$listing_structure['Location']['State']);
						$parentUri= '/states/jobs-in-'.$state. '/';	
						
						$breadCrumbs_link=$parentUri;
								$breadCrumbs_html='Offres d\'emploi à '.$listing_structure['Location']['State'];
						/*
						$parentId = $breadCrumbs->getElementByUri($parentUri);
						if(!$parentId)
						{
						    $parentId2 = $breadCrumbs->getElementByUri('/jobs/');
						    $breadCrumbs->addElement('Offres d\'emploi à '.$listing_structure['Location']['State'], $parentUri, $parentId2);
							$parentId = $breadCrumbs->getElementByUri($parentUri);
						}
						*/
					}
					else
					{
						// $parentId = $breadCrumbs->getElementByUri('/jobs/');
						 
						 $breadCrumbs_link='/jobs/';
								$breadCrumbs_html='Offres d\'emploi au Maroc';
						 
					}
                    $uri = '/job/' . $listing_id . '/';			
				    //$breadCrumbs->addElement($listing_structure['Title'], $uri, $parentId);
				
				
				
				
				}
			}
			
        }

        foreach ($errors as $k => $v) {
            switch ($k) {
                case '404':
                    if (SJB_Array::get($this->params, 'listing_type_id') == 'Job') {
                       // header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
                        $params = SJB_UrlParamProvider::getParams();
                        $keywords = str_replace('-', ' ', array_pop($params));
                        $_REQUEST['keywords']['all_words'] = $keywords;
                        $_REQUEST['not_found'] = 1;
                        $_SERVER['REQUEST_URI'] = '/jobs/?keywords[all_words]=' . $keywords . '&not_found=1';
                        $r = SJB_Request::factory('/jobs/');
                        $r->execute();
                        exit();
                    }
                    echo SJB_System::executeFunction('miscellaneous', '404_not_found');
                    return;
            }
        }
		 $bannersObj = new SJB_Banners();
		 $groupID = "Dispaly_right";
		$bannersIDs	= $bannersObj->getActiveBannerIdByGroupID($groupID);
	       if ($bannersIDs !== false)
			   $isActiveBanner=1;
		   else
			    $isActiveBanner=0;
		 $tp->assign('isActiveBanner', $isActiveBanner);
		   $tp->assign('isActive', $listing->isActive());
		    
							   
		   $tp->assign('breadCrumbs_html',   $breadCrumbs_html);
		   $tp->assign('breadCrumbs_link',   $breadCrumbs_link);
        $tp->assign('errors', $errors);
	
        $tp->display($template);
    }
}
