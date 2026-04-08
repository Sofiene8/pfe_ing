<?php

class SJB_Stripe extends SJB_PaymentGateway
{
    public $errors = array();

    public function __construct($gateway_info = array())
    {
        SJB_Array::fillKeys($gateway_info, ['stripe_secret_key', 'stripe_pub_key']);
        parent::__construct($gateway_info);
        $this->details = new SJB_StripeDetails($gateway_info);
        \Stripe\Stripe::setApiKey($gateway_info['stripe_secret_key']);
    }

    function isValid()
    {
        $properties = $this->details->getProperties();
        $errors = [];

        $sk = $properties['stripe_secret_key']->getValue();
        if (empty($sk)) {
            $errors['SECRET_KEY_EMPTY'] = true;
        }
        $pk = $properties['stripe_pub_key']->getValue();
        if (empty($pk)) {
            $errors['PUB_KEY_EMPTY'] = true;
        }

        if (empty($errors)) {
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
            $user = SJB_UserManager::getUserInfoBySID($invoice->getUserSID());
            return [
                'hidden_fields' => '<script>document.write(\'<input type="hidden" name="token" value="\' + sessionStorage.getItem("stripeToken") + \'" />\');</script>',
                'proceed_requirements' => sprintf(
                    '
                        <script src="https://checkout.stripe.com/checkout.js"></script>
                        <script>
                            var handler = StripeCheckout.configure({
                                key: "%s",
                                amount: "%s",
                                locale: "auto",
                                name: "%s",
                                description: "%s",
                                email: "%s",
                                currency: "%s",
                                token: function(token) {
                                    sessionStorage.setItem("stripeToken", token.id);
                                    $("#shopping-cart__checkout")
                                        .closest("form")
                                            .submit();
                                }
                            });
                        </script>
                    ',
                    $this->getPropertyValue('stripe_pub_key'),
                    $invoice->getPropertyValue('total') * 100,
                    SJB_H::getClearVariablesToAssign(SJB_Settings::getValue('site_title')),
                    SJB_H::getClearVariablesToAssign($invoice->getProductNames()),
                    SJB_H::getClearVariablesToAssign($user['username']),
                    SJB_CurrencyManager::getCurrencyCode()
                ),
                'proceed_script' => 'handler.open({});',
                'url' => SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$invoice->getSID()}/{$this->getPropertyValue('id')}/",
                'caption' => $this->getPropertyValue('caption'),
                'id' => $this->getPropertyValue('id'),
            ];
        }
        return null;
    }

    function getPaymentFromCallbackData($callback_data, $invoice_sid)
    {
        $token = SJB_Array::get($callback_data, 'token');
        $invoice = SJB_InvoiceManager::getObjectBySID($invoice_sid);

        if (empty($invoice)) {
            $this->errors['NONEXISTED_INVOICE_ID_SPECIFIED'] = 1;
            return null;
        }

        if ($invoice->getStatus() != SJB_Invoice::INVOICE_STATUS_UNPAID) {
            return $invoice;
        }

        try {
            if ($invoice->getRecurringProduct()) {
                // Create a Customer
                $customer = \Stripe\Customer::create([
                    'source' => $token,
                ]);
                $charge = \Stripe\Charge::create([
                    'customer' => $customer->id,
                    'amount' => $invoice->getPropertyValue('total') * 100,
                    'currency' => SJB_CurrencyManager::getCurrencyCode()
                ]);
                $invoice->setPropertyValue('recurring_id', $customer->id);
                \SJB\Analytics\Logger::log('JB Received Recurring Payment', ['JB Recurring Amount' => $invoice->getPropertyValue('total')]);
            } else {
                $charge = \Stripe\Charge::create([
                    'source' => $token,
                    'amount' => $invoice->getPropertyValue('total') * 100,
                    'currency' => SJB_CurrencyManager::getCurrencyCode()
                ]);
            }

            /**
             * @var Stripe\Charge $charge
             */
            $invoice->setCallbackData($charge->__toArray(true));
            $invoice->setStatus(SJB_Invoice::INVOICE_STATUS_VERIFIED);
            $invoice->setPropertyValue('payment_method', $this->getPropertyValue('id'));
            $transactionInfo = [
                'transaction_id' => $charge->balance_transaction,
                'invoice_sid' => $invoice->getSID(),
                'amount' => SJB_I18N::getInstance()->getFloat($invoice->getPropertyValue('total')),
                'payment_method' => $invoice->getPropertyValue('payment_method'),
                'user_sid' => $invoice->getPropertyValue('user_sid')
            ];
            $transaction = new SJB_Transaction($transactionInfo);
            SJB_TransactionManager::saveTransaction($transaction);
        } catch (Exception $ex) {
            $this->errors[] = $ex->getMessage();
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
            $charge = \Stripe\Charge::create([
                'customer' => $recurringId,
                'amount' => $invoice->getPropertyValue('total') * 100,
                'currency' => SJB_CurrencyManager::getCurrencyCode(),
            ]);

            /**
             * @var Stripe\Charge $charge
             */
            $invoice->setCallbackData($charge->__toArray(true));
            $transactionInfo = [
                'transaction_id' => $charge->balance_transaction,
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
        } catch (Exception $ex) {
        }
        return false;
    }

    public function isRecurring()
    {
        return true;
    }

    public function cancelRecurring($contract)
    {
        return true;
    }
}
