<?php

class SJB_InvoiceManager extends SJB_ObjectManager
{
    public static function saveInvoice($invoice)
    {
        $serializedItemsDetails['items'] = $invoice->getPropertyValue('items');
        $products = isset($serializedItemsDetails['items']['products']) ? $serializedItemsDetails['items']['products'] : [];
        $products = implode(',', $products);
        $invoice->addProperty([
            'id' => 'serialized_items_info',
            'type' => 'text',
            'value' => serialize($serializedItemsDetails),
            'is_system' => true,
        ]);
        $invoice->addProperty([
            'id' => 'product_sid',
            'type' => 'string',
            'value' => $products,
            'is_system' => true,
        ]);
        $invoice->deleteProperty('items');

        $serializedTaxDetails['tax_info'] = $invoice->getPropertyValue('tax_info');
        $invoice->addProperty([
            'id' => 'serialized_tax_info',
            'type' => 'text',
            'value' => serialize($serializedTaxDetails),
            'is_system' => true,
        ]);
        $invoice->deleteProperty('tax_info');

        $dateProperty = $invoice->getProperty('date');
        $value = $dateProperty->getValue();
        if (!$dateProperty->type->getConvertToDBDate() && $value != null) {
            $invoice->setPropertyValue('date', SJB_I18N::getInstance()->getDate($value));
        }

        $invoice->setPropertyValue('sub_total', SJB_I18N::getInstance()->getFloat($invoice->getPropertyValue('sub_total')));
        $invoice->setPropertyValue('total', SJB_I18N::getInstance()->getFloat($invoice->getPropertyValue('total')));
        if ($invoice->getSID() && $invoice->getPropertyValue('status') == SJB_Invoice::INVOICE_STATUS_PAID) {
            $invoice->addProperty([
                'id' => 'status_paid',
                'type' => 'boolean',
                'value' => 1,
                'is_system' => true,
            ]);
        }
        parent::saveObject('invoices', $invoice);

        if ($value == null) {
            SJB_DB::query('UPDATE `invoices` SET `date` = ?s WHERE `sid`=?n', SJB_DateType::mysqlNow(), $invoice->getSID());
        }
    }

    public static function getInvoiceInfoBySID($invoiceSID)
    {
        $invoice_info = parent::getObjectInfoBySID('invoices', $invoiceSID);
        if (!empty($invoice_info['serialized_items_info'])) {
            $serialized_items_info = unserialize($invoice_info['serialized_items_info']);
            $invoice_info = array_merge($invoice_info, $serialized_items_info);
        }
        if (!empty($invoice_info['serialized_tax_info'])) {
            $serialized_tax_info = unserialize($invoice_info['serialized_tax_info']);
            $invoice_info = array_merge($invoice_info, $serialized_tax_info);
        }
        return $invoice_info;
    }

    /**
     * @param $invoiceSID
     * @return SJB_Invoice|null
     */
    public static function getObjectBySID($invoiceSID)
    {
        $invoiceInfo = SJB_InvoiceManager::getInvoiceInfoBySID($invoiceSID);

        if (is_null($invoiceInfo)) {
            return null;
        }
        $invoice = new SJB_Invoice($invoiceInfo);
        $invoice->setSID($invoiceSID);
        return $invoice;
    }

    public static function deleteInvoiceBySID($invoiceSID)
    {
        return SJB_InvoiceManager::deleteObject('invoices', $invoiceSID);
    }

    /**
     * @param $invoiceSID
     * @param bool|SJB_Contract $contract
     * @return array|null
     */
    public static function markPaidInvoiceBySID($invoiceSID, $contract = false)
    {
        $invoiceInfo = self::getInvoiceInfoBySID($invoiceSID);
        if ($invoiceInfo['status_paid'] != 1) {
            $invoice = SJB_InvoiceManager::getObjectBySID($invoiceSID);
            $userSID = $invoice->getPropertyValue('user_sid');
            if (SJB_UserManager::isUserExistsByUserSid($userSID)) {
                $items = $invoice->getPropertyValue('items');
                $productSIDs = $items['products'];
                foreach ($productSIDs as $key => $productSID) {
                    if (SJB_ProductsManager::isProductExists($productSID)) {
                        $productInfo = $invoice->getItemValue($key);
                        $listingNumber = $productInfo['qty'];
                        if (!$contract) {
                            $contract = new SJB_Contract(['product_sid' => $productSID, 'numberOfListings' => $listingNumber]);
                            $contract->setUserSID($userSID);
                            $contract->setPrice($items['amount'][$key]);
                            if ($contract->saveInDB()) {
                                SJB_ListingManager::activateListingsAfterPaid($userSID, $productSID, $contract->getID(), $listingNumber);
                                SJB_ShoppingCart::deleteItemsFromCartByUserSID($userSID);
                                if ($contract->isFeaturedProfile()) {
                                    SJB_UserManager::makeFeaturedBySID($userSID);
                                }
                                SJB_Notifications::sendSubscriptionActivationLetter($productInfo, $invoice);
                            }
                        } else {
                            SJB_Notifications::sendSubscriptionActivationLetter($productInfo, $invoice);
                        }
                    }
                }
            }
        }
        return SJB_DB::query("UPDATE `invoices` SET `status` = ?s, `status_paid` = 1 WHERE `sid` = ?n", SJB_Invoice::INVOICE_STATUS_PAID, $invoiceSID);
    }

