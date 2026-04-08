<?php


class SJB_SMTDetails extends SJB_PaymentGatewayDetails
{
	public static function getDetails()
	{
		$common_details = parent::getDetails();

		$specific_details = array
		(
			array
			(
				'id'		=> 'smt_api_user_login',
				'caption'	=> 'SMT API User name',
				'type'		=> 'string',
				'length'	=> '20',
				'is_required'=> true,
				'is_system' => false,
			),
			array
			(
				'id'		=> 'smt_api_user_password',
				'caption'	=> 'SMT API User password',
				'type'		=> 'string',
				'length'	=> '20',
				'is_required'=> true,
				'is_system' => false,
			),
			
			array
			(
				'id'		=> 'use_sandbox',
				'caption'	=> 'SMT production mode',
				'type'		=> 'boolean',
				'length'	=> '20',
				'is_required'=> false,
				'is_system' => false,
				'comment' => '<span class="tooltip-checkbox" data-toggle="tooltip" data-placement="auto left" title="check to enable SMT production modes"><i class="fa fa-question-circle" aria-hidden="true"></i></span>',
			),
	
		);

		return array_merge($common_details, $specific_details);
	}
}

