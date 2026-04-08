<?php

class SJB_CategorySearcher_Value extends SJB_AbstractCategorySearcher
{
	function _decorateItems($items)
	{
		$decorated = [];
		foreach ($items as $key => $item) {
			$decorated[] = [
				'caption' => $key,
				'count' => $item
			];
		}
		return $decorated;
	}
}
