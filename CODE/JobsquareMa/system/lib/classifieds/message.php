<?php

class SJB_Message extends SJB_Object
{
	
	var $message;
	var $sid;
	
	public function __construct($message_info)
	{
		
		$this->db_table_name = 'messages';
	
	}
	
	function setListingTypeSID($listing_type_sid)
	{
		$this->listing_type_sid = $listing_type_sid;
	}
	
	function setSID($sid){
	 $this->sid=$sid;
	}
	function setMessage($message){
	 $this->message=$message;
	}
	function getMessage()
	{
		return $this->message;
	}
		function getSID()
	{
		return $this->sid;
	}
	
}