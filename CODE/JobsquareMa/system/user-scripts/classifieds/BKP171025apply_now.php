<?php

class SJB_Classifieds_ApplyNow extends SJB_Function
{
    public function execute()
    {
        $loggedIn = SJB_UserManager::isUserLoggedIn();
        if (SJB_Settings::getValue('loggedin_apply') && !$loggedIn) {
            echo SJB_System::executeFunction('users', 'login', [
                'ajaxRelocate' => true,
                'skip_registration_return' => true,
            ]);
            return;
        }

        $errors = [];
        $tp = SJB_System::getTemplateProcessor();
        $current_user_sid = SJB_UserManager::getCurrentUserSID();

        $controller = new SJB_SendListingInfoController($_REQUEST);
        $isDataSubmitted = false;
        $isApplied = $current_user_sid && SJB_Applications::isApplied($controller->getListingID(), $current_user_sid);

        if (SJB_PluginManager::isPluginActive('TopresumePlugin') && SJB_Settings::getValue('topresume_key') && SJB_Settings::getValue('topresume_secret')) {
            $tp->assign('topresume', true);
        }

        $jobInfo = SJB_ListingManager::getListingInfoBySID($controller->getListingID());
        if (!empty($jobInfo['ApplicationSettings']['add_parameter']) && $jobInfo['ApplicationSettings']['add_parameter'] == 2) {
            $tp->assign('requires_redirect', true);
        }
        if ($controller->isListingSpecified()) {
            if ($controller->isDataSubmitted() && !$isApplied) {
                // получим уникальный id для файла в uploaded_files

                $post = $controller->getData();
                $listingId = '';
                if (isset($post['submitted_data']['id_resume'])) {
                    $listingId = $post['submitted_data']['id_resume'];
                }

                $email = new SJB_EmailType([
                    'value' => $post['submitted_data']['email']
                ]);
                if ($email->isValid() !== true) {
                    $errors[] = 'Please enter valid email address';
                }

                $mimeType = isset($_FILES['file_tmp']['type']) ? $_FILES['file_tmp']['type'] : '';

                if (isset($_FILES['file_tmp']['error'])) {
                    switch ($_FILES['file_tmp']['error']) {
                        case UPLOAD_ERR_INI_SIZE:
                            $errors['FILE_SIZE'] = 'File size shouldn\'t be larger than 5 MB.';
                    }
                }

                $upload_manager = new SJB_UploadFileManager();
                $upload_manager->setFileGroup('files');
                $upload_manager->setUploadedFileID('application_' . md5(microtime()));
                if (empty($errors) && isset($_FILES['file_tmp']) && !$upload_manager->isValidUploadedFile('file_tmp')) {
                    $errors['NOT_SUPPORTED_FILE_FORMAT'] = 'File format is not supported';
                }
 
                if (empty($_FILES['file_tmp']) && !$listingId) {
                    $canApplyWithoutResume = false;
                    SJB_Event::dispatch('CanApplyWithoutResume', $canApplyWithoutResume);
                    if (!$canApplyWithoutResume) {
                        $errors['APPLY_INPUT_ERROR'] = 'Please select file or resume';
                    }
                } else if (empty($current_user_sid) && SJB_Applications::isAppliedGuest($post['submitted_data']['listing_id'], trim($post['submitted_data']['email']))) {
                    $errors['APPLY_APPLIED_ERROR'] = 'You already applied to this job';
                }

                $res = false;
                $listing_info = '';

                if (empty($errors)) {
                    $file_name = $upload_manager->uploadFileApplication('file_tmp',$post['submitted_data']['listing_id']);
                   

				
					
					$res = SJB_Applications::create(
                        $post['submitted_data']['listing_id'],
                        $current_user_sid,
                        $listingId,
                        $post['submitted_data']['comments'],
                        $file_name,
						$upload_manager->fileId,
                        $mimeType,
                        $_POST
                    );
					
			 $file_info = SJB_DB::query("SELECT * FROM `uploaded_files` WHERE `sid` = ?s", $upload_manager->fileId);
			
                    if ($listingId) {
                        $listing_info = SJB_ListingManager::getListingInfoBySID($listingId);
                        $emp_sid = SJB_ListingManager::getUserSIDByListingSID($post['submitted_data']['listing_id']);
                        $accessible = SJB_ListingManager::isListingAccessableByUser($listingId, $emp_sid);
                        if (!$accessible) {
                            SJB_ListingManager::setListingAccessibleToUser($listingId, $emp_sid);
                        }
                    }
				
				
				
				if (!empty($file_info)) {
				 $file_info = array_pop($file_info);
					
					$dir_date=$upload_manager->getapplicationdirectoryFromTime('files/applications',$file_info['creation_time'],$post['submitted_data']['listing_id']);
					$fileName = $dir_date."/".$file_name;
					
				}
                    if (!empty($file_name)) {
                        $file_name =$fileName;
                    }
					//echo  $file_name;exit;
				if($listing_info['email_notify']==1)
					{
					SJB_Notifications::sendApplyNow($post, $file_name, $listing_info, $_POST);
					}
                    
                    if (SJB_PluginManager::isPluginActive('TopresumePlugin') && SJB_Request::getVar('topresume')) {
                        $data = [
                            'first_name' => SJB_Request::getVar('name'),
                            'email' => SJB_Request::getVar('email'),
                            'resume_file' => new CURLFile($file_name, $mimeType),
                        ];
                        TopresumePlugin::upload($data);
                    }
                }

                if ($res === false && empty($errors)) {
                    $errors['APPLY_ERROR'] = 'Cannot apply';
                }
 
                $isDataSubmitted = true;
            }

            if ($loggedIn) {
                $resumes = [];
                foreach (SJB_ListingDBManager::getActiveListingsSIDByUserSID($current_user_sid) as $key => $resume) {
                    $listing = SJB_ListingManager::createTemplateStructureForListing(SJB_ListingManager::getObjectBySID($resume));
                    if ($listing['type']['id'] == 'Resume') {
                        $resumes[] = $listing;
                    }
                }
                $tp->assign('resumes', $resumes);
            }
            $tp->assign('listing', $jobInfo);
        } else {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            return;
        }

        $tp->assign('request', $_REQUEST);
        $tp->assign('errors', $errors);
        $tp->assign('listing_id', $controller->getListingID());
        $tp->assign('is_data_submitted', $isDataSubmitted);
        $tp->assign('is_applied', $isApplied);
        $tp->display('apply_now.tpl');
    }
}
