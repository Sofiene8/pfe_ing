<?php

class SJB_InvoiceGatewayDetails extends SJB_PaymentGatewayDetails
{
    public static function getDetails()
    {
        $details = [
            [
                'id' => 'mark_as_paid',
                'caption' => 'Mark orders as paid',
                'type' => 'boolean',
                'is_system' => false,
                'comment' => '<span class="tooltip-checkbox" data-toggle="tooltip" data-placement="auto left" title="Clicking this box will mean that the product purchased through invoicing will be automatically active after order is placed. Even though it\'s not paid yet."><i class="fa fa-question-circle" aria-hidden="true"></i></span>',
            ],
            [
                'id' => 'payment_instructions',
                'caption' => 'Payment Instructions',
                'type' => 'text',
                'is_required' => false,
                'is_system' => false,
            ],
        ];

        return array_merge(parent::getDetails(), $details);
    }
}
