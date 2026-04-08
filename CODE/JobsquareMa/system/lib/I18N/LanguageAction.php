<?php

class SJB_LanguageAction
{
	function __construct()
	{
		$this->errors = array();
	}
	
	function perform()
	{
	}

	function canPerform()
	{
		$this->errors[] = 'UNKNOWN_ACTION';
		return false;
	}

	function getErrors()
	{
		return $this->errors;
	}
}
