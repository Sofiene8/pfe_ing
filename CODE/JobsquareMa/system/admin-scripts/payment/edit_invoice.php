<?php

class SJB_Admin_Payment_EditInvoice extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_ECOMMERCE);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $template = 'edit_invoice.tpl';
        $errors = [];
        $invoiceErrors = [];
        $invoiceSID = SJB_Request::getVar('sid', false);
        $invoiceInfo = SJB_InvoiceManager::getInvoiceInfoBySID($invoiceSID);
        if (empty($invoiceInfo)) {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            return;
        }
        $product_info = [];
        if (array_key_exists('custom_info', $invoiceInfo['items'])) {
            $product_info = $invoiceInfo['items']['custom_info'];
        }
        $invoiceInfo = array_merge($invoiceInfo, $_REQUEST);
        $invoiceInfo['items']['custom_info'] = $product_info;
        $invoice = new SJB_Invoice($invoiceInfo);
        $invoice->setSID($invoiceSID);
        $userSID = $invoice->getPropertyValue('user_sid');
        $user = SJB_UserManager::getObjectBySID($userSID);
        $taxInfo = $invoice->getPropertyValue('tax_info');
        $products = [];
        if ($user) {
            $productsSIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($user->getUserGroupSID(), true);
            foreach ($productsSIDs as $key => $productSID) {
                $products[$key] = SJB_ProductsManager::getProductInfoBySID($productSID);
            }
        }

        $addForm = new SJB_Form($invoice);
        $addForm->registerTags($tp);
        $tp->assign('products', $products);
        $tp->assign('invoice_sid', $invoiceSID);
        $tp->assign('invoice_hash', $invoice->getHash());
        $tp->assign('include_tax', $invoiceInfo['include_tax']);
        $tp->assign('user', SJB_UserManager::createTemplateStructureForUser($user));
        $tp->assign('tax', $taxInfo);
        $transactions = SJB_TransactionManager::getTransactionsByInvoice($invoiceSID);
        $tp->assign('transactions', $transactions);
        $tp->assign('errors', array_merge($errors, $invoiceErrors));
        $tp->display($template);
    }
}
