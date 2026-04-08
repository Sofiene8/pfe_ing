<?php

class SJB_Miscellaneous_TaskScheduler extends SJB_Function
{
    /** @var SJB_TemplateProcessor */
    public $tp;

    private $lang;
    private $currentDate;
    private $notifiedJobAlerts = [];

    public function execute()
    {
		
        /**
        //        echo phpinfo();exit;
        //        ini_set('display_errors', '1');
        //        error_reporting(E_ALL);
        set_time_limit(0);
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '9000');
        echo '<pre>';

        echo 'adf';
        //        SJB_DB::init("127.0.0.1", "tanitv6", "94EErmlx@@!!1", "jobsquare_v6");



        //        SJB_DB::init(SJB_System::getSystemSettings('DBHOST'), SJB_System::getSystemSettings('DBUSER'), SJB_System::getSystemSettings('DBPASSWORD'), SJB_System::getSystemSettings('DBNAME'));

        //        $users = SJB_DB::query("SELECT `Logo` FROM `users` LIMIT 150000,150000");
        /** @var application uploaded_files copy
        $users = SJB_DB::query("SELECT `file_id` FROM `applications` LIMIT 600000,150000");
        //        var_dump($users);
        SJB_DB::init("127.0.0.1", "tanitv6", "94EErmlx@@!!1", "jobsquare_v6");
        $uploadedFilesInfo = array();
        foreach ($users as $user) {
        if ($user['file_id'] != null) {
        $uploadedFilesInfo[] = array_pop(SJB_DB::query("SELECT * FROM `uploaded_files` WHERE `id` = ?s", $user['file_id']));
        }

        }
        //        var_dump($uploadedFilesInfo);

        SJB_DB::init(SJB_System::getSystemSettings('DBHOST'), SJB_System::getSystemSettings('DBUSER'), SJB_System::getSystemSettings('DBPASSWORD'), SJB_System::getSystemSettings('DBNAME'));

        foreach ($uploadedFilesInfo as $uplFileInfo) {
        $exist = SJB_DB::queryValue("SELECT `sid` FROM `uploaded_files` WHERE `sid` = ?n", $uplFileInfo['sid']);
        var_dump('file_sid' . $exist);
        if ($exist == null) {
        var_dump(SJB_DB::queryExec("INSERT INTO `uploaded_files` (`sid`,`id`,`file_name`,`file_group`,`saved_file_name`,`mime_type`) VALUES (?n,?s,?s,?s,?s,?s)",$uplFileInfo['sid'],$uplFileInfo['id'],$uplFileInfo['file_name'],$uplFileInfo['file_group'],$uplFileInfo['saved_file_name'],$uplFileInfo['mime_type']));
        }

        if (file_exists("files_42/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name']) && !file_exists("files/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name'])) {

        var_dump('cope file');
        //                var_dump($userLogoInfo);
        //                    exit;
        copy("files_42/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name'], "files/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name']);
        //                    var_dump($listing['sid']);
        } else {
        var_dump('file exist');
        }

        }
         */

        /** @var applications
        $listings = SJB_DB::query("SELECT `sid` FROM `listings` WHERE `listing_type_sid` != 7 LIMIT 23000,1000");
        //        var_dump($listings);
        SJB_DB::init("127.0.0.1", "tanitv6", "94EErmlx@@!!1", "jobsquare_v6");
        //        exit;
        //        var_dump(SJB_DB::query("SELECT * FROM `listings`"));
        $applications42 = array();
        foreach ($listings as $listing) {
        //            var_dump($listing);
        $applications = SJB_DB::query("SELECT * FROM `applications` WHERE `listing_id` = ?n", $listing['sid']);
        $applications42 = array_merge($applications42,$applications);
        }
        //        var_dump($applications42);
        SJB_DB::init(SJB_System::getSystemSettings('DBHOST'), SJB_System::getSystemSettings('DBUSER'), SJB_System::getSystemSettings('DBPASSWORD'), SJB_System::getSystemSettings('DBNAME'));
        foreach ($applications42 as $application) {
        //            var_dump($application['id']);
        $exist = SJB_DB::queryValue("SELECT `id` FROM `applications` WHERE `id` = ?n", $application['id']);
        if ($exist == null) {
        var_dump(SJB_DB::queryExec("INSERT INTO `applications` (`id`, `listing_id`, `jobseeker_id`, `comments`, `date`, `resume`, `file`, `mime_type`, `file_id`, `username`, `email`) VALUES (?n, ?n,?n,?s,?s,?s,?s,?s,?s,?s,?s)", $application['id'], $application['listing_id'],$application['jobseeker_id'],$application['comments'],$application['date'],$application['resume'],$application['file'],$application['mime_type'],$application['file_id'],$application['username'],$application['email']));


        }
        }
         */


        /** @var users
        //        $listings = SJB_DB::query("SELECT DISTINCT `user_sid` FROM `listings` ORDER BY `listings`.`user_sid` ASC LIMIT 50000,10000");
        //        var_dump($listings);
        SJB_DB::init("127.0.0.1", "tanitv6", "94EErmlx@@!!1", "jobsquare_v6");
        //        exit;
        //        var_dump(SJB_DB::query("SELECT * FROM `listings`"));
        $usersInfo42 = SJB_DB::query("SELECT * FROM `users` ORDER BY `sid` ASC LIMIT 400000,50000 ");
        $usersInfo50 = array();
        //        var_dump($usersInfo42);
        foreach ($usersInfo42 as $userInfo42) {

        //            var_dump($userInfo42);

        $usersInfo50[$userInfo42['sid']] = $userInfo42;
        $usersInfo50[$userInfo42['sid']]['FullName'] = $userInfo42['FirstName'] . ' ' . $userInfo42['LastName'];
        $usersInfo50[$userInfo42['sid']]['Location_City'] = $userInfo42['City'] . ' ' . $userInfo42['Address'];
        $usersInfo50[$userInfo42['sid']]['Phone'] = $userInfo42['PhoneNumber'];
        $usersInfo50[$userInfo42['sid']]['Location_Country'] = $userInfo42['Country'];
        $usersInfo50[$userInfo42['sid']]['username'] = $userInfo42['email'];


        }
        //        var_dump($usersInfo50);exit;
        SJB_DB::init(SJB_System::getSystemSettings('DBHOST'), SJB_System::getSystemSettings('DBUSER'), SJB_System::getSystemSettings('DBPASSWORD'), SJB_System::getSystemSettings('DBNAME'));

        //        exit;
        foreach ($usersInfo50 as $userInfo50) {
        if (!SJB_UserManager::isUserExistsByUserSid($userInfo50['sid'])) {

        $result = SJB_DB::query("INSERT INTO `users` (`sid`,`username`,`password`,`email`,`user_group_sid`,`registration_date`,`active`,`featured`,`reference_uid`,`Location_Country`,`Location_City`,`CompanyName`,`FullName`,`WebSite`,`CompanyDescription`,`Logo`,`Phone`,`Gouvernorat`,`birth`,`Gender`,`Secteur`,`CounterCvAccess`,`CommercialRegister`,`PrivateSpace`) VALUES
        (?n, ?s, ?s, ?s, ?n, ?s, ?n, ?n, ?s, ?s, ?s, ?s ,?s , ?s , ?s ,?s ,?s,?s,?s,?s,?s,?n,?s,?s)", $userInfo50['sid'], $userInfo50['username'],$userInfo50['password'],$userInfo50['email'],$userInfo50['user_group_sid'],$userInfo50['registration_date'],$userInfo50['active'],$userInfo50['featured'],$userInfo50['reference_uid'],$userInfo50['Location_Country'],$userInfo50['Location_City'],$userInfo50['CompanyName'],$userInfo50['FullName'],$userInfo50['WebSite'],$userInfo50['CompanyDescription'],$userInfo50['Logo'],$userInfo50['Phone'],$userInfo50['Gouvernorat'],$userInfo50['birth'],$userInfo50['Gender'],$userInfo50['Secteur'],$userInfo50['CounterCvAccess'],$userInfo50['CommercialRegister'],$userInfo50['PrivateSpace']);
        var_dump($result);
        if ($result != true) {
        var_dump('result FALSE');
        var_dump($userInfo50);
        }
        //
        } else {
        var_dump('user exist');
        }
        }
         */
        /** @var users uploaded_files copy
        $users = SJB_DB::query("SELECT `Logo` FROM `users` LIMIT 400000,100000");
        //        var_dump($users);
        SJB_DB::init("127.0.0.1", "tanitv6", "94EErmlx@@!!1", "jobsquare_v6");
        $uploadedFilesInfo = array();
        foreach ($users as $user) {
        if ($user['Logo'] != null) {
        $uploadedFilesInfo[] = array_pop(SJB_DB::query("SELECT * FROM `uploaded_files` WHERE `id` = ?s", $user['Logo']));
        }

        }
        //                var_dump($uploadedFilesInfo);
        //exit;
        SJB_DB::init(SJB_System::getSystemSettings('DBHOST'), SJB_System::getSystemSettings('DBUSER'), SJB_System::getSystemSettings('DBPASSWORD'), SJB_System::getSystemSettings('DBNAME'));

        foreach ($uploadedFilesInfo as $uplFileInfo) {
        $exist = SJB_DB::queryValue("SELECT `id` FROM `uploaded_files` WHERE `id` = ?s", $uplFileInfo['id']);
        var_dump('id file' . $exist);
        //            var_dump(empty($exist));

        if (empty($exist)) {
        var_dump(SJB_DB::query("INSERT INTO `uploaded_files` (`sid`,`id`,`file_name`,`file_group`,`saved_file_name`,`mime_type`) VALUES (?n,?s,?s,?s,?s,?s)",$uplFileInfo['sid'],$uplFileInfo['id'],$uplFileInfo['file_name'],$uplFileInfo['file_group'],$uplFileInfo['saved_file_name'],$uplFileInfo['mime_type']));
        }

        if (file_exists("files_42/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name']) && !file_exists("files/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name'])) {

        var_dump('cope file');
        //                var_dump($userLogoInfo);
        //                    exit;
        copy("files_42/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name'], "files/" . $uplFileInfo['file_group'] . "/" . $uplFileInfo['saved_file_name']);
        //                    var_dump($listing['sid']);
        } else {
        var_dump('file exist');
        }

        }
         */


        /** @var  $files
        $listings = SJB_DB::query("SELECT `sid`,`user_sid`,`subuser_sid` FROM `listings` WHERE `listing_type_sid` != 7 AND `creation_date` >= '2017-01-01 00:00:00' ORDER BY `listings`.`user_sid` ASC LIMIT 23000,1000");

        foreach ( $listings as $listing) {

        if (!empty($listing['subuser_sid'])) {
        $logo_id = SJB_DB::queryValue("SELECT `Logo` FROM `users` WHERE `sid` = ?n", $listing['subuser_sid']);
        } else {
        $logo_id = SJB_DB::queryValue("SELECT `Logo` FROM `users` WHERE `sid` = ?n", $listing['user_sid']);
        }
        //            var_dump($logo_id);
        if (!empty($logo_id)) {
        $userLogoInfo = array_pop(SJB_DB::query("SELECT `id`,`file_group`,`saved_file_name` FROM `uploaded_files` WHERE `id` = ?s", $logo_id));
        var_dump($userLogoInfo);
        if (file_exists("files_42/" . $userLogoInfo['file_group'] . "/" . $userLogoInfo['saved_file_name']) && !file_exists("files/" . $userLogoInfo['file_group'] . "/" . $userLogoInfo['saved_file_name'])) {

        var_dump('exist');
        var_dump($userLogoInfo);
        //                    exit;
        copy("files_42/" . $userLogoInfo['file_group'] . "/" . $userLogoInfo['saved_file_name'], "files/" . $userLogoInfo['file_group'] . "/" . $userLogoInfo['saved_file_name']);
        //                    var_dump($listing['sid']);
        }
        }

        $applications = SJB_DB::query("SELECT * FROM `applications` WHERE `listing_id` = ?n", $listing['sid']);
        //            var_dump(count($applications));
        foreach ($applications as $application) {
        //                var_dump($application['file_id']);
        if (!empty($application['file_id'])) {
        $applicationInfo = array_pop(SJB_DB::query("SELECT `id`,`file_group`,`saved_file_name` FROM `uploaded_files` WHERE `id` = ?s", $application['file_id']));
        //                    var_dump($applicationInfo);
        //                    var_dump($applicationInfo['saved_file_name']);
        if (file_exists("files_42/" . $applicationInfo['file_group'] . "/" . $applicationInfo['saved_file_name']) && !file_exists("files/" . $applicationInfo['file_group'] . "/" . $applicationInfo['saved_file_name'])) {
        var_dump($applicationInfo['saved_file_name']);
        var_dump( 'exist');
        copy("files_42/" . $applicationInfo['file_group'] . "/" . $applicationInfo['saved_file_name'], "files/" . $applicationInfo['file_group'] . "/" . $applicationInfo['saved_file_name']);
        }
        //                    break;
        }
        }


        }



        echo '</pre>';
        exit;
         */
        set_time_limit(0);
        $i18n = SJB_I18N::getInstance();
        $this->lang = $i18n->getLanguageData($i18n->getCurrentLanguage());
        $this->currentDate = strftime($this->lang['date_format'], time());

        $this->tp = SJB_System::getTemplateProcessor();

        if ((time() - SJB_Settings::getSettingByName('task_scheduler_last_executed_time_hourly')) > 3600) {
            $this->runHourlyTaskScheduler();
            SJB_Settings::updateSetting('task_scheduler_last_executed_time_hourly', time());
        }
	
//        if ((time() - SJB_Settings::getSettingByName('task_scheduler_last_executed_time_daily')) > 86400) {
            $this->runDailyTaskScheduler();
			
//            SJB_Settings::updateSetting('task_scheduler_last_executed_time_daily', time());
//        }
//        if (in_array($_SERVER['REMOTE_ADDR'], array('158.181.248.74'))) {
//            $this->runDailyTaskScheduler();
//        }

        $this->runTaskScheduler();
    }

