<?php

class SJB_Classifieds_DisplayMyListing extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $display_form = new SJB_Form();
        $display_form->registerTags($tp);

        $errors = [];

        $listingSID = SJB_Request::getVar("listing_id");
        if (isset ($_REQUEST ['passed_parameters_via_uri'])) {
            $passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
            $listingSID = isset ($passed_parameters_via_uri [0]) ? $passed_parameters_via_uri [0] : null;
        }

        $template = SJB_Request::getVar('display_template', 'display_listing.tpl');

        if (is_null($listingSID)) {
            $errors ['404'] = true;
        } elseif (is_null($listing = SJB_ListingManager::getObjectBySID($listingSID))) {
            $errors ['404'] = true;
        } elseif (!$listing->isActive() && $listing->getUserSID() != SJB_UserManager::getCurrentUserSID()) {
            $errors ['404'] = true;
        } else {

            $display_form = new SJB_Form ($listing);
            $display_form->registerTags($tp);

            $pages = SJB_PostingPagesManager::getPagesByListingTypeSID($listing->getListingTypeSID());
            $form_fields = [];
            foreach ($pages as $page) {
                $form_fields = array_merge(SJB_PostingPagesManager::getAllFieldsByPageSIDForForm($page['sid']), $form_fields);
            }

            $listingOwner = SJB_UserManager::getObjectBySID($listing->user_sid);

            // listing preview @author still
            $listingTypeSID = $listing->getListingTypeSID();
            $listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($listingTypeSID);
            if (SJB_Request::getInstance()->page_config->uri == '/' . strtolower($listingTypeID) . '-preview/') {
                if (!empty($_SERVER['HTTP_REFERER']) && (stristr($_SERVER['HTTP_REFERER'], 'edit-' . $listingTypeID))) {
                    $tp->assign('referer', $_SERVER['HTTP_REFERER']);
                } else {
                    $lastPage = SJB_PostingPagesManager::getPagesByListingTypeSID($listingTypeSID);
                    $lastPage = array_pop($lastPage);
                    $tp->assign('referer', SJB_System::getSystemSettings('SITE_URL') . '/add-listing/'
                        . $listingTypeID . '/'
                        . $lastPage['page_id'] . '/' . $listing->getSID());
                }
                $tp->assign('checkouted', SJB_ListingManager::isListingCheckOuted($listing->getSID()));
                $tp->assign('contract_id', $listing->contractID);
            }

            $listingStructure = SJB_ListingManager::createTemplateStructureForListing($listing);
            $filename = SJB_Request::getVar('filename', false);
            if ($filename) {
                SJB_UploadFileManager::openFile($filename, $listingSID);
                $errors ['NO_SUCH_FILE'] = true;
            }
            $metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
            $tp->assign('METADATA', ['listing' => $metaDataProvider->getMetaData($listingStructure ['METADATA']), 'form_fields' => $metaDataProvider->getFormFieldsMetadata($form_fields)]);

            $tp->assign('listing_id', $listingSID);
            $tp->assign('form_fields', $form_fields);
            $tp->filterThenAssign("listing", $listingStructure);
            $tp->assign('preview_listing_sid', SJB_Request::getVar('preview_listing_sid'));
            $tp->assign('listingOwner', $listingOwner);
			
            if (SJB_Request::getVar('action', false) == 'download_pdf_version') {
				$modeleValue = null;
				$colorValue = null;
				if (isset($listing->details->properties['resume_modele_sid'])) {
					$modele = $listing->details->properties['resume_modele_sid'];
					$modeleValue = $modele->value;
				}
				if (isset($listing->details->properties['modele_color'])) {
					$color = $listing->details->properties['modele_color'];
					$colorValue = $color->value;
				}

				$resumeModel = [];
				$resumeColor = [];
				if (!empty($modeleValue)) {
					$resumeModel = SJB_DB::query("SELECT * FROM resume_models WHERE sid = ?n", $modeleValue);
				}
				if (!empty($colorValue)) {
					$resumeColor = SJB_DB::query("SELECT * FROM resume_colors WHERE sid = ?n", $colorValue);
				}

				if (!empty($resumeModel[0]['sid']))
					$tpl = 'resume_to_pdf_' . $resumeModel[0]['sid'] . '.tpl';
				else
					$tpl = 'resume_to_pdf.tpl';
				
                $filename = ($listingStructure['user']['FullName'] ?? 'CV') . '_' . ($listingStructure['Title'] ?? 'Resume') . '.pdf';
				$tp->assign('resumeColor', count($resumeColor)>0?$resumeColor[0]:0);
				$tp->assign('resumeModel', count($resumeModel)>0?$resumeModel[0]:0);
                try {
                    $tp->assign('myListing', 1);

                    $html = $tp->fetch($tpl);
                    SJB_HelperFunctions::html2pdf($html, $filename, str_replace('http://', '', SJB_HelperFunctions::getSiteUrl()));
                } catch (Exception $e) {
                    SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . '/my-resume-details/' . $listingSID . '/?error=TCPDF_ERROR');
                }
            }
        }

        foreach ($errors as $k => $v) {
            switch ($k) {
                case '404':
                    echo SJB_System::executeFunction('miscellaneous', '404_not_found');
                    return;
            }
        }

        $tp->assign('errors', $errors);
        $tp->assign('myListing', true);
        $tp->display($template);
    }
}
