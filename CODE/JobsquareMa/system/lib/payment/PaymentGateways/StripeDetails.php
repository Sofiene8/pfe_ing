<?php


class SJB_StripeDetails extends SJB_PaymentGatewayDetails
{
    public static function getDetails()
	{
        $commonDetails = parent::getDetails();

		$details = [
			[
				'id' => 'stripe_secret_key',
				'caption' => 'Secret Key',
				'type' => 'string',
				'length' => '255',
				'is_required' => true,
				'is_system' => false,
			],
			[
				'id' => 'stripe_pub_key',
				'caption' => 'Publishable Key',
				'type' => 'string',
				'length' => '255',
				'is_required' => true,
				'is_system' => false,
			],
		];

		return array_merge($commonDetails, $details);
	}
}