    private function runDailyTaskScheduler()
    {
        $guestsNotifiedEmails = $this->sendGuestsAlerts();
        $this->tp->assign('notified_guests_emails', $guestsNotifiedEmails);
    }

    private function runHourlyTaskScheduler()
    {
    }

    private function runTaskScheduler()
    {
		
        // Deactivate Expired Listings & Send Notifications
        $listingsExpiredID = SJB_ListingManager::getExpiredListingsSID();
	
        foreach ($listingsExpiredID as $listingExpiredID) {
            SJB_ListingManager::deactivateListingBySID($listingExpiredID, true);
			SJB_Breadcrumbs::deleteBreadcrumbsByListingTypeSID($listingExpiredID);
			 $listing = SJB_ListingManager::getObjectBySID($listingExpiredID);
            $listingInfo = SJB_ListingManager::createTemplateStructureForListing($listing);
            SJB_Notifications::sendUserListingExpiredLetter($listingInfo);
        }
	
        $listingsDeactivatedID = [];
        if (SJB_Settings::getSettingByName('automatically_delete_expired_listings')) {
            $listingsDeactivatedID = SJB_ListingManager::getDeactivatedListingsSID();
            foreach ($listingsDeactivatedID as $listingID) {
                SJB_ListingManager::deleteListingBySID($listingID);
            }
        }

        SJB_Cache::getInstance()->clean('matchingAnyTag', [SJB_Cache::TAG_LISTINGS]);

        // Send Notifications for Expired Contracts
        $expiredContracts = SJB_ContractManager::getExpiredContractsID();
        foreach ($expiredContracts as $key => $expiredContract) {
            $contract = new SJB_Contract(['contract_id' => $expiredContract]);
            if ($contract->isRecurring() && !$contract->isCanceled()) {
                $gateway = SJB_PaymentGatewayManager::getObjectByID($contract->getGatewayId());
                $invoice = SJB_InvoiceManager::getObjectBySID($contract->getInvoiceId());
                if ($gateway && $invoice && $invoice->getPropertyValue('recurring_id')) {
                    $invoice->setSID(null);
                    $invoice->setDate(null);
                    $invoice->setStatus(SJB_Invoice::INVOICE_STATUS_PENDING);

                    $items = $invoice->getPropertyValue('items');
                    $startDate = $contract->expired_date;
                    $date = new DateTime($startDate);
                    $date->modify('+1 ' . $contract->extra_info['billing_cycle']);
                    $contract->expired_date = $date->format('Y-m-d');
                    $items['names'] = [1 => $invoice->getProductNames() . sprintf(' (%s - %s)', SJB_TemplateProcessor::date($startDate), SJB_TemplateProcessor::date($contract->expired_date))];

                    $invoice->setPropertyValue('items', $items);
                    SJB_InvoiceManager::saveInvoice($invoice);
                    $invoice = SJB_InvoiceManager::getObjectBySID($invoice->getSID());
                    if ($gateway->charge($invoice)) {
                        $contract->saveInDB();
                        SJB_InvoiceManager::markPaidInvoiceBySID($invoice->getSID(), $contract);
                        unset($expiredContracts[$key]);
                        continue;
                    }
                }
                if ($invoice) {
                    SJB_Notifications::sendUserRecurringContractExpiredLetter($contract, $invoice);
                }
            } else {
                SJB_Notifications::sendUserContractExpiredLetter($contract);
            }
            SJB_ContractManager::deleteContract($expiredContract);
        }

        // LISTING XML IMPORT
        SJB_XmlImport::runImport();

        // UPDATE PAGES WITH FUNCTION EQUAL BROWSE(e.g. /browse-by-city/)
        SJB_BrowseDBManager::rebuildBrowses();

        //-------------------sitemap generator--------------------//
        SJB_System::executeFunction('miscellaneous', 'sitemap_generator');
        if ((time() - SJB_Settings::getSettingByName('task_scheduler_last_executed_time_daily')) > 86400) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://www.google.com/ping?sitemap=https://www.jobsquare.ma/sitemap.xml',
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            SJB_Settings::updateSetting('task_scheduler_last_executed_time_daily', time());
        }

//        var_dump($resp);

