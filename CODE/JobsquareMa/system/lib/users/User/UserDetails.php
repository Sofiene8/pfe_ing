<?php

class SJB_UserDetails extends SJB_ObjectDetails
{
    var $properties;
    var $details;

    function __construct($user_info, $user_group_sid)
    {
        $details_info = SJB_UserDetails::getDetails($user_group_sid, !empty($user_info['reference_uid']));

        $sort_array = array();
        foreach ($details_info as $index => $property_info) {
            $sort_array[$index] = isset($property_info['order']) ? $property_info['order'] : count($sort_array);
        }
        $sort_array = SJB_HelperFunctions::array_sort($sort_array);
        $sorted_details_info = [];
        foreach ($sort_array as $index => $value) {
            $sorted_details_info[$index] = $details_info[$index];
        }

        foreach ($sorted_details_info as $detail_info) {
            $detail_info['value'] = '';
            if (isset($user_info[$detail_info['id']])) {
                $detail_info['value'] = $user_info[$detail_info['id']];
            }

            $this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
        }
    }

    public static function getDetails($user_group_sid, $referenceUid = false)
    {
        $details = [
            [
                'id' => 'featured',
                'caption' => 'Featured',
                'type' => 'boolean',
                'length' => '20',
                'is_required' => false,
                'is_system' => true,
                'order' => null,
            ],
            [
                'id' => 'active',
                'caption' => 'Status',
                'type' => 'list',
                'list_values' => [
                    [
                        'id' => '1',
                        'caption' => 'Active',
                    ],
                    [
                        'id' => '2',
                        'caption' => 'Pending Approval',
                    ],
                    [
                        'id' => '0',
                        'caption' => 'Not active',
                    ],
                ],
                'length' => '10',
                'is_required' => false,
                'is_system' => true,
            ],
        ];

        $extra_details = SJB_UserProfileFieldManager::getFieldsInfoByUserGroupSID($user_group_sid);
        foreach ($extra_details as $key => $extra_detail) {
            $extra_details[$key]['is_system'] = $extra_detail['type'] != 'complex';
        }
        return array_merge($details, $extra_details);
    }
}
