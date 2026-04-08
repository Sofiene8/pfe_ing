<?php

class SJB_UserProfileDisplayListController extends SJB_DisplayListController
{
	public function __construct($input_data)
	{
		parent::__construct($input_data, new SJB_UserProfileFieldManager, new SJB_UserProfileFieldListItemManager);
	}

	function _getTypeInfo()
	{
		return SJB_UserGroupManager::getUserGroupInfoBySID($this->field->getUserGroupSID());
	}

	function _getTypeSID()
	{
		return $this->field->getUserGroupSID();
	}
}
