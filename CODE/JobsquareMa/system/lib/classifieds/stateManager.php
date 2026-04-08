<?php

class SJB_StateManager
{
	
	
	public static function getStateInfoBySID($state_sid)
	{

	$messageIndfo = SJB_DB::query("SELECT * FROM `states` WHERE `sid`=?s", $state_sid);
	return $messageIndfo;
	}


	public static function deleteStateBySID($state_sid)
	{
	return SJB_DB::query("delete FROM `states` WHERE `sid`=?s", $state_sid);
	}

	public static function saveState($state)
	{
		$result = SJB_StateDBManager::saveState($state);
		return $result;
	}
	
}
