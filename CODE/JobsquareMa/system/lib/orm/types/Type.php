<?php

class SJB_Type
{
    var $property_info = null;
    var $object_sid = null;
    protected $default_template = null;
    private $complexParent = null;

    public function __construct($property_info)
    {
        $this->property_info = $property_info;
        if (empty($this->property_info['default_value']))
            $this->property_info['default_value'] = '';
        if (!empty($property_info['template'])) {

            $this->default_template = $property_info['template'];
        }
    }

    public function setComplexParent($parent)
    {
        $this->complexParent = $parent;
    }

    public function getComplexParent()
    {
        return $this->complexParent;
    }

    function getPropertyVariablesToAssign()
    {
        return [
            'id' => $this->property_info['id'],
            'value' => $this->property_info['value'] !== null ? SJB_HelperFunctions::getClearVariablesToAssign($this->property_info['value']) : null,
            'default_value' => $this->property_info['default_value'],
            'hidden' => $this->property_info['hidden']
        ];
    }

    function setObjectSID($sid)
    {
        $this->object_sid = $sid;
    }

    function getSavableValue()
    {
        return $this->property_info['value'];
    }

    function isValid()
    {
        if (!empty($this->property_info['validators'])) {
            foreach ($this->property_info['validators'] as $validator) {
                $isValid = $validator::isValid($this);
                if ($isValid !== true) {
                    return $isValid;
                }
            }
        }
        return true;
    }

    function setID($id)
    {
        $this->property_info['id'] = $id;
    }

    function setValue($value)
    {
        $this->property_info['value'] = $value;
    }

    function getValue()
    {
        return isset($this->property_info['value']) ? $this->property_info['value'] : null;
    }

    function getSQLValue()
    {
        $value = $this->property_info['value'];
        return is_null($value) || $value == '' ? '' : $value;
    }

    function getAddParameter()
    {
        return '';
    }

    function getKeywordValue()
    {
        return '';
    }

    function getType()
    {
        return $this->property_info['type'];
    }

    public static function getFieldExtraDetails()
    {
        return [];
    }

    function getDefaultTemplate()
    {
        return $this->default_template;
    }

    /**
     *
     * @param string $newTemplate
     */
    function setDefaultTemplate($newTemplate)
    {
        if (!empty ($newTemplate)) {
            $this->default_template = $newTemplate;
        }
    }

    public function makeRequired()
    {
        $this->property_info['is_required'] = true;
    }

    public function makeNotRequired()
    {
        $this->property_info['is_required'] = false;
    }

    public function makeHidden()
    {
        $this->property_info['hidden'] = true;
    }

    public function makeNotHidden()
    {
        $this->property_info['hidden'] = false;
    }

    function isEmpty()
    {
        $value_is_empty = false;
        if (is_array($this->property_info['value'])) {
            foreach ($this->property_info['value'] as $field_value) {
                $field_value = trim($field_value);
                if ($field_value == '') {
                    $value_is_empty = true;
                    break;
                }
            }
        } else {
            $this->property_info['value'] = trim($this->property_info['value']);
            $value_is_empty = ($this->property_info['value'] == '');
        }
        return $value_is_empty;
    }

    function isComplex()
    {
        return false;
    }

    function setComplexEnum($value)
    {
        return false;
    }

    function getSQLFieldType()
    {
        return 'VARCHAR( 255 ) NULL';
    }
}
