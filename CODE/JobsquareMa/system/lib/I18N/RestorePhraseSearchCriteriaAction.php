<?php


class SJB_RestorePhraseSearchCriteriaAction
{
	var $errors = array();
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
		$this->criteria = $this->storage->restore();
	}

	function getErrors()
	{
		return $this->errors;
	}
}

