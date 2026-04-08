<?php

use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\EBLBaseComponents\DoExpressCheckoutPaymentRequestDetailsType;
use PayPal\EBLBaseComponents\DoReferenceTransactionRequestDetailsType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\PayPalAPI\BAUpdateRequestType;
use PayPal\PayPalAPI\BillAgreementUpdateReq;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentReq;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentRequestType;
use PayPal\PayPalAPI\DoReferenceTransactionReq;
use PayPal\PayPalAPI\DoReferenceTransactionRequestType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;

class SJB_PayPalExpress extends SJB_PaymentGateway
{
    public $errors = [];

    public function __construct($gateway_info = [])
    {
        parent::__construct($gateway_info);
        $this->details = new SJB_PayPalExpressDetails($gateway_info);
    }

    /**
     * @return PayPalAPIInterfaceServiceService
     */
    private function getService()
    {
        $config = [
            'mode' => 'live',
            'acct1.UserName' => $this->getPropertyValue('ppe_user'),
            'acct1.Password' => $this->getPropertyValue('ppe_password'),
            'acct1.Signature' => $this->getPropertyValue('ppe_signature'),
        ];
        if ($this->getPropertyValue('ppe_sandbox')) {
            $config['mode'] = 'sandbox';
        }
        return new PayPalAPIInterfaceServiceService($config);
    }

    function isValid()
    {
        $properties = $this->details->getProperties();
        $errors = [];

        $value = $properties['ppe_user']->getValue();
        if (empty($value)) {
            $errors['API_USERNAME_EMPTY'] = true;
        }
        $value = $properties['ppe_password']->getValue();
        if (empty($value)) {
            $errors['API_PASSWORD_EMPTY'] = true;
        }
        $value = $properties['ppe_signature']->getValue();
        if (empty($value)) {
            $errors['API_SIGNATURE_EMPTY'] = true;
        }

        if (empty($errors)) {

            // check if user has reference transactions
            $paymentDetails = new PaymentDetailsType();

            $itemDetails = new PaymentDetailsItemType();
            $itemDetails->Name = 'test';
            $itemDetails->Amount = new BasicAmountType(SJB_CurrencyManager::getCurrencyCode(), 1);
            $itemDetails->Quantity = 1;

            $paymentDetails->PaymentDetailsItem[0] = $itemDetails;

            $paymentDetails->OrderTotal = new BasicAmountType(SJB_CurrencyManager::getCurrencyCode(), 1);

            $setECReqDetails = new SetExpressCheckoutRequestDetailsType();
            $setECReqDetails->PaymentDetails[0] = $paymentDetails;
            $setECReqDetails->CancelURL = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/0/{$this->getPropertyValue('id')}/";
            $setECReqDetails->ReturnURL = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/0/{$this->getPropertyValue('id')}/";

            // Billing agreement details
            $billingAgreementDetails = new BillingAgreementDetailsType('MerchantInitiatedBilling');
            $setECReqDetails->BillingAgreementDetails = [$billingAgreementDetails];

            $setECReqType = new SetExpressCheckoutRequestType();
            $setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
            $setECReq = new SetExpressCheckoutReq();
            $setECReq->SetExpressCheckoutRequest = $setECReqType;

            try {
                $setECResponse = $this->getService()->SetExpressCheckout($setECReq);
                if (preg_match('/Merchant not enabled for reference transactions/iu', $setECResponse->toXMLString())) {
                    SJB_FlashMessages::getInstance()->addError('Please enable <a target="_blank" href="https://www.paypal-knowledge.com/infocenter/index?page=content&id=FAQ1503">Reference Transactions</a> for your PayPal account to accept recurring payments.');
                }
            } catch (Exception $ex) {
            }

            return true;
        }

        $this->errors = array_merge($this->errors, $errors);
        return false;
    }

    /**
     * @param $invoice SJB_Invoice
     * @return null
     */
    function buildTransactionForm($invoice)
    {
        if (count($invoice->isValid()) == 0) {
            return [
                'url' => SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/",
                'caption' => $this->getPropertyValue('caption'),
                'id' => $this->getPropertyValue('id'),
            ];
        }
        return null;
    }

    protected function getUrl()
    {
        if ($this->getPropertyValue('ppe_sandbox')) {
            return 'https://www.sandbox.paypal.com/webscr';
        }
        return 'https://www.paypal.com/webscr';
    }

