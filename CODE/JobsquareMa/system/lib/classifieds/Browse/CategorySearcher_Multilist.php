<?php

class SJB_CategorySearcher_MultiList extends SJB_AbstractCategorySearcher
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
        $res = parent::_get_Captions_with_Counts_Grouped_by_Captions($request_data, $listingSids);
        foreach ($res as $key => $value) {
            if (strpos($key, ',')) {
                unset($res[$key]);
                $newKeys = explode(',', $key);
                foreach ($newKeys as $newKey) {
                    $res[$newKey] = isset($res[$newKey]) ? $res[$newKey] + $value : $value;
                }
            }
        }
        return $res;
    }

}
