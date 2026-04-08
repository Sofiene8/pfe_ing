<?php

class SJB_Payment_CancelRecurring extends SJB_Function
{
    public function execute()
    {
        $contract = SJB_Request::getVar('contract');
        if (!in_array($contract, SJB_UserManager::getCurrentUser()->getContractID())) {
            echo SJB_System::executeFunction('miscellaneous', 'function_is_not_accessible');
            return;
        }
        $contract = new SJB_Contract(['contract_id' => $contract]);
        $invoice = SJB_InvoiceManager::getObjectBySID($contract->getInvoiceId());
        if ($invoice && $invoice->getPropertyValue('recurring_id')) {
            $gateway = $invoice->getPropertyValue('payment_method');
            $gateway = SJB_PaymentGatewayManager::getObjectByID($gateway);
            if ($gateway->cancelRecurring($invoice->getPropertyValue('recurring_id'))) {
                $contract->setStatus('canceled');
                $contract->saveInDB();
            } elseif ($gateway->getErrors()) {
                SJB_FlashMessages::getInstance()->addError(implode(', ', $gateway->getErrors()));
            }
        }

        $userInfo = SJB_Authorization::getCurrentUserInfo();
        $userGroupInfo = SJB_UserGroupManager::getUserGroupInfoBySID($userInfo['user_group_sid']);
        if ($userGroupInfo['id'] == 'JobSeeker') {
            SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/my-listings/resume/');
        } else {
            SJB_HelperFunctions::redirect(SJB_HelperFunctions::getSiteUrl() . '/my-listings/job/');
        }
    }
}
