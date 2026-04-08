<?php

class SJB_InvoicePagination extends SJB_Pagination
{
    public function __construct()
    {
        $this->item = 'invoices';
        $this->countActionsButtons = 2;
        $actionsForSelect = [
            'paid' =>   ['name' => 'Mark Paid'],
            'unpaid' => ['name' => 'Mark Unpaid'],
            'delete' => ['name' => 'Delete'],
        ];
        $this->setActionsForSelect($actionsForSelect);

        $fields = [
            'sid' =>            ['name' => 'Invoice #'],
            'username' =>       ['name' => 'Customer Name'],
            'date' =>           ['name' => 'Date'],
            'payment_method' => ['name' => 'Payment Method'],
            'total' =>          ['name' => 'Total'],
            'status' =>         ['name' => 'Status'],
        ];
        $this->setSortingFieldsToPaginationInfo($fields);

        parent::__construct('sid', 'DESC');
    }
}
