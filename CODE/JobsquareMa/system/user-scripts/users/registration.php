<?php

use SJB\Social;

class SJB_Users_Registration extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $errors = [];
        $template = 'registration_form.tpl';
        if (SJB_Authorization::isUserLoggedIn()) {
            SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/my-account/');
        }

        $user_group_id = SJB_Request::getVar('user_group_id', null);
        if (!is_null($user_group_id)) {
            $user_group_sid = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);
            if (empty($user_group_sid)) {
                SJB_H::redirect(SJB_H::getCustomDomainUrl() . '/registration/');
            }
        }

        $this->setSessionValueForRedirectAfterRegister();
        if (!is_null($user_group_id) && empty($errors)) {
            $user = SJB_ObjectMother::createUser($_REQUEST, $user_group_sid);

            if (SJB_Request::isAjax() || 'true' == SJB_Request::getVar('isajaxrequest')) {
                $field = SJB_Request::getVar('type');
                echo $user->getProperty($field)->isValid();
                exit;
            }

            $user->deleteProperty('active');
            $user->deleteProperty('featured');

            $form_submitted = SJB_Request::getVar('action', false) == 'register';

            $registration_form = SJB_ObjectMother::createForm($user);
            $registration_form->registerTags($tp);

            if ($form_submitted && !SJB_Request::getVar('terms', '')) {
                $errors[] = 'NOT_ACCEPTED_TERMS';
            }

            $filled = false;
            if (SJB_Request::getVar('network')) {
                $filled = Social::fillUser($user);
                if ($filled) {
                    $form_submitted = true;
                    foreach ($registration_form->object_properties as $key => $property) {
                        if ($property->getID() != 'username') {
                            $property->makeNotRequired();
                        }
                    }
                }
            }
            if ($form_submitted && $registration_form->isDataValid($errors)) {
                $defaultProduct = SJB_UserGroupManager::getDefaultProduct($user_group_sid);
                SJB_UserManager::saveUser($user);

                $availableProductIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($user_group_sid);
                if ($defaultProduct && in_array($defaultProduct, $availableProductIDs)) {
                    $contract = new SJB_Contract(['product_sid' => $defaultProduct]);
                    $contract->setUserSID($user->getSID());
                    $contract->saveInDB();
                    if ($contract->isFeaturedProfile()) {
                        SJB_UserManager::makeFeaturedBySID($user->getSID());
                    }
                }

                // >>> SJB-1197
                // needs to check session for ajax-uploaded files, and set it to user profile
                $formToken = SJB_Request::getVar('form_token');
                $tmpUploadsStorage = SJB_Session::getValue('tmp_uploads_storage');

                if (!empty($formToken)) {
                    $tmpUploadedFields = SJB_Array::getPath($tmpUploadsStorage, $formToken);

                    if (!is_null($tmpUploadsStorage) && is_array($tmpUploadedFields)) {
                        // prepare user profile fields array
                        $userProfileFieldsInfo = SJB_UserProfileFieldManager::getAllFieldsInfo();
                        $userProfileFields = [];
                        foreach ($userProfileFieldsInfo as $field) {
                            $userProfileFields[$field['id']] = $field;
                        }

                        // look for temporary values
                        foreach ($tmpUploadedFields as $fieldId => $fieldInfo) {
                            // check field ID for valid ID in user profile fields
                            if (!array_key_exists($fieldId, $userProfileFields) || empty($fieldInfo)) {
                                continue;
                            }

                            $fieldType = $userProfileFields[$fieldId]['type'];
                            $profilePropertyId = $fieldId . '_' . $user->getSID();
                            $uploadFileSID = SJB_DB::queryValue("SELECT `sid` FROM `uploaded_files` WHERE `id` = ?s", $fieldInfo['file_id']);
                            if ($uploadFileSID) {
                                SJB_DB::query("DELETE FROM `uploaded_files` WHERE `id` = ?s", $profilePropertyId);
                            }
                            switch (strtolower($fieldType)) {
                                case 'file':
                                    // change temporary file ID
                                    SJB_DB::query("UPDATE `uploaded_files` SET `id` = ?s WHERE `id` = ?s", $profilePropertyId, $fieldInfo['file_id']);

                                    // set value of user property to new uploaded file
                                    $user->setPropertyValue($fieldId, $profilePropertyId);
                                    break;

                                case 'logo':
                                    // change temporary file ID and thumb ID
                                    SJB_DB::query("UPDATE `uploaded_files` SET `id` = ?s WHERE `id` = ?s", $profilePropertyId, $fieldInfo['file_id']);
                                    SJB_DB::query("UPDATE `uploaded_files` SET `id` = ?s WHERE `id` = ?s", $profilePropertyId . '_thumb', $fieldInfo['file_id'] . '_thumb');

                                    // set value of user property to new uploaded file
                                    $user->setPropertyValue($fieldId, $profilePropertyId);
                                    break;

                                default:
                                    break;
                            }
                            $tmpUploadsStorage = SJB_Array::unsetValueByPath($tmpUploadsStorage, "{$formToken}/{$fieldId}");
                        }

                        // save user with new values
                        SJB_UserManager::saveUser($user);

                        // clean temporary storage
                        $tmpUploadsStorage = SJB_Array::unsetValueByPath($tmpUploadsStorage, "{$formToken}");

                        // CLEAR TEMPORARY SESSION STORAGE
                        SJB_Session::setValue('tmp_uploads_storage', $tmpUploadsStorage);
                    }
                }

                if ($user->getUserGroupSID() == SJB_UserGroup::EMPLOYER && SJB_Settings::getValue('approve_employers')) {
                    SJB_UserManager::setStatus($user->getSID(), SJB_User::STATUS_PENDING);
                    $tp->display('registration_approve.tpl');
                    return;
                }

                SJB_UserManager::setStatus($user->getSID(), SJB_User::STATUS_ACTIVE);
                SJB_Notifications::sendUserWelcomeLetter($user->getSID());
                SJB_Authorization::login($user->getUserName(), SJB_Request::getVar('password', ['original' => ''])['original'], false, $errors, $filled);

                if ($user->getUserGroupSID() == SJB_UserGroup::JOBSEEKER) {
                    $autofill = '';
                    if (SJB_Request::getVar('network')) {
                        $autofill = '&autofill=1&network=' . SJB_Request::getVar('network');
                    }
                    SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/add-listing/?listing_type_id=Resume' . $autofill);
                }

                $proceedToPosting = SJB_Session::getValue('proceed_to_posting');
                if ($proceedToPosting) {
                    $redirectUrl = SJB_HelperFunctions::getSiteUrl() . '/add-listing/?listing_type_id=' . SJB_Session::getValue('listing_type_id') . '&proceed_to_posting=' . $proceedToPosting . '&productSID=' . SJB_Session::getValue('productSID');
                } else {
                    // todo: редирект после регистрации туда откуда пришли!!!
                    $redirectUrl = SJB_UserGroupManager::getRedirectUrlByPageID();
                }
                SJB_HelperFunctions::redirect($redirectUrl);
            } else {
                $registration_form = SJB_ObjectMother::createForm($user);
                $registration_form->registerTags($tp);

                $form_fields = $registration_form->getFormFieldsInfo();

                // define default template with ajax checking
                $registration_form->setDefaultTemplateByFieldName('email', 'email_ajaxchecking.tpl');
                $registration_form->setDefaultTemplateByFieldName('username', 'unique_string.tpl');

                $tp->assign('user_group_info', SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid));
                $tp->assign('errors', $errors);
                $tp->assign('form_fields', $form_fields);

                $metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
                $tp->assign('METADATA', [
                    'form_fields' => $metaDataProvider->getFormFieldsMetadata($form_fields),
                ]);
            }
        } else {
            $template = 'registration_choose_user_group.tpl';
            $user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
            $tp->assign('user_groups_info', $user_groups_info);
        }
        $tp->assign('errors', $errors);
        $tp->display($template);
    }

    private function setSessionValueForRedirectAfterRegister()
    {
        $refererUri = SJB_Request::getVar('HTTP_REFERER', null, 'SERVER');
        if ($refererUri) {
            $refererUri = parse_url($refererUri);
            if (!empty($refererUri['path'])) {
                if (basename($refererUri['path']) != 'registration') {
                    if (basename($refererUri['path']) != 'add-listing') {
                        SJB_Session::unsetValue('proceed_to_posting');
                        SJB_Session::unsetValue('productSID');
                        SJB_Session::unsetValue('listing_type_id');
                    }
                }
            }
        }
    }
}
