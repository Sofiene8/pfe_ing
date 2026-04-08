<?php

class SJB_Miscellaneous_OpengraphMeta extends SJB_Function
{
	public function execute()
	{
        SJB_ListingManager::setMetaOpenGraph(SJB_Request::getVar('listing', []));
	}
}