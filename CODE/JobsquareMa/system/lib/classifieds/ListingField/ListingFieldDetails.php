<?php

class SJB_ListingFieldDetails extends SJB_ObjectDetails
{
    public function __construct($listing_field_info, $pages_list = [])
    {
        $details_info = self::getDetails($listing_field_info, $pages_list);
        $sort_array = [];
        foreach ($details_info as $index => $property_info) {
            $sort_array[$index] = isset($property_info['order']) ? $property_info['order'] : 1000;
        }
        $sort_array = SJB_HelperFunctions::array_sort($sort_array);

        foreach ($sort_array as $index => $value)
            $sorted_details_info[$index] = $details_info[$index];

        foreach ($sorted_details_info as $detail_info) {
            if (isset($listing_field_info[$detail_info['id']])) {
                $detail_info['value'] = $listing_field_info[$detail_info['id']];
            } else {
                $detail_info['value'] = isset($detail_info['value']) ? $detail_info['value'] : '';
            }
            $this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
        }
    }

    public static function getDetails($listing_field_info, $pages_list = [])
    {
        $common_details_info = [
            [
                'id' => 'id',
                'caption' => 'Caption',
                'type' => 'unique_string',
                'validators' => [
                    'SJB_IdValidator',
                    'SJB_OneCharValidator',
                    'SJB_UniqueSystemValidator',
                    'SJB_UniqueSystemListingFieldsValidator',
                ],
                'length' => '20',
                'table_name' => 'listing_fields',
                'is_required' => true,
                'is_system' => true,
                'order' => 1,
            ],
            [
                'id' => 'caption',
                'caption' => 'Caption',
                'type' => 'string',
                'length' => '20',
                'table_name' => 'listing_fields',
                'is_required' => true,
                'is_system' => true,
                'order' => 2,
            ],
            [
                'id' => 'type',
                'caption' => 'Type',
                'type' => 'list',
                'list_values' => [
                    [
                        'id' => 'list',
                        'caption' => 'Dropdown',
                    ],
                    [
                        'id' => 'multilist',
                        'caption' => 'Multiselect',
                    ],
                    [
                        'id' => 'string',
                        'caption' => 'Text Field',
                    ],
                    [
                        'id' => 'text',
                        'caption' => 'Text Area',
                    ],
                    [
                        'id' => 'integer',
                        'caption' => 'Number',
                    ],
                    [
                        'id' => 'boolean',
                        'caption' => 'Checkbox',
                    ],
                    [
                        'id' => 'date',
                        'caption' => 'Date',
                    ],
                    [
                        'id' => 'file',
                        'caption' => 'File',
                    ],
                    [
                        'id' => 'picture',
                        'caption' => 'Picture',
                    ],
                    [
                        'id' => 'youtube',
                        'caption' => 'YouTube Video',
                    ],
                ],
                'length' => '',
                'is_required' => true,
                'is_system' => true,
                'order' => 3,
            ],
            [
                'id' => 'is_required',
                'caption' => 'Required',
                'type' => 'boolean',
                'length' => '20',
                'table_name' => 'listing_fields',
                'is_required' => false,
                'is_system' => true,
                'order' => 4,
            ],
        ];

        if ($pages_list) {
            $posting_page = [
                [
                    'id' => 'posting_page',
                    'caption' => 'Posting Page',
                    'list_values' => $pages_list,
                    'type' => 'list',
                    'length' => '20',
                    'is_required' => true,
                    'is_system' => true,
                    'order' => 5,
                ]
            ];
            $common_details_info = array_merge($common_details_info, $posting_page);
        }
        $field_type = isset($listing_field_info['type']) ? $listing_field_info['type'] : null;
        $extra_details_info = self::getDetailsByFieldType($field_type);
        foreach ($extra_details_info as $key => $extra_details)
            $extra_details_info[$key]['is_system'] = true;
        return $details_info = array_merge($common_details_info, $extra_details_info);
    }

    public static function getDetailsByFieldType($field_type)
    {
        return SJB_TypesManager::getExtraDetailsByFieldType($field_type);
    }

    public static function getParentSID($value = '')
    {
        return [
            'id' => 'parent_sid',
            'type' => 'id',
            'length' => '',
            'table_name' => 'listing_fields',
            'is_required' => false,
            'is_system' => true,
            'order' => 100,
            'value' => $value,
        ];
    }

    public static function getDisplayAsProperty($value, $fieldType)
    {
        if ($fieldType == 'list') {
            $listValues = [
                1 => ['id' => 'list', 'caption' => 'List'],
                2 => ['id' => 'radio_buttons', 'caption' => 'Radio Buttons'],
            ];
        } else {
            $listValues = [
                1 => ['id' => 'multilist', 'caption' => 'MultiList'],
                2 => ['id' => 'checkboxes', 'caption' => 'Checkboxes'],
            ];
        }
        return [
            'id' => 'display_as',
            'caption' => 'Display as',
            'value' => ($value),
            'type' => 'list',
            'length' => '',
            'list_values' => $listValues,
            'is_required' => false,
            'is_system' => true,
            'order' => 4
        ];
    }
}
