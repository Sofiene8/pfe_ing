<?php

class SJB_InputForm extends SJB_ClassifiedsForm
{
	function __construct($fields_info = null)
	{
		$this->display_type = 'input';
		parent::__construct($fields_info);
	}
}