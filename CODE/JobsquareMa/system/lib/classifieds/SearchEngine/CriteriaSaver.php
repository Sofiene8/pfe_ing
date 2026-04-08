<?php

class SJB_CriteriaSaver
{
    /**
     * @var null|array
     */
    var $criteria = [];
    var $object_manager = [];
    var $storage_id = null;

    /**
     * @var int
     */
    var $total = 0;

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function __construct($storage_id, $object_manager)
    {
        $this->storage_id = $storage_id;
        $this->object_manager = $object_manager;
        $this->criteria = &$_SESSION[$storage_id]['criteria_values'];
        $this->order_info = &$_SESSION[$storage_id]['order_info'];
		
        $this->current_page = &$_SESSION[$storage_id]['page'];
        $this->listings_per_page = &$_SESSION[$storage_id]['listings_per_page'];
        if (is_null($this->criteria))
            $this->criteria = [];
    }

    function setSession($request_data)
    {
        $this->setSessionForCriteria($request_data);
    }

    function setSessionForCriteria($request_data)
    {
        $criteria_values = [];

        foreach ($request_data as $data_name => $data)
            if (is_array($data))
                $criteria_values[$data_name] = $data;

        $this->criteria = $criteria_values;
    }

    function setSessionForOrderInfo($request_data)
    {
        $sorting_field = isset($request_data['sorting_field']) ? $request_data['sorting_field'] : null;
        $sorting_order = isset($request_data['sorting_order']) ? $request_data['sorting_order'] : null;

        if (!empty($sorting_field) && !empty($sorting_order)) {
            $this->order_info = [
                'sorting_field' => $sorting_field,
                'sorting_order' => $sorting_order
            ];
        }
    }

    function setSessionForCurrentPage($current_page)
    {
        $this->current_page = $current_page;
    }

    function setSessionForListingsPerPage($listings_per_page)
    {
        $this->listings_per_page = $listings_per_page;
    }

    function getCriteria()
    {
        return $this->criteria;
    }

    function getOrderInfo()
    {
        return $this->order_info;
    }

    function getCurrentPage()
    {
        return $this->current_page;
    }

    function getListingsPerPage()
    {
        return $this->listings_per_page;
    }

    function createTemplateStructureForCriteria()
    {
        $structure = [];

        if (empty($this->criteria))
            return null;

        foreach ($this->criteria as $property_name => $criterion_value) {
            if (count($criterion_value) == 1)
                $criterion_value = array_pop($criterion_value);

            $structure[$property_name]['value'] = $criterion_value;
        }

        return $structure;
    }

    function createTemplateStructureForSearch()
    {
        $pages_number = null;
        if ($this->listings_per_page > 0) {
            $pages_number = ceil($this->total / $this->listings_per_page);
        }
        /**************** P A G I N G *****************/
        if ($this->current_page > $pages_number) {
            $this->current_page = $pages_number;
        }
        if ($this->current_page < 1) {
            $this->current_page = 1;
        }

        $structure = [
            'listings_number' => $this->total,
            'pages_number' => $pages_number,
            'listings_per_page' => $this->listings_per_page,
            'current_page' => $this->current_page,
            'sorting_field' => $this->order_info['sorting_field'],
            'sorting_order' => $this->order_info['sorting_order'],
        ];

        return $structure;
    }

    function resetSearchResultsDisplay()
    {
        $this->order_info = null;
        $this->current_page = null;
        $this->listings_per_page = null;
    }

    public function setSessionForRefine($fieldID, $data)
    {
        $_SESSION['refine'][$fieldID] = $data;
        $this->refine[$fieldID] = $data;
    }

    public function getSessionForRefine($fieldID)
    {
        if (!empty($_SESSION['refine'][$fieldID])) {
            $data = $_SESSION['refine'][$fieldID];
            $this->refine[$fieldID] = $data;
        }
        return isset($this->refine[$fieldID]) ? $this->refine[$fieldID] : false;
    }
}
