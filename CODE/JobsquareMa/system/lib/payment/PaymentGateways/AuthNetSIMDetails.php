<?php


class SJB_AuthNetSIMDetails extends SJB_PaymentGatewayDetails
{
    public static function getDetails()
	{
		$common_details = parent::getDetails();

		$specific_details = array
			   (
				array
				(
					'id'		=> 'authnet_api_login_id',
					'caption'	=> 'API Login ID',
					'type'		=> 'string',
					'length'	=> '20',
					'is_required'=> true,
					'is_system' => false,
				),
				array
				(
					'id'		=> 'authnet_api_transaction_key',
					'caption'	=> 'Transaction Key',
					'type'		=> 'string',
					'length'	=> '20',
					'is_required'=> true,
					'is_system' => false,
				),
				array
				(
					'id'		=> 'authnet_api_md5_hash_value',
					'caption'	=> 'MD5-Hash',
					'type'		=> 'string',
					'length'	=> '20',
					'is_required'=> true,
					'is_system' => false,
				),
				array
				(
					'id'		=> 'authnet_use_test_account',
					'caption'	=> 'Authorize.Net test account',
					'type'		=> 'boolean',
					'length'	=> '20',
					'is_required'=> false,
					'is_system' => false,
					'comment' => '<span class="tooltip-checkbox" data-toggle="tooltip" data-placement="auto left" title="check to enable test account"><i class="fa fa-question-circle" aria-hidden="true"></i></span>',
				),
			   );

		return array_merge($common_details, $specific_details);
	}
}

