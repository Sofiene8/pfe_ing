<?php

class SJB_Admin_Miscellaneous_UpdateSaasInfo extends SJB_Function
{
	public function execute()
	{
        $info = SJB_HelperFunctions::whmcsCall('saasinfo', [
            'domain' => SJB_System::getSystemSettings('HTTPHOST'),
        ]);
        SJB_Session::setValue('saas', $info['saas']);
        echo $info['saas']['name'];
	}
}
