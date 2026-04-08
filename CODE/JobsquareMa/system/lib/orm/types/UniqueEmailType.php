<?php

class SJB_UniqueEmailType extends SJB_EmailType
{
    function isValid()
    {
        $isValid = parent::isValid();
        if ($isValid !== true) {
            return $isValid;
        }
        if ($this->property_info['is_system']) {
            $count = SJB_DB::queryValue("SELECT count(*) FROM `users` WHERE ?w = ?s AND sid <> ?n",
                $this->property_info['id'], $this->property_info['value'], $this->object_sid);
        } else {
            $count = SJB_DB::queryValue("SELECT COUNT(*) FROM `users_properties` WHERE id = ?s AND value = ?s AND object_sid <> ?n",
                $this->property_info['id'], $this->property_info['value'], $this->object_sid);
        }

        if ($count) {
            return 'NOT_UNIQUE_VALUE';
        }
        return true;
    }

    function getPropertyVariablesToAssign()
    {
        return [
            'id' => $this->property_info['id'],
            'value' => $this->property_info['value'],
            'isUsername' => true,
        ];
    }

    function getSavableValue()
    {
        return $this->property_info['value'];
    }

    function getSQLValue()
    {
        return trim($this->property_info['value']);
    }

    function isEmpty()
    {
        $value_is_empty = false;
        if (is_array($this->property_info['value'])) {
            $originalValue = isset($this->property_info['value']) ? $this->property_info['value'] : '';
            $originalValue = trim($originalValue);
            // check only 'original' for empty value
            if (!empty($originalValue)) {
                $value_is_empty = false;
            }
        } else {
            $this->property_info['value'] = trim($this->property_info['value']);
            $value_is_empty = ($this->property_info['value'] == '');
        }

        return $value_is_empty;
    }

}
