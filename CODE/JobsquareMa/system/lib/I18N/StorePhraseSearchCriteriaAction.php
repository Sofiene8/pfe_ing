<?php

class SJB_StorePhraseSearchCriteriaAction
{
    var $errors = [];
    var $storage = null;
    var $criteria = null;

    public function __construct(&$storage, &$criteria)
    {
        $this->storage =& $storage;
        $this->criteria =& $criteria;
    }

    function canPerform()
    {
        return true;
    }

    function perform()
    {
        $this->storage->store($this->criteria);
    }

    function getErrors()
    {
        return $this->errors;
    }
}
