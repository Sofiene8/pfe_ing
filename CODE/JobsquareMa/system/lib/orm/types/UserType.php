<?php

class SJB_UserType extends SJB_Type
{
    protected $userGroup;
    protected $default_template = 'user.tpl';

    public function __construct($property_info)
    {
        parent::__construct($property_info);

        if (!empty($property_info['user_group'])) {
            $this->userGroup = $property_info['user_group'];
        }
    }

    function isValid()
    {
        if (!empty($this->property_info['value']) && ($userInfo = SJB_UserManager::getUserInfoByUserName($this->property_info['value']))) {
            if ($userInfo['user_group_sid'] == $this->userGroup['sid']) {
                return true;
            }
        }
        return 'NOT_VALID_ID_VALUE';
    }

    function getPropertyVariablesToAssign()
    {
        return array_merge(
            parent::getPropertyVariablesToAssign(),
            [
                'user_group' => $this->userGroup
            ]
        );
    }

    function getSQLFieldType()
    {
        return "INT( 11 )";
    }
}
