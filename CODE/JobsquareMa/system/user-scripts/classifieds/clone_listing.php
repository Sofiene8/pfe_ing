<?php

use SJB\Social;

class SJB_Classifieds_CloneListing extends SJB_Function
{
    protected $listingTypeID;

    protected $formSubmittedFromPreview;

    /**
     * @var SJB_TemplateProcessor
     */
    protected $tp;

    protected $buttonPressedPostToProceed;

    public function execute()
    {
        $this->tp = SJB_System::getTemplateProcessor();
        $error = null;
        $current_user = SJB_UserManager::getCurrentUser();

        $redirectBackToJobID = SJB_Request::getVar('redirectBackToJobID',false);
        if ($redirectBackToJobID) {
            SJB_Session::setValue('redirectBackToJobID', $redirectBackToJobID);
            $this->tp->assign('redirectBackToJobID', $redirectBackToJobID);
        }


      
        $server_content_length = isset($_SERVER['CONTENT_LENGTH']) ? $_SERVER['CONTENT_LENGTH'] : null;
		
		
		
        $this->listingTypeID = SJB_Request::getVar('listing_type_id', false);

       

        $tmpListingIDFromRequest = SJB_Request::getVar('listing_id', false, 'default', 'int');
        if (!empty($tmpListingIDFromRequest)) {
            $tmpListingSID = $tmpListingIDFromRequest;
        } elseif (!$tmpListingIDFromRequest) {
            $tmpListingSID = time();
        }
		//---- CLONE 
        $clistingId = SJB_Request::getVar('clisting_id', false, 'default', 'int');
	   

	   
	   // pour clone ---- ched 21-03-20- vérifier si c'est featured
		 
	/*	 $user_info = SJB_Authorization::getCurrentUserInfo();
		if(!$user_info["featured"])
		{
			 $returnUrl = SJB_System::getSystemSettings('SITE_URL') . '/add-listing/?listing_type_id=Job';
             SJB_HelperFunctions::redirect($returnUrl);
		}
		 //----------------------------------
	*/
	
	$productchoice=false;
	 if ((!is_null($clistingId)) )
	{
          		
		$clistingInfo = SJB_ListingManager::getListingInfoBySID($clistingId);	

		if (!empty($clistingInfo)) {
				
			
					$clisting = new SJB_Listing($clistingInfo, $clistingInfo['listing_type_sid']);
					$properties = $clisting->getProperties();
					foreach ($properties as $fieldID => $property) {
						switch ($property->getType()) {
							case 'date':
								if (!empty($clistingInfo[$fieldID])) {
									$clistingInfo[$fieldID] = SJB_I18N::getInstance()->getDate($clistingInfo[$fieldID] );
								}
								break;
							case 'complex':
								$complex = $property->type->complex;
								$complexProperties = $complex->getProperties();
								foreach ($complexProperties as $complexfieldID => $complexProperty) {
									if ($complexProperty->getType() == 'date') {
										$values = $complexProperty->getValue();
										foreach ($values as $index => $value) {
											if (!empty($clistingInfo[$fieldID][$complexfieldID][$index])) {
												$clistingInfo[$fieldID][$complexfieldID][$index] = SJB_I18N::getInstance()->getDate($clistingInfo[$fieldID][$complexfieldID][$index]);
											}
										}	
									}
								}
								break;
						}
					}
				
			}
			
		
			
		if ($clistingInfo['user_sid'] != $current_user->getID()) {
			$errors['NOT_OWNER_OF_LISTING'] = $clistingId;
		} elseif (!is_null($clistingInfo)) {
			$pages = SJB_PostingPagesManager::getPagesByListingTypeSID($clistingInfo['listing_type_sid']);
			

			// fill listing from an array of social data if allowed
			$clisting_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($clistingInfo['listing_type_sid']);
			$listingTypeID = $clisting_type_info['id'];
			 $this->listingTypeID = $listingTypeID;
		
   
			
			$clisting = new SJB_Listing($clistingInfo, $clistingInfo['listing_type_sid']);
			$clisting->deleteProperty('featured');
			$clisting->deleteProperty('status');

			$clisting->setSID($clistingId);

			//--->CLT-2637

			  
			$clisting_structure = SJB_ListingManager::createTemplateStructureForListing($clisting);


			  
			  
			$clisting_edit_form = new SJB_Form($clisting);
			$clisting_edit_form->registerTags($this->tp);
		     $cform_fields = $clisting_edit_form->getFormFieldsInfo();
			$listing_fields_by_page = array();
			foreach ($pages as $page) {
				$listing_fields_by_page[$page['page_name']] = SJB_PostingPagesManager::getAllFieldsByPageSIDForForm($page['sid']);
				foreach (array_keys($listing_fields_by_page[$page['page_name']]) as $field) {
					if (!$clisting->propertyIsSet($field))
						unset($listing_fields_by_page[$page['page_name']][$field]);
				}
			}

			$metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
			$this->tp->assign(
				'METADATA', array(
					'listing' => $metaDataProvider->getMetaData($clisting_structure['METADATA']),
					'form_fields' => $metaDataProvider->getFormFieldsMetadata($cform_fields),
				)
			);


		
    
	
		    $this->tp->assign('countPages', count($listing_fields_by_page));
		    $this->tp->assign('listingTypeID', $listingTypeID);
			$this->tp->assign('listing', $clisting_structure);
			$this->tp->assign('pages', $listing_fields_by_page);
						
      
		}
		
		  //$template = isset($_REQUEST['input_template']) ? $_REQUEST['input_template'] : "clone_listing.tpl";
		   
		  $template = SJB_Request::getVar('clone_listing', 'clone_listing.tpl');
          //----------------------------------------------------------------		  
         $this->buttonPressedPostToProceed = SJB_Request::getVar('proceed_to_posting');
         if (SJB_UserManager::isUserLoggedIn()) {
            SJB_Session::unsetValue('proceed_to_posting');
            SJB_Session::unsetValue('productSID');
            SJB_Session::unsetValue('listing_type_id');
            if (!is_null($this->buttonPressedPostToProceed)) {
                $productSID = SJB_Request::getVar('productSID', false, 'default', 'int');
                if (in_array($productSID, $current_user->getTrialProductSIDByUserSID())) {
                    SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/shopping-cart/?error=trial_product");
                }
                $productInfo = SJB_ProductsManager::getProductInfoBySID($productSID);
                $userInfo = SJB_UserManager::getCurrentUserInfo();
                if ($userInfo['user_group_sid'] == $productInfo['user_group_sid']) {
                    $this->tp->assign('productSID', $productSID);
                    $this->tp->assign('proceed_to_posting', $productSID);
                    $this->tp->assign("listing_id", $tmpListingSID);
                   // $this->addListing($listingSID, 0, $productSID);
                } else {
					
                    SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/products/?permission=post_' . mb_strtolower($this->listingTypeID));
                }
            } else {
			
			
                if ($productsInfo = SJB_ListingManager::canCurrentUserAddListing($this->listingTypeID)) {
			
                    if ($contractID = SJB_Request::getVar('contract_id', false, 'POST')) {
                        $this->tp->assign("listing_id", $tmpListingSID);
						$this->tp->assign("contract_id", $contractID);
                        //$this->addListing($listingSID, $contractID, false);
                    } elseif (count($productsInfo) == 1) {
                        $productInfo = array_pop($productsInfo);
                        $contractID = $productInfo['contract_id'];
						

						$this->tp->assign("listing_id", $tmpListingSID);
						 $this->tp->assign('form_token', SJB_Request::getVar('form_token'));

                $this->tp->assign("contract_id", $contractID);
                $this->tp->assign("listingTypeID", $this->listingTypeID);
                $this->tp->assign('listingTypeStructure', SJB_ListingTypeManager::createTemplateStructure(SJB_ListingTypeManager::getListingTypeInfoBySID($clisting->listing_type_sid)));
                $this->tp->assign("field_errors", $fieldErrors);
                $this->tp->assign("form_fields", $cformFields);
						
						
						//$this->tp->display('clone_listing.tpl');
                       //$this->addListing($listingSID, $contractID, false);
                    } else {
                        $this->tp->assign('listing_id', $tmpListingSID);
                        $this->tp->assign('products_info', $productsInfo);
                        $this->tp->assign('listingTypeID', $this->listingTypeID);
						
						  $this->tp->assign('clistingId', $clistingId);
						  $productchoice=true;
                        $this->tp->display('listing_product_choice.tpl');
                    }
                } else {
										

                    SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/products/?permission=post_' . mb_strtolower($this->listingTypeID));
                }
            }
        } else {
            if ($this->buttonPressedPostToProceed != false) {
                SJB_Session::setValue('proceed_to_posting', true);
                SJB_Session::setValue('productSID', SJB_Request::getVar('productSID', '', 'default', 'int'));
                SJB_Session::setValue('listing_type_id', $this->listingTypeID);
            }
            if ($this->listingTypeID == 'Job') {
                $returnUrl = SJB_System::getSystemSettings('SITE_URL') . '/add-listing/?listing_type_id=Job';
            
                SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/registration/?user_group_id=Employer&return_url=' . $returnUrl);
            }
            $this->displayErrorTpl('NOT_LOGGED_IN');
        }
		
	 }
	 else
	 {
	 
	        $returnUrl = SJB_System::getSystemSettings('SITE_URL') . '/add-listing/?listing_type_id=Job';
               
                SJB_HelperFunctions::redirect($returnUrl);
     
	 }
	 if(!$productchoice)
	    $this->tp->display($template);
    }


