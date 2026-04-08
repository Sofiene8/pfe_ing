<?php

class SJB_UserCriteriaSaver extends SJB_CriteriaSaver
{
	public function __construct($searchId = 'UserSearcher')
	{
		$searchId = 'UserSearcher_'.$searchId;
		parent::__construct($searchId, new SJB_UserManager);
	}
}
