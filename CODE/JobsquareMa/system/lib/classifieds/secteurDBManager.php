<?php

class SJB_SecteurDBManager extends SJB_ObjectDBManager
{
	public static function getStates()
	{
		
			$GLOBALS['states'] = SJB_DB::query('SELECT * FROM secteurs WHERE  ORDER BY `order`');
	}
	
	
	public static function saveState($state)
	{

		$sid = $state->getSID();
		$message_text=$state->name;
		$picture=$state->picture;
		$display=$state->display;
		$url=$state->url;
		$description=$state->description;
		if ($sid) {

			return  SJB_DB::query("UPDATE `secteurs` SET `name` = '".$message_text."', picture='".$picture."' , display='".$display."',url='".$url."', description='".$description."' WHERE `sid` = ".$sid);
		}
		else
		return SJB_DB::query("INSERT INTO `secteurs` (name,picture,display,url,description) VALUES('".$message_text."','".$picture."','".$display."','".$url."','".$description."')");
		
	}

	
}

