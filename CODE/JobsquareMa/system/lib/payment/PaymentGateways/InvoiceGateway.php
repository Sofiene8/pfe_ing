<?php

class SJB_InvoiceGateway extends SJB_PaymentGateway
{
    public $errors = array();

    function __construct($gateway_info = array())
    {
        parent::__construct($gateway_info);
        $this->details = new SJB_InvoiceGatewayDetails($gateway_info);
    }

    function buildTransactionForm($invoice)
    {
        if (count($invoice->isValid()) == 0) {
            return [
                'caption' => $this->getPropertyValue('caption'),
                'id' => $this->getPropertyValue('id'),
                'payment_instructions' => $this->getPropertyValue('payment_instructions'),
                'url' => SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/",
            ];
        }
        return null;
    }

    function getPaymentFromCallbackData($callback_data, $invoice_sid)
    {
        if (empty($invoice_sid)) {
            $this->errors['INVOICE_ID_IS_NOT_SET'] = 1;
            return null;
        }

        $invoice = SJB_InvoiceManager::getObjectBySID($invoice_sid);

        if (is_null($invoice)) {
            $this->errors['NONEXISTED_INVOICE_ID_SPECIFIED'] = 1;
            return null;
        }

        if ($invoice->getStatus() != SJB_Invoice::INVOICE_STATUS_UNPAID) {
            return $invoice;
        }

        $invoice->setCallbackData([]);
        $invoice->setPropertyValue('payment_method', $this->getPropertyValue('id'));
        SJB_InvoiceManager::saveInvoice($invoice);
        // После сохранения инвойс чуть портится
        $invoice = SJB_InvoiceManager::getObjectBySID($invoice->getID());

        if ($this->getPropertyValue('mark_as_paid')) {
            $invoice->setStatus(SJB_Invoice::INVOICE_STATUS_VERIFIED);
        } else {
            // если выставляем paid то получаем сообщение о удачности,
            // но при этом инвойс остаётся pending
            $invoice->setStatus(SJB_Invoice::INVOICE_STATUS_PAID);

            // скрываем сообщения о возможности постинга (callback)
            $invoice->setPropertyValue('items', ['products' => []]);
        }

        return $invoice;
    }
}
