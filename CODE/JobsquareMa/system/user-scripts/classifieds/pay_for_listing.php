<?php

class SJB_Classifieds_PayForListing extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();

        if (!SJB_UserManager::isUserLoggedIn()) {
            $tp->assign('ERRORS', ['NOT_LOGGED_IN' => true]);
            $tp->display('error.tpl');
            return;
        }

        $listingSid = SJB_Request::getVar('listing_id');
        $listing = SJB_ListingManager::getObjectBySID($listingSid);

        if (!is_null($listing) && !$listing->isActive()) {
            $listingInfo = SJB_ListingManager::getListingInfoBySID($listing->getSID());
            $productInfo = $listing->getProductInfo();
            if (SJB_ListingDBManager::isListingExpired($listing) || empty($listingInfo['checkouted']) || !empty($productInfo['recurring'])) {
                $typeId = $listing->getListingTypeSID() == SJB_ListingTypeManager::JOB ? 'Job' : 'Resume';

                // если нет продуктов то редиректит на покупку
                // если не залогинен то ошибка
                if ($productsInfo = SJB_ListingManager::canCurrentUserAddListing($typeId)) {
                    $contractID = SJB_Request::getVar('contract_id', false, 'POST');
                    if (count($productsInfo) == 1) {
                        $contractID = current($productsInfo)['contract_id'];
                    }
                    if ($contractID) {
                        foreach ($productsInfo as $product) {
                            if ($product['contract_id'] == $contractID) {
                                SJB_ListingManager::setContractAndActivate($listing, $contractID);
                                SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . SJB_TemplateProcessor::listing_url($listingInfo) . '?isBoughtNow=1');
                            }
                        }
                    }
                    $tp->assign('products_info', $productsInfo);
                    $tp->assign('listingTypeID', $typeId);
                    $tp->assign('listing_id', $listing->getSID());
                    $tp->display('../classifieds/listing_product_choice.tpl');
                } else {
                    $url = SJB_H::getSiteUrl() . (SJB_UserManager::getCurrentUser()->getUserGroupSID() == SJB_UserGroup::EMPLOYER ? '/employer-products/' : '/jobseeker-products/');
                    SJB_H::redirect($url . '?listing_id=' . $listingInfo['sid'] . '&permission=post_' . mb_strtolower($typeId));
                }
            } else {
                if (SJB_Settings::getValue('approve_job') && $listing->getListingTypeSID() == SJB_ListingTypeManager::JOB) {
                    SJB_ListingManager::setStatus($listing->getSID(), SJB_Listing::STATUS_PENDING);
                } else {
                    SJB_ListingManager::activateListingBySID($listing->getSID(), true, true, $listing->getActivationDate());
                }
                SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . SJB_TemplateProcessor::listing_url($listing) . '?isBoughtNow=1');
            }
        } elseif (is_null($listingSid)) {
            $errors['INVALID_LISTING_ID'] = 1;
        } elseif (!is_null($listing) && $listing->isActive()) {
            $errors['LISTING_ALREADY_ACTIVE'] = 1;
        } else {
            $errors['WRONG_LISTING_ID_SPECIFIED'] = 1;
        }

        $tp->assign('errors', isset($errors) ? $errors : null);
        $tp->display('pay_for_listing.tpl');
    }
}
