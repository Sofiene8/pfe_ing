<?php

class SJB_PayPalExpressDetails extends SJB_PaymentGatewayDetails
{
    public static function getDetails()
	{
        $commonDetails = parent::getDetails();

		$details = [
			[
				'id' => 'ppe_user',
				'caption' => 'API Username ',
				'type' => 'string',
				'length' => '255',
				'is_required' => true,
				'is_system' => false,
			],
			[
				'id' => 'ppe_password',
				'caption' => 'API Password',
				'type' => 'string',
				'length' => '255',
				'is_required' => true,
				'is_system' => false,
			],
			[
				'id' => 'ppe_signature',
				'caption' => 'API Signature',
				'type' => 'string',
				'length' => '255',
				'is_required' => true,
				'is_system' => false,
			],
            [
                'id'		=> 'ppe_sandbox',
                'caption'	=> 'PayPal Sandbox',
                'type'		=> 'boolean',
                'length'	=> '20',
                'is_required'=> false,
                'is_system' => false,
                'comment' => '<span class="tooltip-checkbox" data-toggle="tooltip" data-placement="auto left" title="check to enable PayPal Sandbox"><i class="fa fa-question-circle" aria-hidden="true"></i></span>',
            ],
		];

		return array_merge($commonDetails, $details);
	}
}
