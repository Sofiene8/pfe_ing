<?php

class SJB_SMT_Payment_Validation extends SJB_Function
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
	
	
	$gateway = SJB_PaymentGatewayManager::getObjectByID('smt');
		$act = SJB_Request::getVar('Action');
		$orderId =  SJB_Request::getVar('orderId');
		
		
		if ($orderId) {
    // check if curl is loaded
    if (!function_exists('curl_version')) {
        throw new Exception("curl extension is required for spstunisie module");
    }
    
    // construct confirmation query
    $smtEndpoint = $this->getStatusUrl();
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
    $ch = curl_init($smtEndpoint.'?'.$params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    switch ($act) {
        case "SUCCESS":
            // confirm success paiement
            $data = curl_exec($ch);
            $payload = json_decode($data);
            if ($payload && $payload->OrderStatus == 2) {
                $cart = Cart::getCartBySmtOrderId($orderId);
                $total = (float)($cart->getOrderTotal(true, Cart::BOTH));
                $customer = new Customer((int)$cart->id_customer);
                $sps = Module::getInstanceByName('spstunisie');
                $sps->validateOrder($cart->id, Configuration::get('PS_OS_PAYMENT'), $total, $sps->displayName);
                Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$sps->id.'&id_order='.$sps->currentOrder.'&key='.$customer->secure_key);
            }
            break;
        
        case "FAIL":
            // confirm failure paiement
            $data = curl_exec($ch);
            $payload = json_decode($data);
            if ($payload && ($payload->OrderStatus == 0 || $payload->OrderStatus == 6)) {
                $cart = Cart::getCartBySmtOrderId($orderId);
                $total = (float)($cart->getOrderTotal(true, Cart::BOTH));
                $customer = new Customer((int)$cart->id_customer);
                $sps = Module::getInstanceByName('spstunisie');
                $sps->validateOrder($cart->id, Configuration::get('PS_OS_ERROR'), $total, $sps->displayName);
                // bugs prestashop in case of error it return order confirmation
                //Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$sps->id.'&id_order='.$sps->currentOrder.'&key='.$customer->secure_key);
                Tools::redirect('index.php?controller=history');
            }
            break;
    }
}
		
		
		
		
		
		
		
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
		}
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

	public function getFormFields()
	{
		if (is_null($this->formFields)) {
			$this->formFields = array();
			$this->formFields['address'] = SJB_Request::getVar('address', false);
			$this->formFields['zip'] = SJB_Request::getVar('zip', false);
			$this->formFields['country'] = SJB_Request::getVar('country', false);
			$this->formFields['city'] = SJB_Request::getVar('city', false);
			$this->formFields['state'] = SJB_Request::getVar('state', false);
			$this->formFields['email'] = SJB_Request::getVar('email', false);
			$this->formFields['phone'] = SJB_Request::getVar('phone', false);
			$this->formFields['amount'] = SJB_Request::getVar('amount', false);
			$this->formFields['item_name'] = SJB_Request::getVar('item_name', false);
			$this->formFields['item_number'] = SJB_Request::getVar('item_number', false);
			$this->formFields['card_number'] = SJB_Request::getVar('card_number', false);
			$this->formFields['exp_date_mm'] = SJB_Request::getVar('exp_date_mm', false);
			$this->formFields['exp_date_yy'] = SJB_Request::getVar('exp_date_yy', false);
			$this->formFields['csc_value'] = SJB_Request::getVar('csc_value', false);
			$this->formFields['first_name'] = SJB_Request::getVar('first_name', false);
			$this->formFields['last_name'] = SJB_Request::getVar('last_name', false);
			$this->formFields['currency_code'] = SJB_CurrencyManager::getCurrencyCode();
			$this->formFields['bn'] = 'SmartJobBoard_SP';
		}

		return $this->formFields;
	}

	private function isPayNowButtonPressed()
	{
		return !is_null(SJB_Request::getVar('action'));
	}

	private function displayForm()
	{
		$invoiceInfo['invoiceNumber'] = $this->invoice->getSID();
		$invoiceInfo['description'] = $this->invoice->getProductNames();
		$invoiceInfo['totalPrice'] = $this->invoice->getPropertyValue('total');
		$invoiceInfo['currencyCode'] = SJB_CurrencyManager::getCurrencyCode();
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$data = curl_exec($ch);
		if (!$data) {
			echo ("CURL error " . curl_error($ch) . '(' . curl_errno($ch) . ')');
		}
						$payload = json_decode($data);
						var_dump($payload );exit;
					 /*  if (isset($payload->orderId)) {
							//$this->context->cart->updateOrderId($payload->orderId);
							$tp->assign('action', $payload->formUrl);
							$tp->assign('callToAction', $this->l('Payer'));
						} else {
							checkPaymentErrors['error in generating payement link clickToPay']=true;
						}*/
	
		
		
		
		
		$this->getTemplateProcessor()->assign('invoiceInfo', $invoiceInfo);

		$payPalPro = SJB_PaymentGatewayManager::getObjectByID(self::GATEWAY_ID, false);
		$this->getTemplateProcessor()->display('smt_payment.tpl');
	}

	private function validate()
	{
		$form_fields = $this->getFormFields();
		$errors = array();
		if (empty($form_fields['first_name'])) {
			$errors['USER_NAME_IS_NOT_SET'] = 'Please enter your first name';
		}
		if (empty($form_fields['last_name'])) {
			$errors['USER_LAST_NAME_IS_NOT_SET'] = 'Please enter your last name';
		}
		if (empty($form_fields['card_number'])) {
			$errors['CREDIT_CARD_NUMBER_IS_NOT_SET'] = 'Please enter your credit card number';
		}
		if (empty($form_fields['exp_date_mm'])) {
			$errors['EXP_DATE_MM_IS_NOT_SET'] = 'Expiration month is not set';
		}
		if (empty($form_fields['exp_date_yy'])) {
			$errors['EXP_DATE_YY_IS_NOT_SET'] = 'Expiration year is not set';
		}
		if (empty($form_fields['csc_value'])) {
			$errors['CSC_VALUE_IS_NOT_SET'] = 'Please enter security code';
		}
		if (empty($form_fields['address'])) {
			$errors['ADDRESS_IS_NOT_SET'] = 'Please enter your billing address';
		}
		if (empty($form_fields['zip'])) {
			$errors['ZIP_CODE_IS_NOT_SET'] = 'Please enter your ZIP code';
		}
		if (empty($form_fields['city'])) {
			$errors['CITY_IS_NOT_SET'] = 'Please enter your city';
		}
		if (empty($form_fields['country'])) {
			$errors['COUNTRY_IS_NOT_SET'] = 'Please enter your country';
		}
		if (empty($form_fields['state']) && in_array($this->formFields['country'], array("US", "GB", "AU", "CA"))) {
			$errors['STATE_IS_NOT_SET'] = 'Please enter your state';
		}

		$this->errors = array_merge($this->errors, $errors);
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
		$allFormFields = $this->getFormFields();
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