    /**
     * @param $error
     */
    public function displayErrorTpl($error)
    {
        $listingTypeName = SJB_ListingTypeManager::getListingTypeNameBySID(SJB_ListingTypeManager::getListingTypeSIDByID($this->listingTypeID));
        $this->tp->assign('listingTypeName', $listingTypeName);
        $this->tp->assign('error', $error);
        $this->tp->display('add_listing_error.tpl');
    }

   

    /**
     * @param $pages
     * @param $listingTypeSID
     * @return bool|int|mixed
     */
    public function getPageSID($pages, $listingTypeSID)
    {
        $passedParametersViaUri = SJB_Request::getVar('passed_parameters_via_uri', false);
        $pageID = false;
        if ($passedParametersViaUri) {
            $passedParametersViaUri = SJB_UrlParamProvider::getParams();
            $this->listingTypeID = isset($passedParametersViaUri[0]) ? $passedParametersViaUri[0] : $this->listingTypeID;
            $pageID = isset($passedParametersViaUri[1]) ? $passedParametersViaUri[1] : false;
        }
        if (!$pageID) {
            $pageID = $pages[0]['page_id'];
        }
        $pageSID = SJB_PostingPagesManager::getPostingPageSIDByID($pageID, $listingTypeSID);
        return $pageSID;
    }

    /**
     * @param int $currentUserID
     * @param int $productSID
     * @param $proceedToListing
     * @return bool|int|mixed
     */
    public function proceedToCheckout($currentUserID, $productSID, $proceedToListing)
    {
        $errors = [];
        $productInfo = SJB_ProductsManager::getProductInfoBySID($productSID);
        $productInfo['proceedToListing'] = $proceedToListing;
        SJB_ShoppingCart::addToShoppingCart($productInfo, $currentUserID);
        if (!$errors) {
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/shopping-cart/');
        }
    }
}
