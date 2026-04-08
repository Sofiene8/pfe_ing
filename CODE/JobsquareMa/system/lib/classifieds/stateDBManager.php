<?php

class SJB_StateDBManager extends SJB_ObjectDBManager
{
	public static function getStates()
	{
		
			$GLOBALS['states'] = SJB_DB::query('SELECT * FROM states WHERE  ORDER BY `order`');
	}
	
	
	public static function saveState($state)
	{

		$sid = $state->getSID();
		$message_text=$state->getName();
		$picture=$state->getPicture();
		$display=$state->display;
		$url=$state->url;
		$description=$state->description;
		if ($sid) {

			return  SJB_DB::query("UPDATE `states` SET `name` = '".$message_text."', picture='".$picture."' , display='".$display."',url='".$url."', description='".$description."' WHERE `sid` = ".$sid);
		}
		else
		return SJB_DB::query("INSERT INTO `states` (name,picture,display,url,description) VALUES('".$message_text."','".$picture."','".$display."','".$url."','".$description."')");
		
	}

	
}

