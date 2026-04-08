<?php

class SJB_AdminEmailType extends SJB_EmailType
{
    function isValid()
    {
        $isValid = parent::isValid();
        if (!$isValid) {
            return false;
        }
        if ($this->object_sid) {
            $exists = (bool) SJB_DB::queryValue('select `sid` from `admins` where `email` = ?s and sid <> ?n limit 1', $this->getValue(), $this->object_sid);
        } else {
            $exists = (bool) SJB_DB::queryValue('select `sid` from `admins` where `email` = ?s limit 1', $this->getValue());
        }
        if ($exists) {
            return 'NOT_UNIQUE_VALUE';
        }
        return true;
    }
}
