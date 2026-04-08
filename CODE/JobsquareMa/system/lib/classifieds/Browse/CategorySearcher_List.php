<?php

class SJB_CategorySearcher_List extends SJB_AbstractCategorySearcher
{
    protected function _decorateItems($items)
    {
        $listingFieldListItemManager = new SJB_ListingFieldListItemManager();
        $values = $listingFieldListItemManager->getHashedListItemsByFieldSID($this->field['sid']);
        $listData = [];
        foreach ($values as $id => $value) {
            $listData[$id] = [
                'caption' => $value,
                'count' => isset($items[$id]) ? $items[$id] : 0
            ];
        }
        return $listData;
    }

    protected function _get_Captions_with_Counts_Grouped_by_Captions($request_data, array $listingSids = [])
    {
        return parent::_get_Captions_with_Counts_Grouped_by_Captions($request_data, $listingSids);
    }
}
