<?php

class SJB_Admin_Payment_ConfigureGateway extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_ECOMMERCE);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();

        $errors = [];

        $action = SJB_Request::getVar('action');
        $gateway_id = SJB_Request::getVar('gateway');
        $formSubmitted = SJB_Request::getVar('submit');

        $gateway_sid = SJB_PaymentGatewayManager::getSIDByID($gateway_id);

        if (empty($gateway_sid)) {
            SJB_FlashMessages::getInstance()->addError('Payment method not found');
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($action)) {
            switch ($action) {
                case 'deactivate':
                    SJB_PaymentGatewayManager::deactivateByID($gateway_id);
                    break;
                case 'activate':
                    SJB_PaymentGatewayManager::activateByID($gateway_id);
                    break;
            }
        }

        if (SJB_Request::getMethod() == SJB_Request::METHOD_POST) {
            $gateway = SJB_PaymentGatewayManager::createObjectByID($gateway_id, $_REQUEST);
            $gateway->dontSaveProperty('id');
            $gateway->dontSaveProperty('name');
            $gateway->setSID($gateway_sid);

            if ($gateway->isValid()) {
                $prevGatewayInfo = $gatewayInfo = SJB_PaymentGatewayManager::getInfoBySID($gateway->getID());
                if (SJB_PaymentGatewayManager::saveGateway($gateway) !== false) {
                    $gatewayInfo = SJB_PaymentGatewayManager::getInfoBySID($gateway->getID());
                    if ($gateway->getPropertyValue('active') && empty($prevGatewayInfo['active'])) {
                        \SJB\Analytics\Logger::log('Set up Payment Gateway', ['Payment Gateway' => $gatewayInfo['name']]);
                    }
                    $tp->assign('gatewaySaved', true);
                    if ($formSubmitted == 'save_gateway') {
                        $siteUrl = SJB_System::getSystemSettings('SITE_URL') . '/system/payment/gateways/?gatewaySaved=1';
                        SJB_HelperFunctions::redirect($siteUrl);
                    }
                } else {
                    $errors['SETTINGS_SAVED_WITH_PROBLEMS'] = 1;
                }
            } else {
                $errors = $gateway->getErrors();
            }
        }

        $gateway = SJB_PaymentGatewayManager::getObjectByID($gateway_id);
        $gateway->deleteProperty('name');
        $gateway_form = new SJB_Form($gateway);
        $gateway_form->registerTags($tp);
        $gateway_form->makeDisabled('id');

        $gateway_info = SJB_PaymentGatewayManager::getInfoBySID($gateway_sid);
        $form_fields = $gateway_form->getFormFieldsInfo();

        $tp->assign('gateway', $gateway_info);
        $tp->assign('form_fields', $form_fields);
        $tp->assign('errors', $errors);
        $tp->display('configure_gateway.tpl');
    }
}
