<?php

class SJB_RecurringProduct extends SJB_MixedProduct
{
    public function getDetails()
    {
        $details = [
            [
                'id'			=> 'name',
                'caption'		=> 'Name',
                'type'			=> 'string',
                'length'		=> '20',
                'table_name'	=> 'products',
                'is_required'	=> true,
                'is_system'		=> true,
                'order'			=> 1,
            ],
            [
                'id'			=> 'detailed_description',
                'caption'		=> 'Description',
                'type'			=> 'text',
                'length'		=> '20',
                'table_name'	=> 'products',
                'is_required'	=> false,
                'is_system'		=> true,
                'order'			=> 2,
            ],
            [
                'id'			=> 'user_group_sid',
                'caption'		=> 'User Group',
                'type'			=> 'string',
                'length'		=> '20',
                'table_name'	=> 'products',
                'value'			=> $this->userGroup['sid'],
                'is_required'	=> true,
                'is_system'		=> true,
                'order'			=> 4,
            ],
            [
                'id'			=> 'active',
                'caption'		=> 'Active',
                'type'			=> 'boolean',
                'length'		=> '20',
                'table_name'	=> 'products',
                'is_required'	=> false,
                'is_system'		=> true,
                'order'			=> 14,
                'default_value' => true
            ],
            [
                'id' => 'listing_type_sid',
                'caption' => 'Listing Type',
                'type' => 'string',
                'length' => '20',
                'table_name' => 'products',
                'value' => $this->listingType['sid'],
                'is_required' => true,
                'is_system' => true,
                'order' => 1,
            ],
            [
                'id' => 'price',
                'caption' => 'Price',
                'type' => 'float',
                'validators' => [
                    'SJB_PlusValidator',
                ],
                'length' => '20',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 3,
            ],
            [
                'id' => 'billing_cycle',
                'caption' => 'Billing Cycle',
                'type' => 'list',
                'list_values' => [
                    [
                        'id' => 'month',
                        'caption' => 'per month',
                    ],
                    [
                        'id' => 'year',
                        'caption' => 'per year',
                    ]
                ],
                'length' => '20',
                'table_name' => 'products',
                'is_required' => true,
                'is_system' => true,
                'order' => 4,
                'template' => 'switchable_buttons.tpl',
            ],
            [
                'id' => 'number_of_listings',
                'caption' => 'Job Slots',
                'type' => 'integer',
                'validators' => [
                    'SJB_PlusValidator',
                ],
                'length' => '20',
                'comment' => 'Job slots are the maximum number of jobs employer can have posted simultaneously. Leave empty for unlimited job slots.',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 5,
            ],
            [
                'id' => 'post_' . strtolower($this->listingType['id']),
                'caption' => 'Post ' . $this->listingType['name'] . ($this->listingType['id'] == 'Job' ? 's' : ''),
                'type' => 'boolean',
                'length' => '20',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 4,
            ],
            [
                'id' => 'listing_duration',
                'caption' => $this->listingType['name'] . ' listing duration',
                'type' => 'integer',
                'validators' => [
                    'SJB_PlusValidator',
                ],
                'length' => '20',
                'comment' => 'How many days the job stay active on your site. Leave empty for unlimited duration.',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 6,
            ],
            [
                'id' => 'featured',
                'caption' => 'Featured ' . $this->listingType['name'],
                'type' => 'boolean',
                'length' => '20',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 7,
            ],
            [
                'id' => 'resume_access',
                'caption' => 'Resume Access',
                'type' => 'boolean',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 9,
            ],
            [
                'id' => 'recurring',
                'caption' => '',
                'type' => 'boolean',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 999,
            ],
        ];
        foreach ($details as $key => $detail) {
            if ($detail['id'] == 'trial') {
                unset($details[$key]);
            }
        }
        $additionalDetails = [];
        if ($this->userGroup['id'] == 'Employer') {
            $additionalDetails[] = [
                'id' => 'featured_employer',
                'caption' => 'Featured ' . $this->userGroup['name'],
                'type' => 'boolean',
                'table_name' => 'products',
                'is_required' => false,
                'is_system' => true,
                'order' => 8,
            ];
        }
        return array_merge($details, $additionalDetails);
    }

	public function getPages()
	{
	    $pages = parent::getPages();
        $pages['general']['fields'][] = 'billing_cycle';
        $pages['general']['fields'][] = 'recurring';
		return $pages;
	}
}
