<?php

class SJB_Social_RegistrationSocial extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $user_group_id = SJB_Request::getVar('user_group_id', null);

        $user = new SJB_User();
        $user->addProperty([
            'id' => 'username',
            'type' => 'unique_email',
        ]);

        SJB_Event::dispatch('SocialPlugin_AddListingFieldsIntoRegistration', $user, true);
        SJB_Event::dispatch('FillRegistrationData_Plugin', $user, true);
        SJB_Event::dispatch('AddReferencePluginDetails', $user, true);

        $userId = SJB_UserManager::getUserSIDbyUsername($user->getUserName());

        if ($userId) {
            $user = SJB_UserManager::getObjectBySID($userId);
            SJB_Event::dispatch('AddReferencePluginDetails', $user, true);
        }

        if ($user_group_id || $user->getSID()) {
            if (!$user->getSID()) {
                $user_group_sid = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);

                $user = SJB_ObjectMother::createUser($_REQUEST, $user_group_sid);
                $user->deleteProperty('active');
                $user->deleteProperty('featured');

                $errors = array();

                // social plugin
                SJB_Event::dispatch('SocialPlugin_AddListingFieldsIntoRegistration', $user, true);
                SJB_Event::dispatch('FillRegistrationData_Plugin', $user, true);
                SJB_Event::dispatch('AddReferencePluginDetails', $user, true);

                $user->deleteProperty('active');
                $user->deleteProperty('featured');

                if (!$user->getUserName()) {
                    SJB_FlashMessages::getInstance()->addError('Oops something went wrong');
                    return;
                }
                SJB_UserManager::saveUser($user);

                // subscribe user on default product
                $defaultProduct = SJB_UserGroupManager::getDefaultProduct($user_group_sid);
                $availableProductIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($user_group_sid);

                if ($defaultProduct && in_array($defaultProduct, $availableProductIDs)) {
                    $contract = new SJB_Contract(array('product_sid' => $defaultProduct));
                    $contract->setUserSID($user->getSID());
                    $contract->saveInDB();
                }

                if ($user->getUserGroupSID() == SJB_UserGroup::EMPLOYER && SJB_Settings::getValue('approve_employers')) {
                    SJB_UserManager::setStatus($user->getSID(), SJB_User::STATUS_PENDING);
                    // save access token, profile info for synchronization
                    SJB_SocialPlugin::postRegistration();
                    $tp->display('../users/registration_approve.tpl');
                    return;
                }
                SJB_UserManager::setStatus($user->getSID(), SJB_User::STATUS_ACTIVE);
                SJB_Notifications::sendUserWelcomeLetter($user->getSID());
            }

            $loggedIn = SJB_Authorization::login($user->getUserName(), $user->getPropertyValue('password'), false, $errors, false, true);
            // save access token, profile info for synchronization
            SJB_SocialPlugin::postRegistration();

            if ($loggedIn) {
                if ($user->getUserGroupSID() == SJB_UserGroup::JOBSEEKER) {
                    SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/add-listing/?listing_type_id=Resume&autofill=1');
                }
                SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/edit-profile/');
            } else {
                $tp->assign('errors', $errors);
                $tp->display('../users/errors.tpl');
            }
        } else {
            $tp->assign('user_groups_info', SJB_UserGroupManager::getAllUserGroupsInfo());
            $tp->display('registration_choose_user_group_social.tpl');
        }
    }
}
