<?php

class SJB_DisplayForm extends SJB_ClassifiedsForm
{
	function __construct($fields_info = null)
	{
		$this->display_type = 'display';
		parent::__construct($fields_info);
	}
}
