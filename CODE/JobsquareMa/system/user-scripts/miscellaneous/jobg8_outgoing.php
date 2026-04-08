<?php

class SJB_Miscellaneous_Jobg8Outgoing extends SJB_Function
{
	public function execute()
	{
        if (SJB_Settings::getValue('jobg8_wsdl_url') && SJB_Settings::getValue('jobg8_jobboard_id') && SJB_Settings::getValue('jobg8_password')) {
            ini_set('max_execution_time', 600);
            error_log('jobg8_outgoing_error_log.log');
            SJB_System::getTemplateProcessor();
            JobG8IntegrationPlugin::sendJobsToJobG8();
        }
        exit;
	}
}
