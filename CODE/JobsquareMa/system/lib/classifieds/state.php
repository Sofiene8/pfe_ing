<?php

class SJB_State extends SJB_Object
{
	
	var $name;
	var $sid;
	var $picture;
	var $display;
	var $url;
	var $description;
	public function __construct($state_info)
	{
		
		$this->db_table_name = 'states';
	
	}
	
	function setListingTypeSID($listing_type_sid)
	{
		$this->listing_type_sid = $listing_type_sid;
	}
	
	function setSID($sid){
	 $this->sid=$sid;
	}
	function setName($name){
	 $this->name=$name;
	}
	function setPicture($picture){
	 $this->picture=$picture;
	}
	function getName()
	{
		return $this->name;
	}
	function getPicture()
	{
		return $this->picture;
	}
	function setDisplay($display)
	{
	 $this->display=$display;
	}
		function getDisplay()
	{
		return $this->$display;
	}
	
	
	function setUrl($url)
	{
	 $this->url=$url;
	}
		function getUrl()
	{
		return $this->$url;
	}
	
		function setDescription($description)
	{
	 $this->description=$description;
	}
		function getDescription()
	{
		return $this->$description;
	}
		function getSID()
	{
		return $this->sid;
	}
	
}