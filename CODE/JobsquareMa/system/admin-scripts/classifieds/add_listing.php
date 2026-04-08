<?php

class SJB_Admin_Classifieds_AddListing extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_JOB_BOARD);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $listingTypeID = SJB_Request::getVar('listing_type_id', null);

        if (empty($listingTypeID)) {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            return;
        }
			$action = SJB_Request::getVar('action');
		if ($action=='autocompleteMessages') {
                $this->autocompleteMessages();
                return;
            }
        $listingTypeSID = SJB_ListingTypeManager::getListingTypeSIDByID($listingTypeID);
        $listingTypeInfo = SJB_ListingTypeManager::getListingTypeInfoBySID($listingTypeSID);

        $userGroup = SJB_ListingTypeManager::JOB == $listingTypeSID ? SJB_UserGroup::EMPLOYER : SJB_UserGroup::JOBSEEKER;
        $userGroup = SJB_UserGroupManager::getUserGroupInfoBySID($userGroup);

        $products = SJB_ProductsManager::getProductsInfoByUserGroupSID($userGroup['sid']);
        $form_submitted = SJB_Request::getVar('action', '') == 'add';

        $tmp_listing_id_from_request = SJB_Request::getInt('listing_id', false);
        if (!empty($tmp_listing_id_from_request))
            $tmp_listing_sid = $tmp_listing_id_from_request;
        elseif (!$tmp_listing_id_from_request)
            $tmp_listing_sid = time();

        $listing = new SJB_Listing($_REQUEST, $listingTypeSID);

        $listing->deleteProperty('status');

        $listing->addProperty([
            'id' => 'username',
            'caption' => $userGroup['name'],
            'type' => 'user',
            'is_required' => true,
            'user_group' => $userGroup,
            'value' => SJB_Request::getVar('username')
        ]);

        foreach ($products as $key => $product) {
            $products[$key] = [
                'id' => $product['sid'],
                'caption' => $product['name']
            ];
        }
        $listing->addProperty([
            'id' => 'product_sid',
            'caption' => 'Product',
            'type' => 'list',
            'is_required' => true,
            'list_values' => $products,
            'value' => SJB_Request::getVar('product_sid')
        ]);

        $add_listing_form = new SJB_Form($listing);
        $add_listing_form->registerTags($tp);

        $field_errors = [];
        if ($form_submitted && $add_listing_form->isDataValid($field_errors)) {
            $user = $listing->getPropertyValue('username');
            $user = SJB_UserManager::getUserSIDbyUsername($user);

            $productSID = $listing->getPropertyValue('product_sid');
            $listing->deleteProperty('username');
            $listing->deleteProperty('product_sid');

            $productInfo = SJB_ProductsManager::getProductInfoBySID($productSID);
            $extraInfo = is_null($productInfo['serialized_extra_info']) ? null : unserialize($productInfo['serialized_extra_info']);
            if (!empty($extraInfo)) {
                $extraInfo['product_sid'] = $productSID;
            }

            $listing->setUserSID($user);
            $listing->setProductInfo($extraInfo);

            SJB_ListingManager::saveListing($listing);

            $formToken = SJB_Request::getVar('form_token');
            $sessionFilesStorage = SJB_Session::getValue('tmp_uploads_storage');
            $uploadedFields = SJB_Array::getPath($sessionFilesStorage, $formToken);

            if (!empty($uploadedFields)) {
                foreach ($uploadedFields as $fieldId => $fieldValue) {
                    // get field of listing
                    $isComplex = false;
                    if (strpos($fieldId, ':') !== false) {
                        $isComplex = true;
                    }

                    $tmpUploadedFileId = $fieldValue['file_id'];
                    // rename it to real listing field value
                    $newFileId = $fieldId . '_' . $listing->getSID();
                    $uploadFileSID = SJB_DB::queryValue('SELECT `sid` FROM `uploaded_files` WHERE `id` = ?s', $tmpUploadedFileId);
                    if ($uploadFileSID) {
                        SJB_DB::query('DELETE FROM `uploaded_files` WHERE `id` = ?s', $newFileId);
                    }
                    SJB_DB::query('UPDATE `uploaded_files` SET `id` = ?s WHERE `id` =?s', $newFileId, $tmpUploadedFileId);

                    if ($isComplex) {
                        list($parentField, $subField, $complexStep) = explode(':', $fieldId);
                        $parentProp = $listing->getProperty($parentField);
                        $parentValue = $parentProp->getValue();

                        // look for complex property with current $fieldID and set it to new value of property
                        if (!empty($parentValue)) {
                            foreach ($parentValue as $id => $value) {
                                if ($id == $subField) {
                                    $parentValue[$id][$complexStep] = $newFileId;
                                }
                            }
                            $listing->setPropertyValue($parentField, $parentValue);
                        }
                    } else {
                        $listing->setPropertyValue($fieldId, $newFileId);
                    }

                    // unset value from session temporary storage
                    $sessionFilesStorage = SJB_Array::unsetValueByPath($sessionFilesStorage, "{$formToken}/{$fieldId}");
                }

                //and remove token key from temporary storage
                $sessionFilesStorage = SJB_Array::unsetValueByPath($sessionFilesStorage, "{$formToken}");
                SJB_Session::setValue('tmp_uploads_storage', $sessionFilesStorage);

                SJB_ListingManager::saveListing($listing);
            }

            $listingSid = $listing->getSID();
            SJB_ListingManager::activateListingBySID($listingSid);
            SJB_ProductsManager::incrementPostingsNumber($productSID);
            $expirationDate = $listing->getProperty('expiration_date');
            if ($expirationDate) {
                SJB_ListingDBManager::setListingExpirationDate($listingSid, $listing->getProperty('expiration_date')->getSQLValue());
            }

            SJB_Event::dispatch('ListingSaved', $listing);
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/manage-' . strtolower($listingTypeID) . 's/?action=search&listing_type_sid=' . $listingTypeSID);
        }

        $listing->deleteProperty('contract_id');

        $add_listing_form = new SJB_Form($listing);
        if ($form_submitted)
            $add_listing_form->isDataValid($field_errors);
        $add_listing_form->registerTags($tp);

        $form_fields = $add_listing_form->getFormFieldsInfo();
        $pages = SJB_PostingPagesManager::getPagesByListingTypeSID($listingTypeSID);
        $formFieldsSorted = [
            'username' => $form_fields['username'],
            'product_sid' => $form_fields['product_sid'],
            'featured' => $form_fields['featured'],
        ];
        foreach ($pages as $page) {
            $listing_fields = SJB_PostingPagesManager::getAllFieldsByPageSIDForForm($page['sid']);
            foreach (array_keys($listing_fields) as $field) {
                if ($listing->propertyIsSet($field)) {
                    $formFieldsSorted[$field] = $form_fields[$field];
                }
            }
        }
        $form_fields = $formFieldsSorted;

        $metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
        $tp->assign(
            'METADATA',
            [
                'form_fields' => $metaDataProvider->getFormFieldsMetadata($form_fields),
            ]
        );

        $tp->assign('listing_id', $tmp_listing_sid);
        $tp->assign('errors', $field_errors);
        $tp->assign('form_fields', $form_fields);
        $tp->assign('listingType', SJB_ListingTypeManager::createTemplateStructure($listingTypeInfo));
        $tp->display('input_form.tpl');
    }
		function autocompleteMessages(){
	if(SJB_Request::getVar('message'))
			
		$messages = SJB_DB::query("SELECT * FROM  messages where messages.message like'%".SJB_Request::getVar('message')."%' order by messages.message asc" );
		$tab2=array();
			//$res["clients"]=$clients;
			foreach($messages as $val)
			{
			 $tab2[] = array( 'label' =>$val['message'], 'value' => $val['sid'] );
			}
			//$res["names"]=$tab2;
			
			die(json_encode($tab2));
	
	}
}
