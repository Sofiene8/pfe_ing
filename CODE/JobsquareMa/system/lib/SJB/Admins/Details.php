<?php

namespace SJB\Admins;

class Details extends \SJB_ObjectDetails
{
    public function __construct($object_info)
    {
        parent::__construct($object_info);
        $this->getProperty('permissions_type')->setDefaultTemplate('permissions_type.tpl');
        if ($this->getProperty('owner')->getValue()) {
            $this->deleteProperty('permissions_type');
            $this->deleteProperty('permissions');
            $this->deleteProperty('status');
        }
        $this->deleteProperty('owner');
    }

    public function getDetails()
    {
        return [
            [
                'id' => 'name',
                'caption' => 'Full Name',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
                'is_system' => true,
                'order' => 1,
            ],
            [
                'id' => 'email',
                'caption' => 'Email',
                'type' => 'admin_email',
                'length' => '255',
                'is_required' => true,
                'is_system' => true,
                'order' => 2,
            ],
            [
                'id' => 'password',
                'caption' => 'Password',
                'type' => 'password',
                'is_required' => false,
                'is_system' => true,
                'order' => 4,
            ],
            [
                'id' => 'owner',
                'caption' => 'Owner',
                'type' => 'boolean',
                'is_required' => false,
                'is_system' => true,
            ],
            [
                'id' => 'permissions_type',
                'caption' => 'Permissions',
                'type' => 'string',
                'is_required' => false,
                'is_system' => true,
            ],
            [
                'id' => 'permissions',
                'caption' => 'Allow Access To',
                'type' => 'multilist',
                'list_values' => [
                    [
                        'id' => 'Job Board',
                        'caption' => 'Job Board',
                    ],
                    [
                        'id' => 'Appearance',
                        'caption' => 'Appearance',
                    ],
                    [
                        'id' => 'Content',
                        'caption' => 'Content',
                    ],
                    [
                        'id' => 'Ecommerce',
                        'caption' => 'Ecommerce',
                    ],
                    [
                        'id' => 'Settings and Configuration',
                        'caption' => 'Settings and Configuration',
                    ],
                ],
                'display_as' => 'checkboxes',
                'is_required' => false,
                'is_system' => true,
            ],
        ];
    }
}

