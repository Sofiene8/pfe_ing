<?php

class SJB_ListingFieldRequestCreator extends SJB_DBObjectRequestCreator
{
	function __construct($listing_sid_collection)
	{
		$this->table_prefix = 'listing_fields';
		parent::__construct($listing_sid_collection);
	}
}
