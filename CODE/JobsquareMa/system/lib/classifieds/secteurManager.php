<?php

class SJB_SecteurManager
{
	
	
	public static function getStateInfoBySID($state_sid)
	{

	$messageIndfo = SJB_DB::query("SELECT * FROM `secteurs` WHERE `sid`=?s", $state_sid);
	return $messageIndfo;
	}


	public static function deleteStateBySID($state_sid)
	{
	return SJB_DB::query("delete FROM `secteurs` WHERE `sid`=?s", $state_sid);
	}

	public static function saveState($state)
	{
		$result = SJB_SecteurDBManager::saveState($state);
		return $result;
	}
	
}
