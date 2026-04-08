<?php

class SJB_Payment_UserProducts extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $current_user = SJB_UserManager::getCurrentUser();
        $action = SJB_Request::getVar('action', 'productList');
        $productSID = SJB_Request::getVar('product_sid', 0, 'default', 'int');
        $template = 'products.tpl';
        $errors = [];

        switch ($action) {
            case 'view_product_detail':
                if (!SJB_UserManager::isUserLoggedIn() || $current_user->mayChooseProduct($productSID, $errors)) {
                    $productInfo = SJB_ProductsManager::getProductInfoBySID($productSID);
                    $productInfo['listingTypeID'] = SJB_ListingTypeManager::getListingTypeIDBySID($productInfo['listing_type_sid']);
                    if (SJB_Request::getInt('listing_id')) {
                        $productInfo['proceedToListing'] = SJB_Request::getInt('listing_id');
                    }
                    $event = SJB_Request::getVar('event', false);
                    if ($event && $productInfo && !$errors) {
                        if (SJB_UserManager::isUserLoggedIn()) {
                            SJB_ShoppingCart::addToShoppingCart($productInfo, $current_user->getSID());
                        } else {
                            if (!$errors) {
                                $id = time();
                                $_SESSION['products'][$id]['product_info'] = serialize($productInfo);
                                $_SESSION['products'][$id]['sid'] = $id;
                                $_SESSION['products'][$id]['user_sid'] = 0;
                            }
                        }
                        if (!$errors) {
                            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/shopping-cart/');
                        }
                    }

                    if (!empty($productInfo['expiration_period']) && !is_numeric($productInfo['expiration_period']))
                        $productInfo['period'] = ucwords($productInfo['expiration_period']);
                    elseif (!empty($productInfo['pricing_type']) && $productInfo['pricing_type'] == 'fixed') {
                        $productInfo['fixed_period'] = 1;
                    }

                    $userGroupID = SJB_UserGroupDBManager::getUserGroupIDBySID($productInfo['user_group_sid']);
                    $tp->assign('productInfo', $productInfo);
                    $tp->assign('userGroupID', $userGroupID);
                    $tp->assign('productSID', $productSID);
                    $tp->assign('mayChooseProduct', true);
                }
                $tp->assign('errors', $errors);

            default:
                $permission = SJB_Request::getVar('permission', false);
				 $packs = SJB_Request::getVar('packs', false);
				 
                if ($permission && !SJB_UserManager::isUserLoggedIn()) {
                    echo SJB_System::executeFunction('users', 'login');
                    return;
                }
                $availableProducts = [];
                if (SJB_UserManager::isUserLoggedIn() && $permission) {
                    $availableProducts = SJB_ProductsManager::getProductsByUserGroupSID($current_user->getUserGroupSID(), $current_user->getSID());
                    foreach ($availableProducts as $key => $availableProduct) {
                        if ($permission && empty($availableProduct[$permission])) {
                            unset($availableProducts[$key]);
                        }
                    }
                    $tp->assign('permission', $permission);
					$tp->assign('packs', $packs);
                } elseif ($userGroupID = SJB_Request::getVar('userGroupID', false)) {
                    $userGroupSID = SJB_UserGroupManager::getUserGroupSIDByID($userGroupID);
                    $availableProducts = SJB_ProductsManager::getProductsByUserGroupSID($userGroupSID, 0);
                } else {
                    $availableProducts = SJB_ProductsManager::getAllActiveProducts();
                }
                if ($current_user) {
                    $trialProducts = $current_user->getTrialProductSIDByUserSID();
                    foreach ($availableProducts as $key => $availableProduct) {
                        if (in_array($availableProduct['sid'], $trialProducts)) {
                            unset($availableProducts[$key]);
                        }
                    }
                }

                foreach ($availableProducts as $key => $availableProductInfo) {
                    $availableProduct = new SJB_Product($availableProductInfo);
                    $availableProduct->setNumberOfListings(1);
                    $availableProducts[$key]['price'] = $availableProduct->getPrice();
                    if (isset($availableProducts[$key]['listing_type_sid'])) {
                        $availableProducts[$key]['listing_type_id'] = SJB_ListingTypeDBManager::getListingTypeIDBySID($availableProducts[$key]['listing_type_sid']);
                    }
                }
				$acl = SJB_Acl::getInstance();
				
				$my_products = SJB_ContractManager::getExtendedContractsInfoByUserSID($current_user->getSID(), $acl);
				
                
				 SJB_Event::dispatch('RedefineTemplateName', $template, true);
                SJB_Event::dispatch('RedefineProductsDisplayInfo', $availableProducts, true);
                $tp->assign('availableProducts', $availableProducts);
				$tp->assign('my_products',$my_products);
                break;
        }
        $tp->assign('listing_id', SJB_Request::getInt('listing_id'));
        $tp->display($template);
    }
}
