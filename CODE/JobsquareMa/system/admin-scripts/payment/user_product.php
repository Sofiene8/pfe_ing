<?php

class SJB_Admin_Payment_UserProduct extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_JOB_BOARD);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $userSID = SJB_Request::getVar('user_sid', false);
        $page = SJB_Request::getVar('page', '');
        $action = SJB_Request::getVar('action', false);
        $user = SJB_UserManager::getUserInfoBySID($userSID);
        $tp->assign('user_sid', $userSID);
        $contractID = SJB_Request::getVar("contract_id", 0);
        if ($user) {
            switch ($page) {
                case 'add_product':
                    if ($action == 'add_product') {
                        $productSID = SJB_Request::getVar('product_sid', false);
                        if ($productSID) {
                            $contract = new SJB_Contract(['product_sid' => $productSID]);
                            $contract->setUserSID($userSID);
                            $contract->saveInDB();
                            if ($contract->isFeaturedProfile()) {
                                SJB_UserManager::makeFeaturedBySID($userSID);
                            }
                            $tp->assign('contract_added', 1);
                        } else {
                            $errors['UNDEFINED_PRODUCT_SID'] = 1;
                        }
                    }

                    $products = SJB_ProductsManager::getUserGroupProducts($user['user_group_sid']);
                    $tp->assign('products', $products);
                    $tp->display('add_user_product.tpl');
                    break;

                case 'user_products':
                    switch ($action) {
                        case 'remove':
                            SJB_ContractManager::deleteContract($contractID);
                            break;
                    }
                    $userInfo = SJB_UserManager::getUserInfoBySID($userSID);
                    $tp->assign('user_group_info', SJB_UserGroupManager::getUserGroupInfoBySID($userInfo['user_group_sid']));
                    $tp->assign('contracts', SJB_ContractManager::getExtendedContractsInfoByUserSID($userSID, SJB_Acl::getInstance()));
                    $tp->display('user_products.tpl');
                    break;
            }
        } else {
            $errors['USER_DOES_NOT_EXIST'] = 1;
            $tp->assign('errors', $errors);
            $tp->display('../users/error.tpl');
        }
    }
}
