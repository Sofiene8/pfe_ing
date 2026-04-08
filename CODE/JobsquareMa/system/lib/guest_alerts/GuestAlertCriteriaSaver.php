<?php

class SJB_GuestAlertCriteriaSaver extends SJB_CriteriaSaver
{
	function __construct($searchId = 'GuestAlertSearcher')
	{
		$searchId = 'GuestAlertSearcher_'.$searchId;
		parent::__construct($searchId, new SJB_GuestAlertManager());
	}
}
