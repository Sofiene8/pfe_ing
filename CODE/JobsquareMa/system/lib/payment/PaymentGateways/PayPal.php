<?php

class SJB_PayPal extends SJB_PaymentGateway
{
	public $errors = array();
	public $amountField = 'mc_gross';

    public function __construct($gateway_info = array())
	{
		parent::__construct($gateway_info);
		$this->details = new SJB_PayPalDetails($gateway_info);
	}

    function isValid()
    {
    	$properties = $this->details->getProperties();
		$email 	= $properties['paypal_account_email']->getValue();

		$errors = array();

		if (empty($email))
			$errors['EMAIL_IS_NOT_SET'] = 1;

		if (empty($errors)) {
			return true;
		}

		$this->errors = array_merge($this->errors, $errors);
		return false;
	}

    function getUrl()
    {
    	$properties = $this->details->getProperties();

		if ( $properties['use_sandbox']->getValue() )
			return 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		return 'https://www.paypal.com/cgi-bin/webscr';
	}

    /**
     * @param SJB_Invoice $invoice
     * @return array|null
     */
    function buildTransactionForm($invoice)
    {
	    if (count($invoice->isValid()) == 0) {
			$form_fields = $this->getFormFields($invoice);
			$paypal_url = $this->getUrl();
            $form_hidden_fields = "";

            foreach ($form_fields as $name => $value) {
				$value = htmlentities($value, ENT_QUOTES, "UTF-8");
				$form_hidden_fields .= "<input type='hidden' name='{$name}' value='{$value}' />\r\n";
			}

           	$gateway['hidden_fields'] 	= $form_hidden_fields;
           	$gateway['url'] 			= $paypal_url;
           	$gateway['caption']			= $this->getPropertyValue('caption');
            $gateway['id'] = $this->getPropertyValue('id');

			return $gateway;
		}
		return null;
	}

	/**
	 * @param  $invoice SJB_Invoice
	 * @return array
	 */
    function getFormFields($invoice)
	{
		$form_fields = array();
		$properties  = $this->details->getProperties();
		$id = $properties['id']->getValue();

		// hard-coded fields
		$form_fields['cmd'] 			= '_xclick';
		$form_fields['amount'] 			= $invoice->getPropertyValue('total');
		$form_fields['return'] 			= SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$id}/";
		$form_fields['notify_url']		= SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$id}/";
		$form_fields['cancel_return'] 	= SJB_System::getSystemSettings('SITE_URL') . "/my-account/";
		$form_fields['rm'] 				= 2; // POST method for call back
		$form_fields['bn']				= 'SmartJobBoard_SP';

		// configuration fields
		$form_fields['business'] 		= $properties['paypal_account_email']->getValue();
		$form_fields['currency_code'] 	= SJB_CurrencyManager::getCurrencyCode();

		// payment-related fields
		$form_fields['item_name'] 		= $invoice->getProductNames();
		$form_fields['item_number'] 	= $invoice->getSID();
		return $form_fields;
	}

    function isPaymentVerified($invoice)
    {
		$callback_data = $invoice->getCallbackData();

		$postdata ='';

		foreach ($callback_data as $key => $value) {
			$postdata .= $key . "=" . urlencode($value) . "&";
		}

		$postdata .= "cmd=_notify-validate";

		@set_time_limit(0);

		$paypal_url = $this->getUrl();
		//Define required hesaders for PayPal according to https://www.x.com/node/320404
		$headers = array (
			'Content-Type: application/x-www-form-urlencoded',
			'Host: www.paypal.com',
			'Connection: close'
		);

		$curl = curl_init($paypal_url);
		curl_setopt ($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt ($curl, CURLOPT_HEADER, 0);
		curl_setopt ($curl, CURLOPT_POST, 1);
		curl_setopt ($curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt ($curl, CURLOPT_USERAGENT, 'PayPal-PHP-SDK');

		$response = curl_exec($curl);

		return $response == "VERIFIED";
	}

    function getPaymentFromCallbackData($callback_data, $invoice_sid)
    {
		$invoice_sid = SJB_Array::get($callback_data, 'item_number', $invoice_sid);

		if (empty($invoice_sid)) {
			$this->errors['INVOICE_ID_IS_NOT_SET'] = 1;
			return null;
		}

		$invoice = SJB_InvoiceManager::getObjectBySID($invoice_sid);

		if (is_null($invoice)) {
			$this->errors['NONEXISTED_INVOICE_ID_SPECIFIED'] = 1;
			return null;
		}

		if ( $invoice->getStatus() != SJB_Invoice::INVOICE_STATUS_UNPAID ) {
			return $invoice;
		}

		$invoice->setCallbackData($callback_data);

		if ($this->isPaymentVerified($invoice) && in_array($callback_data['payment_status'], array('Completed', 'Processed'))) {
			$invoice->setStatus(SJB_Invoice::INVOICE_STATUS_VERIFIED);
		}
		else if ($callback_data['payment_status'] == 'Pending') {
			$invoice->setStatus(SJB_Invoice::INVOICE_STATUS_PENDING);
		} else {
			$invoice->setStatus(SJB_Invoice::INVOICE_STATUS_UNPAID);
		}

		if (!$this->checkPaymentAmount($invoice)) {
			return null;
		}
	    $id = $this->details->getProperty('id');
		$invoice->setPropertyValue('payment_method', $id->getValue());

	    if (isset($callback_data['txn_id'])){
		    $transactionId = $callback_data['txn_id'];
		    $transactionInfo = array(
			    'transaction_id'=> $transactionId,
			    'invoice_sid' => $invoice->getSID(),
			    'amount' => SJB_I18N::getInstance()->getFloat($invoice->getPropertyValue('total')),
			    'payment_method'=> $invoice->getPropertyValue('payment_method'),
			    'user_sid' => $invoice->getPropertyValue('user_sid')
		    );
		    $transaction = new SJB_Transaction($transactionInfo);
		    SJB_TransactionManager::saveTransaction($transaction);
	    }
	    return $invoice;
	}

    public function checkPaymentAmount(SJB_Invoice $invoice)
    {
        $total = floatval(SJB_Request::getVar($this->amountField)) - floatval(SJB_Request::getVar('tax'));

        if (floatval($invoice->getPropertyValue('total')) != $total) {
            $this->errors['AMOUNT_IS_NOT_MATCH'] = 1;
            return false;
        }
        return true;
    }

}