    function getPaymentFromCallbackData($callback_data, $invoice_sid)
    {
        $service = $this->getService();
        $invoice = SJB_InvoiceManager::getObjectBySID($invoice_sid);

        if (empty($invoice)) {
            $this->errors['NONEXISTED_INVOICE_ID_SPECIFIED'] = 1;
            return null;
        }

        if ($invoice->getStatus() != SJB_Invoice::INVOICE_STATUS_UNPAID) {
            return $invoice;
        }

        $isRecurring = false;
        $billingCycle = '';
        $recurringProduct = $invoice->getRecurringProduct();
        if ($recurringProduct) {
            $billingCycle = $recurringProduct['billing_cycle'];
            $isRecurring = true;
        }

        if (!isset($callback_data['token'], $callback_data['PayerID'])) {
            $paymentDetails = new PaymentDetailsType();

            $itemDetails = new PaymentDetailsItemType();
            $itemDetails->Name = $invoice->getProductNames();
            $itemDetails->Amount = new BasicAmountType(SJB_CurrencyManager::getCurrencyCode(), $invoice->getPropertyValue('total'));
            $itemDetails->Quantity = 1;

            $paymentDetails->PaymentDetailsItem[0] = $itemDetails;

            $paymentDetails->ItemTotal = new BasicAmountType(SJB_CurrencyManager::getCurrencyCode(), $invoice->getPropertyValue('total'));
            $paymentDetails->TaxTotal = new BasicAmountType(SJB_CurrencyManager::getCurrencyCode(), 0);
            $paymentDetails->OrderTotal = new BasicAmountType(SJB_CurrencyManager::getCurrencyCode(), $invoice->getPropertyValue('total'));

            $setECReqDetails = new SetExpressCheckoutRequestDetailsType();
            $paymentDetails->NotifyURL = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/";
            $setECReqDetails->PaymentDetails[0] = $paymentDetails;
            $setECReqDetails->CancelURL = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/";
            $setECReqDetails->ReturnURL = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/";
            $setECReqDetails->ReqConfirmShipping = 0;
            $setECReqDetails->NoShipping = 1;

            if ($isRecurring) {
                // Billing agreement details
                $billingAgreementDetails = new BillingAgreementDetailsType('MerchantInitiatedBilling');
                $billingAgreementDetails->BillingAgreementDescription = SJB_I18N::getInstance()->gettext('Frontend', 'per ' . $billingCycle);
                $setECReqDetails->BillingAgreementDetails = [$billingAgreementDetails];
            }
            $setECReqDetails->AllowNote = 0;

            $setECReqType = new SetExpressCheckoutRequestType();
            $setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
            $setECReq = new SetExpressCheckoutReq();
            $setECReq->SetExpressCheckoutRequest = $setECReqType;

            try {
                $setECResponse = $service->SetExpressCheckout($setECReq);
                if (!empty($setECResponse->Ack) && $setECResponse->Ack == 'Success') {
                    SJB_H::redirect($this->getUrl() . '?cmd=_express-checkout&token=' . $setECResponse->Token);
                } else {
                    SJB_Error::getInstance()->addWarning('Failed to set express checkout', ['response' => $setECResponse]);
                }
            } catch(Exception $ex) {
                $this->errors[] = $ex->getMessage();
            }
        } else {
            $token = urlencode($callback_data['token']);
            $payerId = urlencode($callback_data['PayerID']);
            $orderTotal = new BasicAmountType();
            $orderTotal->currencyID = SJB_CurrencyManager::getCurrencyCode();
            $orderTotal->value = $invoice->getPropertyValue('total');
            $paymentDetails = new PaymentDetailsType();
            $paymentDetails->OrderTotal = $orderTotal;
            // Your URL for receiving Instant Payment Notification (IPN) about this transaction. If you do not specify this value in the request, the notification URL from your Merchant Profile is used, if one exists.
//            $paymentDetails->NotifyURL = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/";
            $DoECRequestDetails = new DoExpressCheckoutPaymentRequestDetailsType();
            $DoECRequestDetails->PayerID = $payerId;
            $DoECRequestDetails->Token = $token;
            $DoECRequestDetails->PaymentAction = 'Sale';
            $DoECRequestDetails->PaymentDetails[0] = $paymentDetails;
            $DoECRequest = new DoExpressCheckoutPaymentRequestType();
            $DoECRequest->DoExpressCheckoutPaymentRequestDetails = $DoECRequestDetails;
            $DoECReq = new DoExpressCheckoutPaymentReq();
            $DoECReq->DoExpressCheckoutPaymentRequest = $DoECRequest;
            try {
                /* wrap API method calls on the service object with a try catch */
                $DoECResponse = $service->DoExpressCheckoutPayment($DoECReq);
                if ($DoECResponse->Ack == 'Success' && current($DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo)->PaymentStatus == 'Completed') {
                    if ($isRecurring) {
                        $invoice->setPropertyValue('recurring_id', $DoECResponse->DoExpressCheckoutPaymentResponseDetails->BillingAgreementID);
                        \SJB\Analytics\Logger::log('JB Received Recurring Payment', ['JB Recurring Amount' => $invoice->getPropertyValue('total')]);
                    }
                    $transactionId = current($DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo)->TransactionID;
                    $invoice->setStatus(SJB_Invoice::INVOICE_STATUS_VERIFIED);
                    $invoice->setPropertyValue('payment_method', $this->getPropertyValue('id'));
                    $transactionInfo = [
                        'transaction_id' => $transactionId,
                        'invoice_sid' => $invoice->getSID(),
                        'amount' => SJB_I18N::getInstance()->getFloat($invoice->getPropertyValue('total')),
                        'payment_method' => $invoice->getPropertyValue('payment_method'),
                        'user_sid' => $invoice->getPropertyValue('user_sid')
                    ];
                    $transaction = new SJB_Transaction($transactionInfo);
                    SJB_TransactionManager::saveTransaction($transaction);
                }
                $invoice->setCallbackData($DoECResponse);

            } catch (Exception $ex) {
                $this->errors[] = $ex->getMessage();
            }
        }

        return $invoice;
    }

