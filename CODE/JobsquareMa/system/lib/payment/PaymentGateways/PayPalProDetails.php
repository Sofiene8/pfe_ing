<?php


class SJB_PayPalProDetails extends SJB_PaymentGatewayDetails
{
	public static function getDetails()
	{
		$common_details = parent::getDetails();

		$specific_details = array
		(
			array
			(
				'id'		=> 'user_name',
				'caption'	=> 'PayPal Pro User name',
				'type'		=> 'string',
				'length'	=> '20',
				'is_required'=> true,
				'is_system' => false,
			),
			array
			(
				'id'		=> 'user_password',
				'caption'	=> 'PayPal Pro User password',
				'type'		=> 'string',
				'length'	=> '20',
				'is_required'=> true,
				'is_system' => false,
			),
			array
			(
				'id'		=> 'user_signature',
				'caption'	=> 'PayPal Pro User signature',
				'type'		=> 'string',
				'length'	=> '50',
				'is_required'=> true,
				'is_system' => false,
			),
			array
			(
				'id'		=> 'use_sandbox',
				'caption'	=> 'PayPal Pro Sandbox',
				'type'		=> 'boolean',
				'length'	=> '20',
				'is_required'=> false,
				'is_system' => false,
				'comment' => '<span class="tooltip-checkbox" data-toggle="tooltip" data-placement="auto left" title="check to enable PayPal Sandbox"><i class="fa fa-question-circle" aria-hidden="true"></i></span>',
			),
			array
			(
				'id'		  => 'country',
				'caption'	  => 'Country',
				'type'		  => 'list',
				'list_values' => array(
					array(
						'id' => 'US',
						'caption' => 'United States'
					),
					array(
						'id' => 'CA',
						'caption' => 'Canada'
					),
					array(
						'id' => 'UK',
						'caption' => 'United Kingdom'
					),
				),
				'is_required' => true,
				'is_system'   => false,
				'comment' => '<span data-toggle="tooltip" data-placement="auto left" title="The country your PayPal Pro account is registered in"><i class="fa fa-question-circle" aria-hidden="true"></i></span>',
			),
		);

		return array_merge($common_details, $specific_details);
	}
}

