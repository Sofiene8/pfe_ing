<?php

class SJB_MessageDBManager extends SJB_ObjectDBManager
{
	public static function getMessages()
	{
		
			$GLOBALS['messages'] = SJB_DB::query('SELECT * FROM messages WHERE  ORDER BY `order`');
	}
	
	
	public static function saveMessage($message)
	{
	
		$sid = $message->getSID();
		$message_text=$message->getMessage();
		if ($sid) {
			return  SJB_DB::query("UPDATE `messages` SET `message` = '".$message_text."' WHERE `sid` = ".$sid);
		}
		else
		return SJB_DB::query("INSERT INTO `messages` (message) VALUES('".$message_text."')");
		
	}

	
}

