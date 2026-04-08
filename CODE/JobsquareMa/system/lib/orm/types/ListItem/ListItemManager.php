<?php

class SJB_ListItemManager
{
	protected $table_prefix = null;

	public function saveListItem($list_item, $order)
	{
		$item_sid = $list_item->getSID();
		SJB_Cache::getInstance()->clean('matchingAnyTag', array(SJB_Cache::TAG_FIELDS));
		if (is_null($item_sid)) {
			return SJB_DB::query("INSERT INTO {$this->table_prefix}_field_list SET field_sid = ?n, value = ?s, `order` = ?n", $list_item->getFieldSID(), $list_item->getValue(), $order);
		} else {
			return SJB_DB::query("UPDATE {$this->table_prefix}_field_list SET `value` = ?s, `order` = ?n WHERE sid = ?n", $list_item->getValue(), $order, $item_sid);
		}
	}

	public function getHashedListItemsByFieldSID($listing_field_sid)
	{
		$items = SJB_DB::query("SELECT * FROM {$this->table_prefix}_field_list WHERE field_sid = ?n ORDER BY `order`", $listing_field_sid);
		$list_items = array();
		foreach ($items as $item) {
			$list_items[$item['sid']] = $item['value'];
		}
		return $list_items;
	}

	public function deleteListItemBySID($list_item_sid)
	{
		return SJB_DB::query("DELETE FROM {$this->table_prefix}_field_list WHERE sid = ?n", $list_item_sid);
	}

	public function getListItemBySID($list_item_sid)
	{
		$item_info = SJB_DB::query("SELECT * FROM {$this->table_prefix}_field_list WHERE sid = ?n", $list_item_sid);

		if (!empty($item_info)) {
			$item_info = array_pop($item_info);

			$list_item = new SJB_ListItem();
			$list_item->setValue($item_info['value']);
			$list_item->setFieldSID($item_info['field_sid']);
			$list_item->setSID($list_item_sid);

			return $list_item;
		}
		return null;
	}

	public function getListItemByValue($field_sid, $value)
	{
		$item_info = SJB_DB::query("SELECT * FROM `{$this->table_prefix}_field_list` WHERE `field_sid`=?n AND `value`=?s", $field_sid, $value);

		if (!empty($item_info)) {
			$item_info = array_pop($item_info);

			$list_item = new SJB_ListItem();
			$list_item->setValue($item_info['value']);
			$list_item->setFieldSID($item_info['field_sid']);
			$list_item->setSID($item_info['sid']);
			return $list_item;
		}
		return null;
	}
}
