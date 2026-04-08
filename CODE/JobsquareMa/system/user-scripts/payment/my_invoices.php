<?php

class SJB_Payment_MyInvoices extends SJB_Function
{
      protected $requestCriteria = [];
	  
	  
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
		if (!SJB_UserManager::isUserLoggedIn()) {
            $errors['NOT_LOGGED_IN'] = true;
            $tp->assign("ERRORS", $errors);
            $tp->display("error.tpl");
            return;
        }
        $currentUser = SJB_UserManager::getCurrentUser();
	 
	    $this->requestCriteria = [
            'user_sid' => ['equal' => $currentUser->getSID()],
            'date' => ['not_less' => '2026-01-01']
            
        ];

		
 
        /***************************************************************/
        $_REQUEST['action'] = 'search';
        $invoice = new SJB_Invoice([]);
        $invoice->addProperty([
            'id' => 'username',
            'type' => 'string',
            'value' => '',
            'is_system' => true,
        ]);

                 $invoice->addProperty([ 
            'id' => 'date',
            'type' => 'date',
            'value' => '',
            'is_system' => true,
        ]);
        $aliases = new SJB_PropertyAliases();
        $aliases->addAlias([
            'id' => 'username',
            'real_id' => 'user_sid',
            'transform_function' => 'SJB_UserDBManager::getUserSIDsLikeSearchString',
        ]);

        $searchFormBuilder = new SJB_SearchFormBuilder($invoice);
        $criteriaSaver = new SJB_InvoiceCriteriaSaver();
        if (isset($_REQUEST['restore']))
            $_REQUEST = array_merge($_REQUEST, $criteriaSaver->getCriteria());
		
		
        $criteria = $searchFormBuilder->extractCriteriaFromRequestData(array_merge($_REQUEST, $this->requestCriteria), $invoice);
        $searchFormBuilder->setCriteria($criteria);
        $searchFormBuilder->registerTags($tp);


        /********************** S O R T I N G *********************/
             $paginator = new SJB_InvoicePagination();
        $innerJoin = false;
        if ($paginator->sortingField == 'username') {
            $innerJoin = ['users' => ['sort_field' =>'CompanyName', 'join_field' => 'sid', 'join_field2' => 'user_sid', 'main_table' => 'invoices', 'join' => 'LEFT JOIN']];
        }
        $searcher = new SJB_InvoiceSearcher(['limit' => ($paginator->currentPage - 1) * $paginator->itemsPerPage, 'num_rows' => $paginator->itemsPerPage], $paginator->sortingField, $paginator->sortingOrder, $innerJoin);

        /**
         * @var SJB_Invoice[] $foundInvoices
         */
            $foundInvoices = [];
            $foundInvoicesInfo = [];

        if (SJB_Request::getVar('action', '') == 'search' || isset($_REQUEST['restore'])) {
            $foundInvoices = $searcher->getObjectsByCriteria($criteria, $aliases);
            if (empty($foundInvoices) && $paginator->currentPage != 1) {
                SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/invoices/?page=1');
            }
            $criteriaSaver->setSession($_REQUEST);
        }
		
		
        foreach ($foundInvoices as $id => $invoice) {
            $userSID = $invoice->getPropertyValue('user_sid');
            $foundInvoices[$id] = $invoice;
            $foundInvoicesInfo[$invoice->getSID()] = SJB_InvoiceManager::getInvoiceInfoBySID($invoice->getSID());
            $foundInvoicesInfo[$invoice->getSID()]['user'] = SJB_UserManager::getUserInfoBySID($userSID);
            $foundInvoicesInfo[$invoice->getSID()]['hash'] = $invoice->getHash();
			$foundInvoicesInfo[$invoice->getSID()]['products'] = $invoice->getProductNames();
			
	
        }

        $paginator->setItemsCount($searcher->getAffectedRows());
        $form_collection = new SJB_FormCollection($foundInvoices);
        $form_collection->registerTags($tp);
		
		/*
			 $products = [];
        if ($currentUser) {
            $productsSIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($currentUser->getUserGroupSID(), true);
            foreach ($productsSIDs as $key => $productSID) {
                $products[$key] = SJB_ProductsManager::getProductInfoBySID($productSID);
            }
        }
		
		*/
 // var_dump($products);exit;
        $tp->assign('paginationInfo', $paginator->getPaginationInfo());
        $tp->assign('found_invoices', $foundInvoicesInfo);
		
     $tp->display('my_invoices.tpl');
    }



   
}