    /**
     * @param SJB_Invoice $invoice
     * @return bool
     */
    public function charge($invoice)
    {
        $recurringId = $invoice->getPropertyValue('recurring_id');
        if (!$recurringId) {
            return false;
        }
        try {
            $paymentDetails = new PaymentDetailsType();
            $paymentDetails->OrderTotal = new BasicAmountType(SJB_CurrencyManager::getCurrencyCode(), $invoice->getPropertyValue('total'));
//            $paymentDetails->NotifyURL = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/";
            $RTRequestDetails = new DoReferenceTransactionRequestDetailsType();
            $RTRequestDetails->PaymentDetails = $paymentDetails;
            $RTRequestDetails->ReferenceID = $invoice->getPropertyValue('recurring_id');
            $RTRequestDetails->PaymentAction = 'Sale';
            $RTRequestDetails->PaymentType = 'InstantOnly';
            $RTRequest = new DoReferenceTransactionRequestType();
            $RTRequest->DoReferenceTransactionRequestDetails = $RTRequestDetails;
            $RTReq = new DoReferenceTransactionReq();
            $RTReq->DoReferenceTransactionRequest = $RTRequest;

            $RTResponse = $this->getService()->DoReferenceTransaction($RTReq);
            $invoice->setCallbackData($RTResponse);
            if ($RTResponse->Ack == 'Success' && $RTResponse->DoReferenceTransactionResponseDetails->PaymentInfo->PaymentStatus == 'Completed') {
                $transactionInfo = [
                    'transaction_id' => $RTResponse->DoReferenceTransactionResponseDetails->PaymentInfo->TransactionID,
                    'invoice_sid' => $invoice->getSID(),
                    'amount' => SJB_I18N::getInstance()->getFloat($invoice->getPropertyValue('total')),
                    'payment_method' => $invoice->getPropertyValue('payment_method'),
                    'user_sid' => $invoice->getPropertyValue('user_sid')
                ];
                $transaction = new SJB_Transaction($transactionInfo);
                SJB_TransactionManager::saveTransaction($transaction);
                \SJB\Analytics\Logger::log('JB Received Payment', ['JB Billing Amount' => $invoice->getPropertyValue('total')]);
                \SJB\Analytics\Logger::log('JB Received Recurring Payment', ['JB Recurring Amount' => $invoice->getPropertyValue('total')]);
                return true;
            }
        } catch (Exception $ex) {
            SJB_Error::getInstance()->addWarning($ex->getMessage(), ['exception' => $ex]);
        }
        return false;
    }

    public function isRecurring()
    {
        return true;
    }

    public function cancelRecurring($recurringId)
    {
        $BAUpdateRequest = new BAUpdateRequestType($recurringId);
        $BAUpdateRequest->BillingAgreementStatus = 'Canceled';
        $billingAgreementUpdateReq = new BillAgreementUpdateReq();
        $billingAgreementUpdateReq->BAUpdateRequest = $BAUpdateRequest;

        try {
            $response = $this->getService()->BillAgreementUpdate($billingAgreementUpdateReq);
            if ($response->Ack == 'Success') {
                return true;
            }
            $this->errors[] = 'Unable to cancel recurring';
        } catch (Exception $ex) {
            $this->errors[] = $ex->getMessage();
        }
        return false;
    }
}
