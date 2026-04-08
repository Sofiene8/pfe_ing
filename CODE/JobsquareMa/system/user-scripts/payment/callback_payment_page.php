<?php

class SJB_Payment_Callback extends SJB_Function
{
    public function execute()
    {

        $request_uri = $_SERVER['REQUEST_URI'];
        $tp = SJB_System::getTemplateProcessor();
        $errors = [];
        preg_match('#.*/system/payment/callback/([^/?]+)#', $request_uri, $mm);
        $listingTypes = [];
		
        if (!empty($mm)) {
            $invoice_sid = $mm[1];

            preg_match('#.*/system/payment/callback/[^/]+/([^/?]+)#', $request_uri, $mm);
            $gateway_id = !empty($mm[1]) ? $mm[1] : '';

            $invoice = SJB_InvoiceManager::getObjectBySID($invoice_sid);

            if ($gateway_id) {
                $gateway = SJB_PaymentGatewayManager::getObjectByID($gateway_id);
                $invoice = $gateway->getPaymentFromCallbackData($_REQUEST, $invoice_sid);
				
                if (empty($invoice)) {
                    $errors = $gateway->getErrors();
                }
                $tp->assign('gateway', $gateway);
            }

            if ($invoice && empty($errors)) {
				
                $invoiceInfo = SJB_InvoiceManager::getInvoiceInfoBySID($invoice->getSID()); // additional check to prevent multiple product creation
                if ($invoiceInfo['status'] != SJB_Invoice::INVOICE_STATUS_PAID) {
				
                    switch ($invoice->getStatus()) {
                        case SJB_Invoice::INVOICE_STATUS_VERIFIED:
                            $invoice->setStatus(SJB_Invoice::INVOICE_STATUS_PAID);
                            SJB_InvoiceManager::saveInvoice($invoice);
                            if ($gateway_id && $gateway_id !== 'invoice') {
                                \SJB\Analytics\Logger::log('JB Received Payment', ['JB Billing Amount' => $invoice->getPropertyValue('total')]);
                            }
							
                            $invoice = SJB_InvoiceManager::getObjectBySID($invoice->getSID()); // recover object after save
                            $userSID = $invoice->getPropertyValue('user_sid');
                            SJB_ShoppingCart::deleteItemsFromCartByUserSID($userSID);
                            $items = $invoice->getPropertyValue('items');
						
                            foreach ($items['products'] as $key => $productSID) {
                                $product_info = $invoice->getItemValue($key);
                                $listingNumber = $product_info['qty'];
                                $contract = new SJB_Contract([
                                    'product_sid' => $productSID,
                                    'numberOfListings' => $listingNumber,
                                    'invoice_id' => $invoice->getSID(),
                                    'gateway_id' => $gateway_id,
                                ]);
                                $contract->setUserSID($userSID);
                                $contract->setPrice($items['amount'][$key]);

                                if ($contract->saveInDB()) {
                                    $listings = [];
                                    if (!empty($items['custom_info'][$key]['proceedToListing'])) {
                                        $listings[] = $items['custom_info'][$key]['proceedToListing'];
                                    }
									if($productSID==38)
									{
                                    SJB_ListingManager::boostListingsAfterPaid($userSID, $productSID, $contract->getID(), $listingNumber, $listings);
									}
									else
									{
									 SJB_ListingManager::activateListingsAfterPaid($userSID, $productSID, $contract->getID(), $listingNumber, $listings);
									}
                                    if ($contract->isFeaturedProfile()) {
                                        SJB_UserManager::makeFeaturedBySID($userSID);
                                    }
									
									 if($productSID==28||$productSID==29||$productSID==30||$productSID==31)
									 {
									 $user = SJB_UserManager::getUserInfoBySID($userSID);
									if($productSID==28)
									{
									$CounterCvAccess=1000;
									}
									else if($productSID==30)
									{
									$CounterCvAccess=5000;
									}
									else if($productSID==29)
									{
									$CounterCvAccess=2000;
									
									}
									else if($productSID==31)
									{
									$CounterCvAccess=1000;
									
									}
										SJB_DB::query("UPDATE `users` SET `CounterCvAccess`= ?s WHERE `sid` = ?s", $CounterCvAccess, $userSID);
										if($user['WebSite']!=''&& $user['PrivateSpace']=='')
										{
										  SJB_DB::query("UPDATE `users` SET `PrivateSpace`= ?s WHERE `sid` = ?s", $user['WebSite'], $userSID);
										}
									}
									if($productSID==31)
									{
									$products=array(17,18,18,23,23);
									 foreach ($products as $key => $productID) {
									  if ($productID) {
											$contract = new SJB_Contract(['product_sid' => $productID]);
											$contract->setUserSID($userSID);
											$contract->saveInDB();
											if ($contract->isFeaturedProfile()) {
												SJB_UserManager::makeFeaturedBySID($userSID);
											}
											
										}
									}
									}
									
									
                                    SJB_Notifications::sendSubscriptionActivationLetter($product_info, $invoice);
                                }
                            }

                            SJB_PromotionsManager::markPromotionAsPaidByInvoiceSID($invoice->getSID());
                            break;

                        case SJB_Invoice::INVOICE_STATUS_PENDING:
                            $tp->assign('message', 'INVOICE_WAITING');
                            break;

                        case SJB_Invoice::INVOICE_STATUS_PAID:
                            break;

                        default:
                            SJB_InvoiceManager::markUnPaidInvoiceBySID($invoice_sid);
                            if ($gateway_id == 'paypal_pro') {
                                $httpPostResponse = SJB_Request::getVar('http_post_response', false);
                                if (!empty($httpPostResponse['L_LONGMESSAGE0'])) {
                                    SJB_Error::getInstance()->warning($httpPostResponse['L_LONGMESSAGE0'], $httpPostResponse);
                                }
                            }
                            $errors['UNABLE_TO_PROCESS_PAYMENT'] = 1;
                            break;
                    }
                }
            }
            if ($invoice) {
                $items = $invoice->getPropertyValue('items');
                $products = $items['products'];
                foreach ($products as $key => $productSID) {
                    $product_info = $invoice->getItemValue($key);
                    $products[$key] = $product_info;
                    if (!empty($product_info['custom_info']['proceedToListing'])) {
                        $tp->assign('posting', true);
                        $tp->assign('listingInfo', SJB_ListingManager::getListingInfoBySID($product_info['custom_info']['proceedToListing']));
                    }
                    if (!empty($product_info['listing_type_sid'])) {
                        $listingTypes[] = [
                            'ID' => SJB_ListingTypeDBManager::getListingTypeIDBySID($product_info['listing_type_sid']),
                            'name' => SJB_ListingTypeManager::getListingTypeNameBySID($product_info['listing_type_sid'])
                        ];
                    }
                }
                $tp->assign('products', $products);
            }
        } else {
            $errors['INVOICE_ID_IS_NOT_SET'] = 1;
        }
        $tp->assign('errors', $errors);
        $tp->assign('listingTypes', $listingTypes);
        $tp->display('callback_payment_page.tpl');
    }
}
