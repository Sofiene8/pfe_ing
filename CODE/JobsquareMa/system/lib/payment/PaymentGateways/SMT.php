<?php

class SJB_SMT extends SJB_PaymentGateway
{
	private $httpParsedResponseAr;
	public $errors = array();
	public $amountField = 'amount';

    const _SPS_ISO_CODE_TND_CURRENCY = 'TND';
    const _SPS_ISO_CODE_NUM_TND_CURRENCY = 788;
    const _SPS_MT_URL_TEST = "https://test.clictopay.com/payment/rest/register.do";
    const _SPS_MT_URL_PROD = "https://ipay.clictopay.com/payment/rest/register.do";
    const _SPS_MT_URL_ORDER_STATUS_TEST = "https://test.clictopay.com/payment/rest/getOrderStatusExtended.do";
    const _SPS_MT_URL_ORDER_STATUS_PROD = "https://ipay.clictopay.com/payment/rest/getOrderStatusExtended.do";
   // const _SPS_NOTIFICATION_PATH = "/modules/spstunisie/validation.php";

	public function __construct($gateway_info)
	{
		parent::__construct($gateway_info);
		$this->details = new SJB_SMTDetails($gateway_info);
	}

	public function isValid()
	{
		$this->validate();
		return empty($this->errors);
	}

	public function buildTransactionForm($invoice)
	{
	
		if (count($invoice->isValid()) == 0) {
			return [
				'url' => $this->getSMTFormUrl($invoice),
				'caption' => $this->getPropertyValue('caption'),
                'id' => $this->getPropertyValue('id'),
            ];
		}

		return null;
	}

	public function makePayment($data)
	{
		$this->sendPaymentToSMT();
		$this->setPaymentStatus();
		$this->continuePaymentProcess();
	}

	public function getPaymentFromCallbackData($callback_data, $invoice_sid)
	{
	
		$invoice_sid = isset($callback_data['item_number']) ? $callback_data['item_number'] : null;
		
		if (is_null($invoice_sid)) {
			$this->errors['INVOICE_ID_IS_NOT_SET'] = 1;
			return null;
		}
		$invoice = SJB_InvoiceManager::getObjectBySID($invoice_sid);
		
		if (is_null($invoice)) {
			$this->errors['NONEXISTED_INVOICE_ID_SPECIFIED'] = 1;
			return null;
		}
		
		$invoice->setCallbackData($callback_data);
		/*if (!$this->checkPaymentAmount($invoice)) {
			return null;
		}*/
		$status=$this->isPaymentVerified($invoice);
		
		if ($status=='PAID' ) {
			$invoice->setStatus(SJB_Invoice::INVOICE_STATUS_VERIFIED);
		}
		 else {
			$invoice->setStatus(SJB_Invoice::INVOICE_STATUS_UNPAID);
		}
		
		$gatewayId = $this->details->getProperty('id');
			$totalPrice=$invoice->getPropertyValue('total')+1.000;
		$invoice->setPropertyValue('payment_method', $gatewayId->getValue());
		if (isset($callback_data['orderId'])) {
		
			$transactionId = $callback_data['orderId'];
			$transactionInfo = array(
				'transaction_id' => $transactionId,
				'invoice_sid' => $invoice->getSID(),
				'amount' => SJB_I18N::getInstance()->getFloat($totalPrice),
				'payment_method' => $invoice->getPropertyValue('payment_method'),
				'user_sid' => $invoice->getPropertyValue('user_sid')
			);
			$transaction = new SJB_Transaction($transactionInfo);
			
			SJB_TransactionManager::saveTransaction($transaction);
		}
	
		return $invoice;
	}

	private function getGatewayUrl()
	{
		$sub_domain = $this->getPropertyValue('use_sandbox') ?self::_SPS_MT_URL_PROD : self::_SPS_MT_URL_TEST;
		return $sub_domain;
	}

	private function validate()
	{
		$properties = $this->details->getProperties();
		$user_name = $properties['smt_api_user_login']->getValue();
		$user_password = $properties['smt_api_user_password']->getValue();
		//$user_signature = $properties['user_signature']->getValue();
		if (empty($user_name)) {
			$this->errors['API_LOGIN_ID_IS_NOT_SET'] = 1;
		}
		if (empty($user_password)) {
			$this->errors['API_PASSWORD_EMPTY'] = 1;
		}
	/*	if (empty($user_signature)) {
			$this->errors['USER_SIGNATURE_IS_NOT_SET'] = 1;
		}*/
	}

