<?php

class SJB_PaymentHandler
{
    /**
     * @var null|int
     */
    private $invoiceSID = null;
    private $product = null;
    private $gatewayID = '';

    public function __construct($invoiceSID, $gatewayID)
    {
        $this->invoiceSID = $invoiceSID;
        $this->gatewayID = $gatewayID;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function createContract($userSID, $invoiceID)
    {
        $listingNumber = !empty($this->product['qty']) ? $this->product['qty'] : null;
        $contract = new SJB_Contract([
            'product_sid' => $this->product['sid'],
            'gateway_id' => $this->gatewayID,
            'invoice_id' => $invoiceID,
            'numberOfListings' => $listingNumber
        ]);
        $contract->setUserSID($userSID);
        $contract->setPrice($this->product['amount']);
        if ($contract->saveInDB()) {
            SJB_ListingManager::activateListingsAfterPaid($userSID, $this->product['sid'], $contract->getID(), $listingNumber);
            SJB_ShoppingCart::deleteItemsFromCartByUserSID($userSID);
            if ($contract->isFeaturedProfile()) {
                SJB_UserManager::makeFeaturedBySID($userSID);
            }
            SJB_Notifications::sendSubscriptionActivationLetter($this->product, SJB_InvoiceManager::getObjectBySID($invoiceID));
        }
    }

    public function deleteContract($invoiceID)
    {
        $contractID = SJB_ContractManager::getContractIDByInvoiceID($invoiceID);
        if ($contractID) {
            SJB_ContractManager::deleteContract($contractID);
        }
    }

}
