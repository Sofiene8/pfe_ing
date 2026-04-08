<?php

class SJB_FloatType extends SJB_IntegerType
{
    protected $default_template = 'float.tpl';

    function isValid()
    {
        $value = $this->property_info['value'];

        $i18n = SJB_ObjectMother::createI18N();
        if (!$i18n->isValidFloat($value)) {
            return 'NOT_FLOAT_VALUE';
        }

        if (!empty($this->property_info['validators'])) {
            foreach ($this->property_info['validators'] as $validator) {
                $isValid = $validator::isValid($this);
                if ($isValid !== true)
                    return $isValid;
            }
        }
        return true;
    }

    function getSQLValue()
    {
        $value = $this->_format_value_with_signs_num();
        return $value ? $value : null;
    }

    function getKeywordValue()
    {
        return $this->_format_value_with_signs_num();
    }

    function _format_value_with_signs_num()
    {
        $i18n = SJB_ObjectMother::createI18N();
        return $i18n->getInput('float', $this->property_info['value']);
    }

    function getSQLFieldType()
    {
        return "FLOAT NULL";
    }
}
