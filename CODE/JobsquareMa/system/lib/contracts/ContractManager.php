<?php

class SJB_ContractManager
{
    public static function deleteContract($contract_id)
    {
        $contract = new SJB_Contract(['contract_id' => $contract_id]);

        if ($contract->isFeaturedProfile()) {
            $allContracts = self::getAllContractsInfoByUserSID($contract->getUserSID());
            $featured = false;
            foreach ($allContracts as $userContract) {
                if ($userContract['id'] != $contract_id) {
                    $userContract = new SJB_Contract(['contract_id' => $userContract['id']]);
                    if ($userContract->isFeaturedProfile()) {
                        $featured = true;
                        break;
                    }
                }
            }
            if (!$featured) {
                SJB_UserManager::removeFromFeaturedBySID($contract->getUserSID());
            }
        }
        $permissions = SJB_Acl::getInstance();
        $permissions->clearPermissions('contract', $contract_id);
        if ($contract->isRecurring()) {
            $listings = SJB_DB::query('select `sid` from `listings` where `contract_id` = ?n', $contract->getID());
            foreach ($listings as $listing) {
                $listing = SJB_ListingManager::getObjectBySID($listing['sid']);
                SJB_ListingManager::deactivateListingBySID($listing->getSID(), true);
                $listingInfo = SJB_ListingManager::createTemplateStructureForListing($listing);
                SJB_Notifications::sendUserListingExpiredLetter($listingInfo);
            }
        }
        return $contract->delete();
    }

    public static function deleteAllContractsByUserSID($user_sid)
    {
        return SJB_DB::query("DELETE FROM `contracts` WHERE `user_sid`=?n", $user_sid);
    }

    public static function getExpiredContractsID()
    {
        $expired_contracts = SJB_DB::query("SELECT id FROM contracts WHERE expired_date < ?s AND expired_date != '0000-00-00'", SJB_DateType::mysqlNow());
        $contracts_id = [];
        foreach ($expired_contracts as $expired_contract) {
            $contracts_id[] = $expired_contract['id'];
        }
        return $contracts_id;
    }

    public static function getInfo($contract_id)
    {
        if ($contract_id == 0) {
            return false;
        }
        $contractInfo = SJB_ContractSQL::selectInfoByID($contract_id);

        if ($contractInfo && empty($contractInfo['serialized_extra_info'])) {
            $product = SJB_ProductsManager::getProductInfoBySID($contractInfo['product_sid']);
            $contractInfo['serialized_extra_info'] = $product['serialized_extra_info'];
        }

        return $contractInfo;
    }

    public static function getAllContractsInfoByUserSID($user_sid)
    {
        if ($user_sid == 0) {
            return false;
        }
        $contractsInfo = SJB_ContractSQL::selectInfoByUserSID($user_sid);

        foreach ($contractsInfo as $key => $contractInfo) {
            if ($contractInfo && empty($contractInfo['serialized_extra_info'])) {
                $product = SJB_ProductsManager::getProductInfoBySID($contractInfo['product_sid']);
                $contractInfo['serialized_extra_info'] = $product['serialized_extra_info'];
                $contractsInfo[$key] = $contractInfo;
            }
        }
        return $contractsInfo;
    }