	private function continuePaymentProcess()
	{
		$this->prepareRequest();
		$this->prepareUri();
		$function = new SJB_Payment_Callback(SJB_Acl::getInstance(), array(), null);
		$function->execute();
	}

	private function sendPaymentToSMT()
	{
		$invoiceSid = SJB_Request::getInt('item_number', null);
		if (is_null($invoiceSid)) {
			$this->errors['INVOICE_ID_IS_NOT_SET'] = 1;
			return null;
		}
			$invoice = SJB_InvoiceManager::getObjectBySID($invoiceSid);
		//$customerDataString = $this->makeRequestForDirectPayment($data);
		$this->httpParsedResponseAr = $this->smtHttpPost($invoice);
		
	}

	private function setPaymentStatus()
	{
		$invoiceSid = SJB_Request::getInt('item_number', null);
		if (is_null($invoiceSid)) {
			$this->errors['INVOICE_ID_IS_NOT_SET'] = 1;
			return null;
		}
		$invoice = SJB_InvoiceManager::getObjectBySID($invoiceSid);
		$status = false;
		if (is_null($invoice)) {
			$this->errors['NONEXISTED_INVOICE_ID_SPECIFIED'] = 1;
			return null;
		}

		$invoice->setCallbackData($this->httpParsedResponseAr);
		if (in_array(strtoupper($this->httpParsedResponseAr['ACK']), array('SUCCESS', 'SUCCESSWITHWARNING'))) {
			$invoice->setStatus(SJB_Invoice::INVOICE_STATUS_VERIFIED);
		} else {
			$invoice->setStatus(SJB_Invoice::INVOICE_STATUS_UNPAID);
		}
		SJB_InvoiceManager::saveInvoice($invoice);
	}

	
	private function prepareUri()
	{
		$_SERVER['REQUEST_URI'] = SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/" . $_REQUEST['item_number'] . '/paypal_pro/';
	}

	private function getSMTFormUrl($invoice)
	{
	      //    'returnUrl' =>SJB_System::getSystemSettings('SITE_URL'). "/smt_payment_validation/?invoice_sid={$invoice->getSID()}&gateway={$this->getPropertyValue('id')}&Action=SUCCESS",
            //'failUrl' => SJB_System::getSystemSettings('SITE_URL'). "/smt_payment_validation/?invoice_sid={$invoice->getSID()}&gateway={$this->getPropertyValue('id')}&Action=FAIL"
	
	
        $smtEndpoint =$this->getGatewayUrl();
		
       // $domain = Configuration::get('PS_SSL_ENABLED') ? Tools::getShopDomainSsl(true) : Tools::getShopDomain(true);
	$totalPrice=$invoice->getPropertyValue('total')+1.000;
        $query = array(
            'amount' =>str_replace(".", "", sprintf("%01.3f",$totalPrice)),
            'currency' => self::_SPS_ISO_CODE_NUM_TND_CURRENCY,
            'orderNumber' => $invoice->getSID(),
			'clientId  '=>$invoice->getPropertyValue('user_sid'),
            'userName' => urlencode($this->getPropertyValue('smt_api_user_login')),
            'password' => urlencode($this->getPropertyValue('smt_api_user_password')),
            'returnUrl' =>SJB_System::getSystemSettings('SITE_URL'). "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}?item_number={$invoice->getSID()}",
            'failUrl' => SJB_System::getSystemSettings('SITE_URL'). "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}?item_number={$invoice->getSID()}"
        );

        $params = '';
        foreach ($query as $key => $value) {
            $params .= $key.'='.$value.'&';
        }
        $params = trim($params, '&');
		//$url=$smtEndpoint.'?'.$params;
		
		$response=json_decode($this->doPostRequest($smtEndpoint,$params));
		
		if (isset($response->orderId)) {
           // $this->context->cart->updateOrderId($payload->orderId);
			return  $response->formUrl;
        } else {
            	$this->errors['UNABLE_TO_PROCESS_PAYMENT_URL'] = 1;
				return null;
        }
		
	}

	private function smtHttpPost($invoice)
	{
		$gatewayProperties = $this->getGatewayProperties($invoice);
		$query_data = "METHOD={$methodName_}&" . http_build_query($gatewayProperties) . $customer_data_string;
		try {
			$httpResponse = $this->doPostRequest($gatewayProperties['API_Endpoint'], $query_data);
			$httpParsedResponseAr = $this->parseHttpResponse($httpResponse);
		} catch (HttpException $e) {
			exit("{$gatewayProperties['API_Endpoint']} $methodName_ failed: " . $e->getMessage());
		}
		return $httpParsedResponseAr;
	}

