<?php

class SJB_PaymentGatewayDetails extends SJB_ObjectDetails
{
    public static function getDetails()
    {
        return [
            [
                'id' => 'id',
                'caption' => 'ID',
                'type' => 'id',
                'length' => '20',
                'is_required' => true,
                'is_system' => true,
            ],
            [
                'id' => 'name',
                'caption' => 'Name',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
                'is_system' => true,
            ],
            [
                'id' => 'caption',
                'caption' => 'Caption',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
                'is_system' => true,
            ],
            [
                'id' => 'active',
                'caption' => 'Active',
                'type' => 'boolean',
                'length' => '20',
                'is_required' => false,
                'is_system' => true,
            ],
        ];
    }
}
