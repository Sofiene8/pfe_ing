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

        // --- Default phone from user ---
        $defaultPhone = '';
        if ($current_user_sid) {
            $uInfo = SJB_UserManager::getUserInfoBySID($current_user_sid);

            if (!empty($uInfo['Phone'])) {
                $defaultPhone = trim($uInfo['Phone']);
            } elseif (!empty($uInfo['user_data']['Phone']['value'])) {
                $defaultPhone = trim($uInfo['user_data']['Phone']['value']);
            }

            // Normalize to local TN (8 digits) – already OK chez toi
            if (!empty($defaultPhone)) {
                $defaultPhone = preg_replace('/[\s\.\-\(\)]/', '', $defaultPhone);
                $defaultPhone = preg_replace('/^\+?216/', '', $defaultPhone);
                $defaultPhone = preg_replace('/\D/', '', $defaultPhone);
                if (strlen($defaultPhone) > 8) {
                    $defaultPhone = substr($defaultPhone, -8);
                }
            }
        }
        $tp->assign('default_phone', $defaultPhone);

        // Flags pour le template (quel toggle afficher)
        $tp->assign('has_profile_phone', !empty($defaultPhone));

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

                $post = $controller->getData();
                $listingId = '';
                if (isset($post['submitted_data']['id_resume'])) {
                    $listingId = $post['submitted_data']['id_resume'];
                }

                // ---- VALIDATIONS ----
                // Email
                $email = new SJB_EmailType(['value' => $post['submitted_data']['email'] ?? '']);
                if ($email->isValid() !== true) {
                    $errors['EMAIL_INVALID'] = 'Veuillez saisir une adresse e-mail valide.';
                }

                // Phone — juste existence (normalisé plus haut/ailleurs)
                $phone = '';
                if (!empty($post['submitted_data']['phone'])) {
                    $phone = trim($post['submitted_data']['phone']);
                } elseif (!empty($defaultPhone)) {
                    $phone = $defaultPhone;
                }
                if ($phone === '') {
                    $errors['PHONE_REQUIRED'] = 'Le numéro de téléphone est obligatoire.';
                }

                // Propager pour affichage + insertion
                $post['submitted_data']['phone'] = $phone;
                $_POST['phone'] = $phone;

                $mimeType = isset($_FILES['file_tmp']['type']) ? $_FILES['file_tmp']['type'] : '';

                if (isset($_FILES['file_tmp']['error'])) {
                    switch ($_FILES['file_tmp']['error']) {
                        case UPLOAD_ERR_INI_SIZE:
                            $errors['FILE_SIZE'] = 'La taille du fichier ne doit pas dépasser 5 Mo.';
                            break;
                    }
                }

                $upload_manager = new SJB_UploadFileManager();
                $upload_manager->setFileGroup('files');
                $upload_manager->setUploadedFileID('application_' . md5(microtime()));
                if (empty($errors) && isset($_FILES['file_tmp']) && !$upload_manager->isValidUploadedFile('file_tmp')) {
                    $errors['NOT_SUPPORTED_FILE_FORMAT'] = 'Format de fichier non pris en charge.';
                }

                if (empty($_FILES['file_tmp']) && !$listingId) {
                    $canApplyWithoutResume = false;
                    SJB_Event::dispatch('CanApplyWithoutResume', $canApplyWithoutResume);
                    if (!$canApplyWithoutResume) {
                        $errors['APPLY_INPUT_ERROR'] = 'Le CV est obligatoire.';
                    }
                } else if (empty($current_user_sid) && SJB_Applications::isAppliedGuest($post['submitted_data']['listing_id'], trim($post['submitted_data']['email'] ?? ''))) {
                    $errors['APPLY_APPLIED_ERROR'] = 'Vous avez déjà postulé à cette offre.';
                }

                $res = false;
                $listing_info = '';

                if (empty($errors)) {
                    $file_name = $upload_manager->uploadFileApplication('file_tmp', $post['submitted_data']['listing_id']);

                    // NOTE: si ta signature de create() accepte $phone à la fin, passe-le ici aussi.
                    // Sinon garde la version précédente.
                    $res = SJB_Applications::create(
                        $post['submitted_data']['listing_id'],
                        $current_user_sid,
                        $listingId,
                        $post['submitted_data']['comments'] ?? '',
                        $file_name,
                        $upload_manager->fileId,
                        $mimeType,
                        $_POST,
                        $phone // <— si tu as ajouté ce paramètre dans create()
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
                        $dir_date = $upload_manager->getapplicationdirectoryFromTime('files/applications', $file_info['creation_time'], $post['submitted_data']['listing_id']);
                        $fileName = $dir_date . "/" . $file_name;
                    }
                    if (!empty($file_name)) {
                        $file_name = $fileName;
                    }

                    // Envoi notification
                    if (!empty($listing_info) && !empty($listing_info['email_notify']) && (int)$listing_info['email_notify'] === 1) {
                        SJB_Notifications::sendApplyNow($post, $file_name, $listing_info, $_POST);
                    }

                    // --- MISE À JOUR DU PROFIL USER SELON TOGGLE ---
                    if ($loggedIn && !empty($phone)) {
                        // Si pas de phone dans le profil -> proposer d'enregistrer (update_profile_phone=1 par défaut)
                        if (empty($defaultPhone)) {
                            $wantsUpdate = SJB_Request::getVar('update_profile_phone', '1') === '1';
                            if ($wantsUpdate) {
                                // Update direct; adapter si votre schéma stocke ailleurs
                                SJB_DB::query("UPDATE `users` SET `Phone` = ?s WHERE `sid` = ?n", $phone, $current_user_sid);
                            }
                        }
                        // Si phone existe déjà -> ne pas modifier par défaut (keep_profile_phone=1)
                        else {
                            $keep = SJB_Request::getVar('keep_profile_phone', '1') === '1';
                            if (!$keep) {
                                // L'utilisateur a choisi de remplacer son numéro de profil
                                SJB_DB::query("UPDATE `users` SET `Phone` = ?s WHERE `sid` = ?n", $phone, $current_user_sid);
                            }
                        }
                    }
                    // --- FIN UPDATE PROFIL ---
                }

                if ($res === false && empty($errors)) {
                    $errors['APPLY_ERROR'] = "Impossible d'envoyer la candidature.";
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
