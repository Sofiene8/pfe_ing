<?php

class SJB_Payment_SmtPaymentValidation extends SJB_Function
{

	const GATEWAY_ID = 'smt';
	private $errors = array();
	private $templateProcessor;
	private $formFields;
	const _SPS_MT_URL_ORDER_STATUS_TEST = "https://test.clictopay.com/payment/rest/getOrderStatus.do";
    const _SPS_MT_URL_ORDER_STATUS_PROD = "https://ipay.clictopay.com/payment/rest/getOrderStatus.do";
	/**
	 * @var SJB_Invoice
	 */
	private $invoice;

	public function isAccessible()
	{
		return SJB_UserManager::isUserLoggedIn();
	}

	public function execute()
	{
	  $request_uri = $_SERVER['REQUEST_URI'];
        $tp = SJB_System::getTemplateProcessor();
	
		$gateway = SJB_PaymentGatewayManager::getObjectByID(self::GATEWAY_ID);
		$act = SJB_Request::getVar('Action');
		$orderId =  SJB_Request::getVar('orderId');
		
		
		if ($orderId) {
    // check if curl is loaded
    if (!function_exists('curl_version')) {
        throw new Exception("curl extension is required for spstunisie module");
    }
    
    // construct confirmation query
    $smtEndpoint = $gateway->getPropertyValue('use_sandbox') ? self::_SPS_MT_URL_ORDER_STATUS_PROD :self::_SPS_MT_URL_ORDER_STATUS_TEST;
    $query = array(
        'orderId' => $orderId,
        'userName' => urlencode($gateway->getPropertyValue('smt_api_user_login')),
        'password' => urlencode($gateway->getPropertyValue('smt_api_user_password')),
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
    switch ($act) {
        case "SUCCESS":
            // confirm success paiement
         
            $payload = json_decode($httpResponse);
            if ($payload && $payload->OrderStatus == 2) {
			echo "sucess";exit;
             /*   $cart = Cart::getCartBySmtOrderId($orderId);
                $total = (float)($cart->getOrderTotal(true, Cart::BOTH));
                $customer = new Customer((int)$cart->id_customer);
                $sps = Module::getInstanceByName('spstunisie');
                $sps->validateOrder($cart->id, Configuration::get('PS_OS_PAYMENT'), $total, $sps->displayName);
                Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$sps->id.'&id_order='.$sps->currentOrder.'&key='.$customer->secure_key);
            */
			}
            break;
        
        case "FAIL":
            // confirm failure paiement
  
            $payload = json_decode($httpResponse);
            if ($payload && ($payload->OrderStatus == 0 || $payload->OrderStatus == 6)) {
				echo "fail";exit;
                /*$cart = Cart::getCartBySmtOrderId($orderId);
                $total = (float)($cart->getOrderTotal(true, Cart::BOTH));
                $customer = new Customer((int)$cart->id_customer);
                $sps = Module::getInstanceByName('spstunisie');
                $sps->validateOrder($cart->id, Configuration::get('PS_OS_ERROR'), $total, $sps->displayName);
                // bugs prestashop in case of error it return order confirmation
                //Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$sps->id.'&id_order='.$sps->currentOrder.'&key='.$customer->secure_key);
                Tools::redirect('index.php?controller=history');*/
            }
            break;
    }
}
		
		
		
		
		
	/*	
		
		$getInvoiceId = SJB_Request::getInt('payment_id', 0, 'GET');
		$this->invoice = SJB_InvoiceManager::getObjectBySID($getInvoiceId);
		if ($this->invoiceValidation($this->invoice)) {
			if ($this->isPayNowButtonPressed()) {
				$this->validate();
				if ($this->hasErrors()) {
					$this->displayErrors();
				} else {
					$this->makePayment();
				}
			} else {
				$this->displayForm();
			}
		}*/
		
		 $tp->assign('gateway', $gateway);
		  $tp->assign('errors', $errors);
        $tp->display('smt_payment_validation.tpl');
	}
private function getStatusUrl()
	{
		$sub_domain = $this->getPropertyValue('use_sandbox') ? self::_SPS_MT_URL_ORDER_STATUS_PROD :_self::SPS_MT_URL_ORDER_STATUS_TEST;
		return $sub_domain;
	}
	/**
	 * @param $invoice
	 * @return bool
	 */
	private function invoiceValidation($invoice)
	{
		if ($invoice instanceof SJB_Invoice) {
			if (SJB_UserManager::getCurrentUserSID() != $invoice->getUserSID()) {
                echo SJB_System::executeFunction('miscellaneous', '404_not_found');
				return false;
			}
			else if ($invoice->getStatus() == SJB_Invoice::INVOICE_STATUS_PAID) {
                echo SJB_System::executeFunction('miscellaneous', '404_not_found');
				return false;
			}
		} else {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
			return false;
		}
		
		return true;
	}

	
	

	private function hasErrors()
	{
		return !empty($this->errors);
	}

	private function displayErrors()
	{
		$this->getTemplateProcessor()->assign('errors', $this->errors);
		$formFields = $this->getFormFields();
		$this->getTemplateProcessor()->assign('formFields', $formFields);
		$this->displayForm();
	}

	private function makePayment()
	{
		
		$payPalProPayment = SJB_PaymentGatewayManager::getObjectByID(self::GATEWAY_ID, false);
		$payPalProPayment->makePayment($allFormFields);
	}

	private function preparePaymentData()
	{
		$data['amount'] = $this->invoice->GetPropertyValue('total');
		$data['item_name'] = $this->invoice->getProductNames();
		$data['item_number'] = $this->invoice->getID();
		return $data;
	}

	private function getHiddenFieldsPart($data)
	{
		$hidden_fields = 'amount item_name item_number';
		$payment_fields = explode(' ', $hidden_fields);
		$form_hidden_fields = array();
		foreach ($payment_fields as $name) {
			$form_hidden_fields[] = "<input type=\"hidden\" name=\"{$name}\" value=\"{$data[$name]}\" />";
		}
		return join("\r\n", $form_hidden_fields);
	}


	/**
	 * @return SJB_TemplateProcessor
	 */
	private function getTemplateProcessor()
	{
		if (!isset ($this->templateProcessor)) {
			$this->templateProcessor = SJB_System::getTemplateProcessor();
		}
		return $this->templateProcessor;
	}

	/**
	 * <a href="https://cms.paypal.com/us/cgi-bin?cmd=_render-content&content_ID=developer/e_howto_api_ACCountryCodes&bn_r=o">
	 * country list from paypal documentation
	 * </a>
	 * @return array
	 */
	
}
