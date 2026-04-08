<?php

class SJB_Admin_Payment_Products extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_ECOMMERCE);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $action = SJB_Request::getVar('action', false);
        $sid = SJB_Request::getVar('sid', 0);

        switch ($action) {
            case 'activate':
                SJB_ProductsManager::activateProductBySID($sid);
                break;
            case 'deactivate':
                SJB_ProductsManager::deactivateProductBySID($sid);
                break;
            case 'delete':
                SJB_ProductsManager::deleteProductBySID($sid, true);
                break;
            case 'reorder':
                foreach (SJB_Request::getVar('products', []) as $key => $product) {
                    SJB_DB::query('update `products` set `order` = ?n where `sid` = ?n', $key + 1, $product);
                };
                break;
        }

        $userGroup = SJB_UserGroupManager::getUserGroupInfoBySID(
            SJB_UserGroupManager::getUserGroupSIDByID($this->params['user_group_id'])
        );
        $products = SJB_ProductsManager::getUserGroupProducts($userGroup['sid']);

        foreach ($products as $key => $productInfo) {
            $product = new SJB_Product($productInfo);
            $products[$key]['price'] = $product->getPrice();
            if (!empty($productInfo['availability_to']) && $productInfo['availability_to'] < date('Y-m-d')) {
                $products[$key]['expired'] = 1;
            }
        }

        $tp->assign('userGroup', $userGroup);
        $tp->assign('products', $products);
        $tp->display('products.tpl');
    }
}