	private function getGatewayProperties($invoice)
	{
		return array(
            'amount' =>str_replace(".", "", sprintf("%01.3f", SJB_I18N::getInstance()->getFloat($invoice->getPropertyValue('total')))),
            'currency' => self::_SPS_ISO_CODE_NUM_TND_CURRENCY,
            'orderNumber' => $invoice->getSID(),
			'clientId  '=>$invoice->getPropertyValue('user_sid'),
            'userName' => urlencode($this->getPropertyValue('smt_api_user_login')),
            'password' => urlencode($this->getPropertyValue('smt_api_user_password')),
            'returnUrl' =>SJB_System::getSystemSettings('SITE_URL'). "/smt_payment_validation/?invoice_sid={$invoice->getSID()}&gateway={$this->getPropertyValue('id')}&Action=SUCCESS",
            'failUrl' => SJB_System::getSystemSettings('SITE_URL'). "/smt_payment_validation/?invoice_sid={$invoice->getSID()}&gateway={$this->getPropertyValue('id')}&Action=FAIL"
        );

	}

	private function doPostRequest($url, $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$httpResponse = curl_exec($ch);
		if (!$httpResponse) {
			echo ("CURL error " . curl_error($ch) . '(' . curl_errno($ch) . ')');
		}
		return $httpResponse;
	}

	private function parseHttpResponse($httpResponse)
	{
		$httpResponseAr = explode("&", $httpResponse);
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $value) {
			$tmpAr = explode("=", $value);
			if (sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
		if (!array_key_exists('ACK', $httpParsedResponseAr)) {
			echo ("ACK not found in Response data.");
		}
		return $httpParsedResponseAr;
	}

	

	public function parseIpnStatus($callback_data)
	{
		// https://www.x.com/developers/paypal/documentation-tools/ipn/integration-guide/IPNandPDTVariables
		// payment_status values:
		//   Pending
		//   Completed
		//   Denied
		$payment_status = isset($callback_data['payment_status']) ? strtolower($callback_data['payment_status']) : '';
		switch ($payment_status) {
			case 'pending':
				return 'Pending';
			case 'completed':
				return 'Successful';
			case 'denied':
				return 'Error';
		}
		return 'Notification';
	}

	public function parseNvpApiStatus($callback_data)
	{
		// https://www.x.com/developers/paypal/documentation-tools/api/NVPAPIOverview
		// Acknowledgement status, which is one of the following values:
		//   Success
		//   SuccessWithWarning
		//   Failure
		//   FailureWithWarning
		$ack = isset($callback_data['http_post_response']) && isset($callback_data['http_post_response']['ACK']) ?
			strtolower($callback_data['http_post_response']['ACK']) :
			'';
		switch ($ack) {
			case 'success':
			case 'successwithwarning':
				return 'Successful';
			case 'failure':
			case 'failurewithwarning':
				return 'Error';
		}
		return 'Notification';
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
function isPaymentVerified($invoice)
    {
		$callback_data = $invoice->getCallbackData();
		$orderId=$callback_data['orderId'];

		if ($orderId) {
 
    // construct confirmation query
    $smtEndpoint = $this->getPropertyValue('use_sandbox') ? self::_SPS_MT_URL_ORDER_STATUS_PROD :self::_SPS_MT_URL_ORDER_STATUS_TEST;
    $query = array(
        'orderId' => $orderId,
		'orderNumber' => $invoice->getSID(),
        'userName' => urlencode($this->getPropertyValue('smt_api_user_login')),
        'password' => urlencode($this->getPropertyValue('smt_api_user_password')),
    );
     
    $params = '';
    foreach ($query as $key => $value) {
        $params .= $key.'='.$value.'&';
    }
    $params = trim($params, '&');
	//$url=$smtEndpoint.'?'.$params;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $smtEndpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		$httpResponse = curl_exec($ch);
		if (!$httpResponse) {
			echo ("CURL error " . curl_error($ch) . '(' . curl_errno($ch) . ')');
		}
		 $payload = json_decode($httpResponse);
		//var_dump( $payload->cardAuthInfo->approvalCode);exit;
		if ($payload && $payload->orderStatus == 2) {
		$response = "PAID";
		}
	  else 
	  $response = "UNPAID";
	
		
		
	
}
return $response;
}
}
