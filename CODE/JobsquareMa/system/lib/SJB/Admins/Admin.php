<?php

namespace SJB\Admins;

class Admin extends \SJB_Object
{
    public function __construct($props)
    {
        $this->db_table_name = 'admins';
        $this->details = new \SJB\Admins\Details($props);
        if (!empty($props['sid'])) {
            $this->setSID($props['sid']);
        }
    }

    public function getHash()
    {
        return sha1($this->getPropertyValue('email') . $this->getSID());
    }

    public function addStatusProperty()
    {
        $this->addProperty([
            'id' => 'status',
            'caption' => 'Status',
            'type' => 'multilist',
            'list_values' => [
                [
                    'id' => 'Active',
                    'caption' => 'Active',
                ],
                [
                    'id' => 'Not Active',
                    'caption' => 'Not Active',
                ],
                [
                    'id' => 'Pending',
                    'caption' => 'Pending',
                ],
            ],
            'is_required' => false,
            'is_system' => true,
        ]);
    }

    public function generateRecoverKey()
    {
        $rand = '';
        for ($i = 0; $i < 5; $i++) {
            $rand .= rand();
        }
        return sha1($this->getSID() . microtime(true) . $rand);
    }
}
