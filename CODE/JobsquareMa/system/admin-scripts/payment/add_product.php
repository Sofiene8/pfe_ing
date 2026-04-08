<?php

class SJB_Admin_Payment_AddProduct extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_ECOMMERCE);
        return parent::isAccessible();
    }

    public function execute()
    {
        if (SJB_Request::getVar('recurring') && !SJB_AdminAcl::getInstance()->isFeatureAllowed('Recurring')) {
            echo SJB_System::executeFunction('miscellaneous', 'function_is_not_accessible', [
                'message' => sprintf(
                    '<p>Recurring subscription products are not available for your current plan.</p>' .
                    '<p>It allows you to charge your customers automatically on a recurring basis.</p>' .
                    '<p><a href="%s" class="btn btn--primary">Upgrade your account now</a></p>',
                    SJB_AdminAcl::getInstance()->getUpgradeUrl()
                )
            ]);
            return;
        }

        $tp = SJB_System::getTemplateProcessor();
        $errors = [];
        $productErrors = [];

        if (!SJB_Request::getVar('user_group_sid')) {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            return;
        }

        $listingTypeSID = SJB_Request::getVar('listing_type_sid', false);
        if($listingTypeSID) {
            if ($listingTypeSID == '26') {
                $_REQUEST['listing_type_sid'] = SJB_ListingTypeManager::TRAINING;
            }
        } else {
            $_REQUEST['listing_type_sid'] = SJB_Request::getVar('user_group_sid') == SJB_UserGroup::EMPLOYER ? SJB_ListingTypeManager::JOB : SJB_ListingTypeManager::RESUME;
        }
        $tp->assign('listing_type_sid', $_REQUEST['listing_type_sid']);

        $userGroup = SJB_UserGroupManager::getUserGroupInfoBySID(SJB_Request::getVar('user_group_sid'));

        $product = new SJB_Product($_REQUEST);
        $pages = $product->getProductPages();
        $addProductForm = new SJB_Form($product);
        $addProductForm->registerTags($tp);
        $form_submitted = SJB_Request::getVar('action', '') == 'save';
        if ($form_submitted) {
            $productErrors = $product->isValid($product);
        }

        if ($form_submitted && $addProductForm->isDataValid($errors) && !$productErrors) {
            $product->saveProduct($product);
            $product->savePermissions($_REQUEST);
            \SJB\Analytics\Logger::log("Created {$userGroup['name']} Product");
            if (SJB_Request::getVar('recurring')) {
                \SJB\Analytics\Logger::log("Created {$userGroup['name']} Recurring Product");
            }
            if ($userGroup['sid'] == SJB_UserGroup::EMPLOYER) {
                \SJB\Analytics\Logger::intercom('Created employer product');
            }
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . '/products/' . strtolower($userGroup['id']) . '/');
        }
        $errors = array_merge($errors, $productErrors);
        $formFieldsInfo = $addProductForm->getFormFieldsInfo();
        $formFields = [];
        foreach ($pages as $pageID => $page) {
            foreach ($formFieldsInfo as $formFieldInfo) {
                if (in_array($formFieldInfo['id'], $page['fields'])) {
                    $formFields[$pageID][] = $formFieldInfo;
                }
            }
            if (!isset($formFields[$pageID])) {
                $formFields[$pageID] = [];
            }
        }

        if (SJB_Request::getVar('recurring')) {
            $activeRecurringGateways = false;
            foreach (SJB_PaymentGatewayManager::getActivePaymentGatewaysList() as $gateway) {
                $gateway = SJB_PaymentGatewayManager::getObjectByID($gateway['id']);
                if ($gateway->isRecurring()) {
                    $activeRecurringGateways = true;
                }
            }
            if (!$activeRecurringGateways) {
                SJB_FlashMessages::getInstance()->addError('Recurring subscriptions can be used with Stripe or PayPal Express payment methods only. Please activate one of them to accept recurring payments.');
            }
            $tp->assign('recurring', 1);
        }

        $tp->assign('form_fields', $formFields);
        $tp->assign('request', $_REQUEST);
        $tp->assign('params', http_build_query($_REQUEST));
        $tp->assign('pages', $pages);
        $tp->assign('listingType', SJB_ListingTypeManager::getListingTypeInfoBySID($_REQUEST['listing_type_sid']));
        $tp->assign('userGroup', $userGroup);
        $tp->assign('errors', $errors);
        $tp->display('add_product.tpl');
    }
}
