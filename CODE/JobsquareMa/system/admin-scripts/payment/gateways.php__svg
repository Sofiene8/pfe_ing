<?php

class SJB_Admin_Payment_Gateways extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_ECOMMERCE);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();

        $action = SJB_Request::getVar('action', null);
        $gateway_id = SJB_Request::getVar('gateway', null);

        if (!empty($action) && !empty($gateway_id)) {
            switch ($action) {
                case 'deactivate':
                    SJB_PaymentGatewayManager::deactivateByID($gateway_id);
                    break;
                case 'activate':
                    SJB_PaymentGatewayManager::activateByID($gateway_id);
                    break;
            }
        }

        $gateways = SJB_PaymentGatewayManager::getPaymentGatewaysList();
        $tp->assign('gatewaySaved', SJB_Request::getVar('gatewaySaved', false));
        $tp->assign('gateways', $gateways);
        $tp->display('payment_gateways_list.tpl');
    }
}
