<?php

class SJB_InvoiceCriteriaSaver extends SJB_CriteriaSaver
{
	function __construct()
	{
		parent::__construct('InvoiceSearcher', new SJB_InvoiceManager);
	}
}
