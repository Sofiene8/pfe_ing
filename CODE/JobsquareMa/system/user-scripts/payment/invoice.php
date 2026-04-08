<?php

class SJB_Payment_Invoice extends SJB_Function
{
    public function execute()
    {
        list($id, $hash) = SJB_UrlParamProvider::getParams();
        $invoice = SJB_InvoiceManager::getObjectBySID($id);
        $tp = SJB_System::getTemplateProcessor();
        if (!$invoice || $invoice->getHash() != $hash) {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            return;
        }

        $invoiceInfo = SJB_InvoiceManager::getInvoiceInfoBySID($id);
        $product_info = [];
        if (array_key_exists('custom_info', $invoiceInfo['items'])) {
            $product_info = $invoiceInfo['items']['custom_info'];
        }
        $invoiceInfo = array_merge($invoiceInfo, $_REQUEST);
        $invoiceInfo['items']['custom_info'] = $product_info;
        $invoice = new SJB_Invoice($invoiceInfo);
        if (!empty($invoiceInfo['items']['names'])) {
            $tp->assign('names', $invoiceInfo['items']['names']);
        }

        $products = [];
        $user = SJB_UserManager::getObjectBySID($invoice->getUserSID());

        if ($user) {
            $productsSIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($user->getUserGroupSID(), true);
            foreach ($productsSIDs as $key => $productSID) {
                $products[$key] = SJB_ProductsManager::getProductInfoBySID($productSID);
            }
        }

        $addForm = new SJB_Form($invoice);
        $addForm->registerTags($tp);

        $gateway = $invoice->getPropertyValue('payment_method');
        if ($gateway) {
            $tp->assign('gateway', SJB_PaymentGatewayManager::getInfoBySID(SJB_PaymentGatewayManager::getSIDByID($gateway)));
        }
        $tp->assign('user', SJB_UserManager::createTemplateStructureForUser($user));
        $tp->assign('invoice_sid', $id);
        $tp->assign('products', $products);
        $tp->assign('include_tax', $invoiceInfo['include_tax']);
        $tp->assign('tax', $invoice->getPropertyValue('tax_info'));
        $tp->assign('theme_settings', ThemeManager::getThemeSettings(SJB_Settings::getValue('TEMPLATE_USER_THEME')));
        $tp->display('invoice.tpl');
    }
}