        if (in_array($_SERVER['REMOTE_ADDR'], array('158.181.248.74'))) {
            echo '<pre>';
            var_dump(count($listingsExpiredID));
            var_dump(count($listingsDeactivatedID));
            var_dump(count($expiredContracts));
            var_dump(count($this->notifiedJobAlerts));

            echo '</pre>';
//            $listingsDeactivatedID[] = 4444444;
//            $listingsExpiredID[] = 77777777;
//            $expiredContracts[] = 44444444;
//            $this->notifiedJobAlerts[] = 'test@sjb.com';

        }

        $now = SJB_DateType::mysqlNow();
        $this->tp->assign('expired_listings_id', $listingsExpiredID);
        $this->tp->assign('deactivated_listings_id', $listingsDeactivatedID);
        $this->tp->assign('expired_contracts_id', $expiredContracts);
        $this->tp->assign('notifiedJobAlerts', $this->notifiedJobAlerts);

        $schedulerLog = $this->tp->fetch('task_scheduler_log.tpl');


//        if (count($listingsDeactivatedID) > 0 && count($listingsExpiredID) > 0 && count($expiredContracts) > 0 && count($this->notifiedJobAlerts) > 0) {
            SJB_DB::query('INSERT INTO `task_scheduler_log`
			(`last_executed_date`, `notifieds_sent`, `expired_listings`, `expired_contracts`, `log_text`)
			VALUES ( ?s, ?n, ?n, ?n, ?s)',
                $now, count($this->notifiedJobAlerts), count($listingsExpiredID), count($expiredContracts), $schedulerLog);
//        }

