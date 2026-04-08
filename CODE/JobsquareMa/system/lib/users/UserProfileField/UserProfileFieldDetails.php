<?php

class SJB_UserProfileFieldDetails extends SJB_ObjectDetails
{
    function __construct($user_profile_field_info)
    {
        $details_info = SJB_UserProfileFieldDetails::getDetails($user_profile_field_info);
        foreach ($details_info as $detail_info) {
            if (isset($user_profile_field_info[$detail_info['id']])) {
                $detail_info['value'] = $user_profile_field_info[$detail_info['id']];
            } else {
                $detail_info['value'] = isset($detail_info['value']) ? $detail_info['value'] : '';
            }
            $this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
        }
    }

    public static function getDetails($user_profile_field_info)
    {
        $common_details_info = [
            [
                'id' => 'id',
                'caption' => 'Caption',
                'type' => 'unique_string',
                'validators' => [
                    'SJB_OneCharValidator',
                    'SJB_UniqueSystemUserProfileFieldsValidator'
                ],
                'length' => '20',
                'table_name' => 'user_profile_fields',
                'is_required' => true,
                'is_system' => true,
            ],
            [
                'id' => 'caption',
                'caption' => 'Caption',
                'type' => 'string',
                'length' => '20',
                'is_required' => true,
                'is_system' => true,
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
                        'id' => 'boolean',
                        'caption' => 'Checkbox',
                    ],
                    [
                        'id' => 'date',
                        'caption' => 'Date',
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
            ],
            [
                'id' => 'is_required',
                'caption' => 'Required',
                'type' => 'boolean',
                'length' => '',
                'is_required' => false,
                'is_system' => true,
            ],
        ];

        $field_type = isset($user_profile_field_info['type']) ? $user_profile_field_info['type'] : null;
        $extra_details_info = SJB_UserProfileFieldDetails::getDetailsByFieldType($field_type);
        return array_merge($common_details_info, $extra_details_info);
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
            'table_name' => 'user_profile_fields',
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
        ];
    }
}