    public static function markUnPaidInvoiceBySID($invoiceSID)
    {
        return SJB_DB::query("UPDATE `invoices` SET `status` = ?s WHERE `sid` = ?n", SJB_Invoice::INVOICE_STATUS_UNPAID, $invoiceSID);
    }

    public static function getPaymentForms($invoice)
    {
        $activeGateways = SJB_PaymentGatewayManager::getActivePaymentGatewaysList();
        $gatewaysFormInfo = [];
        foreach ($activeGateways as $gatewayInfo) {
            $gateway = SJB_PaymentGatewayManager::getObjectByID($gatewayInfo['id']);
            $gatewaysFormInfo[$gateway->getPropertyValue('id')] = $gateway->buildTransactionForm($invoice);
        }
        return $gatewaysFormInfo;
    }

    public static function getTotalPrice($subTotal, $taxAmount)
    {
        return $subTotal + $taxAmount;
    }

    /**
     * @param $items
     * @param $userSID
     * @param $subTotalPrice
     * @return SJB_Invoice
     */
    public static function generateInvoice($items, $userSID, $subTotalPrice)
    {
        $taxInfo = SJB_TaxesManager::getTaxInfoByPrice($subTotalPrice);
        $taxAmount = 0;
        if (!empty($taxInfo['tax_amount'])) {
            $taxAmount = $taxInfo['tax_amount'];
        }
        $totalPrice = SJB_InvoiceManager::getTotalPrice($subTotalPrice, $taxAmount);
        $invoiceInfo = [
            'user_sid' => $userSID,
            'include_tax' => !empty($taxInfo) ? 1 : 0,
            'total' => $totalPrice,
            'sub_total' => $subTotalPrice,
            'status' => $totalPrice == 0 ? SJB_Invoice::INVOICE_STATUS_VERIFIED : SJB_Invoice::INVOICE_STATUS_UNPAID,
            'tax_info' => $taxInfo,
            'items' => $items,
        ];
        $invoice = new SJB_Invoice($invoiceInfo);
        $recurringProduct = $invoice->getRecurringProduct();
        if ($recurringProduct) {
            $items = $invoice->getPropertyValue('items');
            $date = new DateTime();
            $startDate = $date->format('Y-m-d');
            $date->modify('+1 ' . $recurringProduct['billing_cycle']);
            $endDate = $date->format('Y-m-d');
            $items['names'] = [1 => $invoice->getProductNames() . sprintf(' (%s - %s)', SJB_TemplateProcessor::date($startDate), SJB_TemplateProcessor::date($endDate))];
            $invoice->setPropertyValue('items', $items);
        }
        return $invoice;
    }

    public static function getInvoicesInfo()
    {
        //TODO: можно ускорить и сделать так же как в листингах
        $res = [];
        $today = SJB_DateType::mysqlToday();
        $periods = [
            'Today' => "`i`.`date` >= '{$today}'",
            'Last 7 days' => "`i`.`date` >= date_sub('{$today}', interval 7 day)",
            'Last 30 days' => "`i`.`date` >= date_sub('{$today}', interval 30 day)",
            'Total' => '1=1',
        ];

        foreach ($periods as $key => $value) {
            $res[$key] = SJB_DB::queryValue("SELECT IFNULL(SUM(i.total), 0) AS `payment` FROM `invoices` i WHERE {$value} AND `status` = 'Paid'");
        }
        return $res;
    }

    public static function getInvoiceQuantityByProductSID($productSID)
    {
        return SJB_DB::queryValue("SELECT COUNT(*) FROM invoices WHERE FIND_IN_SET(?s, `product_sid`)", $productSID);
    }
}
