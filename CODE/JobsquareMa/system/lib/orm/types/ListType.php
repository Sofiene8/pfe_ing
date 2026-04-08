<?php

class SJB_ListType extends SJB_Type
{
    var $list_values;
    protected $default_template = 'list.tpl';

    public function __construct($property_info)
    {
        parent::__construct($property_info);
        $this->list_values = isset($property_info['list_values']) ? $property_info['list_values'] : [];
    }

    function getPropertyVariablesToAssign()
    {
        $propertyVariables = parent::getPropertyVariablesToAssign();
        $propertyVariables['hidden'] = $this->property_info['hidden'];

        $newPropertyVariables = [
            'list_values' => $this->list_values,
            'caption' => $this->property_info['caption'],
            'is_required' => $this->property_info['is_required']
        ];
        return array_merge($newPropertyVariables, $propertyVariables);
    }

    function isValid()
    {
        return true;
    }

    function getSQLValue()
    {
        return $this->property_info['value'];
    }

    function getKeywordValue()
    {
        $result = '';
        foreach ($this->list_values as $listValue) {
            if ($this->property_info['value'] == $listValue['id']) {
                if (!empty($listValue['Code']) || !empty($listValue['Name'])) {
                    $result .= " {$listValue['Code']} ";
                    $result .= " {$listValue['Name']} ";
                } else {
                    $result .= " {$listValue['caption']} ";
                }
            }
        }
        return $result;
    }

    function getSQLFieldType()
    {
        return 'TEXT NULL';
    }

}
