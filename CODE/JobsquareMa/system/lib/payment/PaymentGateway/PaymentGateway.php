<?php

class SJB_PaymentGateway extends SJB_Object
{
    public $amountField = '';

    /**
     * @param array|null $gateway_info
     */
    public function __construct($gateway_info = [])
    {
        $this->details = new SJB_PaymentGatewayDetails($gateway_info);
    }

    function isValid()
    {
        return true;
    }

    function isPaymentVerified($invoice)
    {
        return true;
    }

    function getPaymentFromCallbackData($callback_data, $invoice_sid)
    {
        return null;
    }

    function getTemplate()
    {
    }

    /**
     * @param SJB_Invoice $invoice
     * @return bool
     */
    public function checkPaymentAmount(SJB_Invoice $invoice)
    {
        $priceFromCallbackData = SJB_Request::getVar($this->amountField);

        //verifying that the item amounts match the amounts that you charge
        if ($invoice->getPropertyValue('total') != $priceFromCallbackData) {
            $this->errors['AMOUNT_IS_NOT_MATCH'] = 1;
            return false;
        }
        return true;
    }

    /**
     * @return SJB_Invoice|bool
     */
    public function charge($invoice)
    {
        return false;
    }

    public function isRecurring()
    {
        return false;
    }

    public function cancelRecurring($contract)
    {
        return false;
    }
}