    public static function getExtendedContractsInfoByUserSID($user_sid, $acl)
    {
        $listingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
        $contractsInfo = SJB_ContractManager::getAllContractsInfoByUserSID($user_sid);
        foreach ($contractsInfo as $key => $contractInfo) {
            $contractInfo['extra_info'] = unserialize($contractInfo['serialized_extra_info']);
            $contractInfo['listingAmount'] = [];
            foreach ($listingTypes as $listingType) {
                $listingTypeID = $listingType['id'];
                if ($acl->isAllowed('post_' . $listingTypeID, $contractInfo['id'], 'contract')) {
                    $contractInfo['listingAmount'][$listingTypeID]['name'] = $listingType['name'];
                    $permissionParam = $acl->getPermissionParams('post_' . $listingTypeID, $contractInfo['id'], 'contract');
                    $contractInfo['listingAmount'][$listingTypeID]['numPostings'] = $contractInfo['number_of_postings'];
                    if (!empty($contractInfo['extra_info']['recurring'])) {
                        $contractInfo['listingAmount'][$listingTypeID]['numPostings'] =
                            SJB_DB::queryValue('select count(*) from `listings` where `contract_id` = ?n and `active` = ?n', $contractInfo['id'], SJB_Listing::STATUS_ACTIVE);


                    }
                    if (empty($permissionParam)) {
                        $contractInfo['listingAmount'][$listingTypeID]['count'] = 'unlimited';
                        $contractInfo['listingAmount'][$listingTypeID]['listingsLeft'] = 'unlimited';
                    } else {
                        $contractInfo['listingAmount'][$listingTypeID]['count'] = $permissionParam;
                        $contractInfo['listingAmount'][$listingTypeID]['listingsLeft'] =
                            max($contractInfo['listingAmount'][$listingTypeID]['count'] - $contractInfo['listingAmount'][$listingTypeID]['numPostings'], 0);
                    }
                }
                if (!empty($contractInfo['extra_info']['recurring'])) {
                    $invoice = SJB_InvoiceManager::getInvoiceInfoBySID($contractInfo['invoice_id']);
                    $contractInfo['recurring'] = true;
                    if ($invoice && !empty($invoice['recurring_id']) && $contractInfo['status'] == 'active') {
                        $contractInfo['recurring_status'] = 'active';
                    } elseif ($contractInfo['status'] == 'canceled') {
                        $contractInfo['recurring_status'] = 'canceled';
                    }
                }
            }

            $contractsInfo[$key] = $contractInfo;
            $contractsInfo[$key]['product_info'] = SJB_ProductsManager::getProductInfoBySID($contractInfo['extra_info']['product_sid']);
        }
        return $contractsInfo;
    }

    public static function getAllContractsSIDsByUserSID($user_sid)
    {
        if ($user_sid == 0) {
            return false;
        }
        $contractsInfo = SJB_ContractSQL::selectInfoByUserSID($user_sid);
        $result = [];
        foreach ($contractsInfo as $contractInfo) {
            $result[] = $contractInfo['id'];
        }
        return $result;
    }

    public static function getExtraInfoByID($contract_id)
    {
        $extra_info = SJB_DB::queryValue("SELECT serialized_extra_info FROM contracts WHERE id = ?n", $contract_id);
        $contract_extra_info = false;
        if (!empty($extra_info))
            $contract_extra_info = unserialize($extra_info);

        return $contract_extra_info;
    }

    public static function getAllContractsByProductSID($productSID)
    {
        return SJB_DB::query("SELECT `id` FROM `contracts` WHERE `product_sid` = ?n", $productSID);
    }

    public static function getContractQuantityByProductSID($productSID)
    {
        $result = SJB_DB::queryValue("SELECT COUNT( DISTINCT users.sid)
							FROM users 
							INNER JOIN contracts ON users.sid = contracts.user_sid 
							INNER JOIN products ON products.sid = contracts.product_sid 
							WHERE products.sid=?n", $productSID);

        return $result ? $result : 0;
    }

    public static function updateExpirationPeriod($contractSID)
    {
        $contractInfo = self::getInfo($contractSID);
        if ($contractInfo) {
            $productInfo = SJB_ProductsManager::getProductInfoBySID($contractInfo['product_sid']);
            $product = new SJB_Product($productInfo);
            $expirationPeriod = $product->getExpirationPeriod();
            if ($expirationPeriod) {
                $expired_date = date("Y-m-d", strtotime("+" . $expirationPeriod . " day"));
                SJB_DB::query("UPDATE `contracts` SET `expired_date` = ?s WHERE `id` = ?n", $expired_date, $contractSID);
            }
        }
    }

    public static function getListingsNumberByContractSIDsListingType($contractsSIDs, $listingTypeID)
    {
        $acl = SJB_Acl::getInstance();
        $result = 0;
        foreach ($contractsSIDs as $contractSID) {
            if ($acl->isAllowed('post_' . $listingTypeID, $contractSID, 'contract')) {
                $contractInfo = self::getInfo($contractSID);
                $result += $contractInfo['number_of_postings'];
            }
        }
        return $result;
    }

    public static function getContractIDByInvoiceID($invoiceID)
    {
        return SJB_DB::queryValue("SELECT `id` FROM `contracts` WHERE `invoice_id` = ?s", $invoiceID);
    }

}