        SJB_System::getModuleManager()->executeFunction('classifieds', 'linkedin');
        SJB_System::getModuleManager()->executeFunction('classifieds', 'facebook');

        SJB_ProductsManager::cleanup();

        if (SJB_H::isSaas()) {
            SJB_Settings::updateCustomDomainRedirect();

            file_put_contents(SJB_BASE_DIR . 'robots.txt', join("\n", [
                'User-agent: *',
                'Disallow: /files/files/',
                'Sitemap: ' . SJB_H::getCustomDomainUrl() . '/sitemap.xml',
                '',
                'User-agent: YandexBot',
                'Disallow: /files/files/',
                'Crawl-delay: 5',
            ]));
        }

        SJB_Event::dispatch('task_scheduler_run');
    }

    public function sendGuestsAlerts()
    {
		
        $guestEmailsNotified = [];
        $notificationsLimit = (int)SJB_Settings::getSettingByName('num_of_listings_sent_in_email_alerts');

        $listing = new SJB_Listing();
        $listing->addActivationDateProperty();
        $aliasInfoID = $listing->addIDProperty();
        $userNameAliasInfo = $listing->addUsernameProperty();
        $listingTypeIDInfo = $listing->addListingTypeIDProperty();
        $aliases = new SJB_PropertyAliases();
        $aliases->addAlias($aliasInfoID);
        $aliases->addAlias($userNameAliasInfo);
        $aliases->addAlias($listingTypeIDInfo);

        $guestAlertsToNotify = SJB_GuestAlertManager::getGuestAlertsToNotify();
        if (in_array($_SERVER['REMOTE_ADDR'], array('158.181.248.74'))) {
            echo '<pre>';
            var_dump($guestAlertsToNotify);
            echo '</pre>';

        }
		
        foreach ($guestAlertsToNotify as $guestAlertInfo) {
            $dataSearch = @unserialize($guestAlertInfo['data']);
            if (!$dataSearch) {
                SJB_Error::getInstance()->addWarning('Failed to unserialize guest alert', [
                    'alert_info' => $guestAlertInfo
                ]);
                continue;
            }
            $dataSearch['active']['equal'] = 1;
            if (!empty($guestAlertInfo['last_send'])) {
                $dateArr = explode(' ', $guestAlertInfo['last_send']);
                $dateArr = explode('-', $dateArr[0]);
                $guestAlertInfo['last_send'] = strftime($this->lang['date_format'], mktime(0, 0, 0, $dateArr[1], $dateArr[2], $dateArr[0]));
                $dataSearch['activation_date']['not_less'] = $guestAlertInfo['last_send'];
            }
            $dataSearch['activation_date']['not_more'] = $this->currentDate;
            $listingTypeSID = 0;
            if ($dataSearch['listing_type']['equal']) {
                $listingTypeID = $dataSearch['listing_type']['equal'];
                $listingTypeSID = SJB_ListingTypeManager::getListingTypeSIDByID($listingTypeID);
            }

            $criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($dataSearch, $listing);
			
            $searcher = new SJB_ListingSearcher();
            $searcher->found_object_sids = [];
            $searcher->setLimit($notificationsLimit);
            $listingsIDsFound = $searcher->getObjectsSIDsByCriteria($criteria, $aliases);
			
//            if (in_array($_SERVER['REMOTE_ADDR'], array('158.181.248.74'))) {
//                echo '<pre>';
//                var_dump($dataSearch);
//                var_dump($guestAlertInfo);
//                var_dump($listingsIDsFound);
//                echo '</pre>';
//                array_push($guestEmailsNotified, $guestAlertInfo['email']);
//                $this->notifiedJobAlerts[] = $guestAlertInfo['sid'];
//            } else {
	
            SJB_GuestAlertManager::markGuestAlertAsSentBySID($guestAlertInfo['sid']);
                if (count($listingsIDsFound)) {
                    $sentGuestAlertNewListingsFoundLetter = SJB_Notifications::sendGuestAlertNewListingsFoundLetter($listingsIDsFound, $guestAlertInfo, $listingTypeSID);
                    if ($sentGuestAlertNewListingsFoundLetter) {
//                        SJB_GuestAlertManager::markGuestAlertAsSentBySID($guestAlertInfo['sid']);
                        array_push($guestEmailsNotified, $guestAlertInfo['email']);
                        $this->notifiedJobAlerts[] = $guestAlertInfo['sid'];
                    }
                }
//            }
        }
		
        return $guestEmailsNotified;
    }
	
	}
