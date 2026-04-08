<?php

class SJB_PasswordType extends SJB_Type
{
    protected $default_template = 'password.tpl';

    function isValid()
    {
        if (is_array($this->property_info['value'])) {
            if ($this->property_info['value']['original'] != $this->property_info['value']['confirmed']) {
                return 'NOT_CONFIRMED';
            }
        }
        return true;
    }

    function isEmpty()
    {
        if (is_array($this->property_info['value'])) {
            return trim($this->property_info['value']['original']) == "" && trim($this->property_info['value']['confirmed']) == "";
        }
        return empty($this->property_info['value']);
    }

    function getSavableValue()
    {
        return $this->property_info['value']['original'];
    }

    function getSearchValue($template)
    {
        return null;
    }

    function getSQLValue()
    {
        $value = is_array($this->property_info['value'])
            ? $this->property_info['value']['original']
            : $this->property_info['value'];
        return password_hash($value, PASSWORD_BCRYPT);
    }
}
