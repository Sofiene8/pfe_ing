<?php

class I18NError
{
	var $error;

	function __construct($error)
	{
		$this->error = $error;
	}
	function getError()
	{
		return $this->error;
	}
}
