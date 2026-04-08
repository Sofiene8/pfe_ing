<?php

class SJB_MessageManager
{
	
	
	public static function getMessageInfoBySID($message_sid)
	{

	$messageIndfo = SJB_DB::query("SELECT * FROM `messages` WHERE `sid`=?s", $message_sid);
	return $messageIndfo;
	}


	public static function deleteMessageBySID($message_sid)
	{
	return SJB_DB::query("delete FROM `messages` WHERE `sid`=?s", $message_sid);
	}

	public static function saveMessage($message)
	{
		$result = SJB_MessageDBManager::saveMessage($message);
		return $result;
	}
	
}
