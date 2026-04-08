<?php
class SJB_Applications_View extends SJB_Function
{
    private $pages;
    private $totalPages;
    private $currentPage;

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $appsPerPage = 20;
        $this->currentPage = SJB_Request::getVar('page', 1);
        $currentUser = SJB_UserManager::getCurrentUser();
        $appJobId = SJB_Request::getVar('appJobId', false, null, 'int');
        $displayTemplate = 'view.tpl';
        $errors = [];

        // Check for file download requests first
        $filename = SJB_Request::getVar('filename', false);
        if ($filename) {
            $appsID = SJB_Request::getVar('appsID', false);
            if ($appsID) {
                $file = SJB_UploadFileManager::openApplicationFile2($filename, $appsID);
                if (!$file) {
                    $errors['NO_SUCH_FILE'] = true;
                }
            } elseif (SJB_Request::getVar('listing_id')) {
                $file = SJB_UploadFileManager::openFile($filename, SJB_Request::getVar('listing_id'));
                if (!$file) {
                    $errors['NO_SUCH_FILE'] = true;
                }
            } else {
                $errors['NO_SUCH_APPS'] = true;
            }
        }

        // Check for AJAX filter requests
        $action2 = "filter_applications";
        $contact_action=SJB_Request::getVar('contact_action');
               // Check for AJAX filter requests
        $action2 = "filter_applications";
        $contact_action=SJB_Request::getVar('contact_action');
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($contact_action === "contact") {
                $this->handleContactCandidate($currentUser);
                exit;
            } elseif ($action2) {
                $this->handleAjaxFilterRequest($currentUser, $appJobId);
                exit;
            }
        }
        // AJAX filter request handler
        
        

    // 👇 New contact handler
        


        // Check for export requests
        $exportAction = SJB_Request::getVar('export_action');
        

        if ($exportAction === 'csv') {
            $filters = $_GET; 
            $this->handleExportCsv($currentUser, $appJobId, $filters);
            exit;
        } else if ($exportAction ==='pdf') {
            $filters = $_GET; 
            $this->handleExportPdf($currentUser, $appJobId, $filters);
            exit;
        }

     

        

        // Check if user is logged in
        if (SJB_UserManager::isUserLoggedIn() === false) {
            $tp->assign('ERROR', 'NOT_LOGIN');
            $tp->display('../miscellaneous/error.tpl');
            return;
        }

        if (!is_numeric($this->currentPage) || $this->currentPage < 1) {
            $this->currentPage = 1;
        }

        if ($currentUser->getUserGroupSID() == SJB_UserGroup::EMPLOYER) {
            $action = SJB_Request::getVar('action');
            if ($action && !SJB_Applications::isAppBelongsTyEmployer(SJB_Request::getVar('id'), $currentUser->getID())) {
                echo SJB_System::executeFunction('miscellaneous', 'function_is_not_accessible');
                return;
            }
            
          

            switch ($action) {
                case 'delete':
                    SJB_Applications::hide(SJB_Request::getVar('id'));
                    echo 'ok';
                    exit();
                    break;
                case 'set_status':
                    SJB_Applications::setStatus(
                        SJB_Request::getVar('id'),
                        SJB_Request::getVar('status'),
                        SJB_Request::getVar('order')
                    );
                    if (!SJB_Session::getValue('set_application_status_' . SJB_Request::getVar('id'))) {
                        SJB_Session::setValue('set_application_status_' . SJB_Request::getVar('id'), true);
                    }
                    break;
                case 'notes':
                    SJB_Applications::setNotes(
                        SJB_Request::getVar('id'),
                        SJB_Request::getVar('notes')
                    );
                    if (!SJB_Session::getValue('set_application_notes_' . SJB_Request::getVar('id'))) {
                        SJB_Session::setValue('set_application_notes_' . SJB_Request::getVar('id'), true);
                    }
                    break;
                case 'contact':
                    if (!SJB_Session::getValue('applicant_contacted_' . SJB_Request::getVar('id'))) {
                        SJB_Session::setValue('applicant_contacted_' . SJB_Request::getVar('id'), true);
                    }

                    $app = SJB_Applications::getBySID(SJB_Request::getVar('id'));
                    $email = new SJB_Email($app['email']);
                    $email->setText('<div style="white-space: pre-line;">' . SJB_Request::getVar('message') . '</div>');
                    $email->setSubject(SJB_Request::getVar('subject'));
                    $email->setReplyTo($currentUser->getPropertyValue('username'));
                    if ($email->send()) {
                        echo 'ok';
                    } else {
                        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                    }
                    exit();
                case 'application_view':
                    if (!SJB_Session::getValue('applicant_viewed_' . SJB_Request::getVar('id'))) {
                        SJB_Session::setValue('applicant_viewed_' . SJB_Request::getVar('id'), true);
                    }
                    SJB_DB::query("UPDATE `applications` SET `deja_vu`= ?s, date_last_vu=?s WHERE `id` = ?s", 1, SJB_DateType::mysqlNow(), SJB_Request::getVar('id'));
                    echo 'ok';
                    exit();
                    break;
            }

            $jobs = SJB_DB::query('select `Title` as `title`, `sid` as `id` from `listings` where `user_sid` = ?n', $currentUser->sid);

            $listingTitle = null;
            foreach ($jobs as $job) {
                if ($job['id'] == $appJobId)
                    $listingTitle = $job['title'];
            }
            if (empty($listingTitle) && SJB_HelperFunctions::isThemeSupportsDND()) {
                echo SJB_System::executeFunction('miscellaneous', '404_not_found');
                return;
            }
            
            // Check permissions for the job offer
            if ($appJobId && !SJB_Applications::isUserOwnsJobApplications($currentUser->getSID(), $appJobId)) {
                $tp->assign('ERROR', 'ACCESS_DENIED');
                $tp->display('../miscellaneous/error.tpl');
                return;
            }
            
            $apps = $this->executeApplicationsForEmployer($appsPerPage, $appJobId, $currentUser);

            if (empty($apps) && $this->currentPage > 1) {
                $this->currentPage = 1;
                $apps = $this->executeApplicationsForEmployer($appsPerPage, $appJobId, $currentUser);
            }

            $this->loadApplicationsData($apps);

                        // Fetch data for filter dropdowns
            $cache = SJB_Cache::getInstance();
$cacheKey = 'filter_options_' . md5($currentUser->getSID());
$filterOptions = $cache->load($cacheKey);

if (!$filterOptions) {
    $gouvernorats = SJB_DB::query("SELECT `sid`, `name` FROM `states` WHERE `country_sid` = 1 AND `display` = 1 ORDER BY `name` ASC");
    $villes = SJB_DB::query("SELECT cities.sid, cities.name, cities.state_sid AS gouvernorat_sid FROM cities ORDER BY cities.name ASC");
    $experience_options = SJB_DB::query("SELECT `sid` as id, `value` as name FROM `listing_field_list` WHERE `field_sid` = 382 ORDER BY `order` ASC");
    $language_options = SJB_DB::query("SELECT `sid` as id, `value` as name FROM `listing_field_list` WHERE `field_sid` = 406 ORDER BY `order` ASC");
    $study_options = SJB_DB::query("SELECT `sid` as id, `value` as name FROM `listing_field_list` WHERE `field_sid` = 361 ORDER BY `order` ASC");
    $contract_types = SJB_DB::query("SELECT `sid`, `value` as name FROM `listing_field_list` WHERE `field_sid` = 199 ORDER BY `order` ASC");
    $job_categories = SJB_DB::query("SELECT `sid`, `value` as name FROM `listing_field_list` WHERE `field_sid` = 198 ORDER BY `order` ASC");
    $filterOptions = [
        'gouvernorats' => $gouvernorats,
        'villes' => $villes,
        'experience_options' => $experience_options,
        'language_options' => $language_options,
        'study_options' => $study_options,
        'contract_types' => $contract_types,
        'job_categories' => $job_categories
    ];
    $cache->save($cacheKey, $filterOptions, 3600); // Cache for 1 hour
}
            // Calculate status counts
            $statuses = [];
            $applicationStatuses = json_decode(SJB_Settings::getValue('application_statuses'), true) ?: [];
            foreach ($applicationStatuses as $status) {
                $statuses[$status['name']] = 0;
            }
            foreach ($apps as $key => $app) {
                $currentAppStatus = $app['status'] ?: 'Unknown';
                if (array_key_exists($currentAppStatus, $statuses)) {
                    $statuses[$currentAppStatus]++;
                } else {
                    $statuses[$currentAppStatus] = 1; // Handle unknown statuses
                }
                $apps[$key]['status'] = $currentAppStatus;
            }

            // Generate year options for filter
            $start_year = 2013;
            $current_year = date('Y');
            $year_options_html = '';
            for ($y = $current_year; $y >= $start_year; $y--) {
                $year_options_html .= "<option value='{$y}'>{$y}</option>";
            }

            $tp->assign('appsPerPage', $appsPerPage);
            $tp->assign('currentPage', $this->currentPage);
            $tp->assign('pages', $this->pages);
            $tp->assign('totalPages', $this->totalPages);
            $tp->assign('appJobs', $jobs);
            $tp->assign('current_filter', $appJobId);
            $tp->assign('listing_title', $listingTitle);
            $tp->assign('appJobId', $appJobId ?? "");
            
            // Assign filter options to template
            $tp->assign('gouvernorats', $filterOptions['gouvernorats']);
$tp->assign('villes', $filterOptions['villes']);
$tp->assign('experience_options', $filterOptions['experience_options']);
$tp->assign('language_options', $filterOptions['language_options']);
$tp->assign('study_options', $filterOptions['study_options']);
$tp->assign('contract_types', $filterOptions['contract_types']);
$tp->assign('job_categories', $filterOptions['job_categories']);
$tp->assign('year_options_html', $year_options_html);

        } else {
            // Job Seeker view
            $apps = SJB_Applications::getByJobseeker($currentUser->sid);
            for ($i = 0; $i < count($apps); ++$i) {
                $apps[$i]['job'] = SJB_ListingManager::getListingInfoBySID($apps[$i]['listing_id']);
                $apps[$i]['company'] = SJB_UserManager::getUserInfoBySID($apps[$i]['job']['user_sid']);
                //nombre de vue par offre postule
                $count_apps = SJB_Applications::getCountAppsByJob($apps[$i]['listing_id']);
                $apps[$i]['candidats'] = $count_apps;
            }
            $displayTemplate = 'view_seeker.tpl';
            
            // Calculate status counts for job seeker view
            $statuses = [];
            $as = json_decode(SJB_Settings::getValue('application_statuses'), true);
            foreach ($as as $status) {
                $statuses[$status['name']] = 0;
            }
            foreach ($apps as $key => $app) {
                foreach ($as as $asItem) {
                    if ($asItem['name'] == $app['status']) {
                        $apps[$key]['status'] = $app['status'] = $asItem['name'];
                    }
                }
                if (!array_key_exists($app['status'], $statuses)) {
                    $apps[$key]['status'] = key($statuses);
                }
                $statuses[$apps[$key]['status']]++;
            }
        }

        if (empty($apps)) {
            $errors['APPLICATIONS_NOT_FOUND'] = true;
        }

        $tp->assign('applications', $apps);
        $tp->assign('errors', $errors);
        $tp->assign('statuses', $statuses);
        $tp->display($displayTemplate);
    }

    private function handleAjaxFilterRequest($currentUser, $appJobIdFromUrl)
{
    $debug_info = [
        'handleAjaxFilterRequest_start' => true,
        'appJobIdFromUrl_in_ajax' => $appJobIdFromUrl,
    ];

    // Récupérer les filtres depuis le corps de la requête POST
    $input = file_get_contents('php://input');
    $filters = [];
    if (!empty($input)) {
        $filters = json_decode($input, true);
        $debug_info['raw_input'] = $input;
        $debug_info['decoded_filters_json'] = $filters;
        $debug_info['json_decode_error'] = json_last_error_msg();

        if (json_last_error() !== JSON_ERROR_NONE) {
            $filters = $_POST;
            $debug_info['fallback_to_post'] = $filters;
        }
    } else {
        $filters = $_POST;
        $debug_info['empty_input_using_post'] = $filters;
    }

    // Get pagination parameters
    $page = isset($filters['page']) ? intval($filters['page']) : 1;
    $perPage = isset($filters['per_page']) ? intval($filters['per_page']) : 20;
    
    // Le appJobId pour la vérification des permissions doit être celui qui est filtré
    $appJobId = isset($filters['appJobId']) ? $filters['appJobId'] : $appJobIdFromUrl;
    $debug_info['final_appJobId_for_permission'] = $appJobId;

    // Valider les permissions pour la requête AJAX
    $hasPermission = SJB_Applications::isUserOwnsJobApplications($currentUser->getID(), $appJobId);
    $debug_info['isUserOwnsJobApplications_result'] = $hasPermission;

    if (!$appJobId || !$hasPermission) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        header('Content-Type: application/json');
        echo json_encode(array_merge($debug_info, [
            'error' => 'Access denied: You do not have permission to filter applications for this job.',
            'success' => false,
            'appJobId_used_for_permission_check' => $appJobId,
            'currentUser_id' => $currentUser->getID(),
            'isUserOwnsJobApplications_result' => $hasPermission
        ]));
        exit;
    }

    try {
        // Obtenir les applications filtrées avec pagination
        $result = $this->getFilteredApplications($currentUser, $appJobId, $filters, $page, $perPage);
        $apps = $result['applications'];
        $totalCount = $result['total_count'];
        $debug_info['applications_count'] = count($apps);

        // Traiter les données des applications
        $this->loadApplicationsData($apps);

        // Calculer les comptes par statut
        $statuses = [];
        $as = json_decode(SJB_Settings::getValue('application_statuses'), true);
        foreach ($as as $status) {
            $statuses[$status['name']] = 0;
        }
        foreach ($apps as $key => $app) {
            $currentAppStatus = $app['status'];
            $foundStatus = false;
            foreach ($as as $asItem) {
                if ($asItem['name'] == $currentAppStatus) {
                    $apps[$key]['status'] = $currentAppStatus;
                    $foundStatus = true;
                    break;
                }
            }
            if (!$foundStatus) {
                $apps[$key]['status'] = !empty($statuses) ? key($statuses) : 'Unknown';
            }
            
            if (array_key_exists($apps[$key]['status'], $statuses)) {
                $statuses[$apps[$key]['status']]++;
            } else {
                $statuses[$apps[$key]['status']] = 1;
            }
        }

        // Envoyer la réponse JSON
        header('Content-Type: application/json');
        echo json_encode(array_merge($debug_info, [
            'success' => true,
            'applications' => $apps,
            'statuses' => $statuses,
            'count' => count($apps),
            'total_count' => $totalCount,
            'current_page' => $page,
            'per_page' => $perPage,
            'total_pages' => ceil($totalCount / $perPage)
        ]));

    } catch (Exception $e) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        header('Content-Type: application/json');
        echo json_encode(array_merge($debug_info, [
            'success' => false,
            'error' => 'Une erreur est survenue lors du filtrage: ' . $e->getMessage()
        ]));
    }
    
    exit;
}

    private function getFilteredApplications($currentUser, $appJobId, $filters, $page = 1, $perPage = 20)
{
    $startRow = ($page - 1) * $perPage;
    $limit = ['startRow' => $startRow, 'countRows' => $perPage];
    $apps = [];
    $totalCount = 0;
    
    if ($appJobId) {
        if (SJB_Applications::isUserOwnsAppsByAppJobId($currentUser->getID(), $appJobId)) {
            $result = SJB_Applications::getFilteredByJob($appJobId, $limit, $filters);
            $apps = $result['applications'];
            $totalCount = $result['total_count'];
        }
    } else {
        $result = SJB_Applications::getFilteredByEmployer($currentUser->getSID(), $limit, $filters);
        $apps = $result['applications'];
        $totalCount = $result['total_count'];
    }
    
    return [
        'applications' => $apps ?: [],
        'total_count' => $totalCount,
        'current_page' => $page,
        'per_page' => $perPage
    ];
}

    private function handleExportCsv($currentUser, $appJobId, $filters)
    {
        $apps = $this->getFilteredApplications($currentUser, $appJobId, $filters);
        $output = fopen('php://output', 'w');

        fputcsv($output, [
            'Date de Candidature', 'Nom du Candidat', 'Email', 'numéro de téléphone ', ' autre numéro de téléphone ', 'Experience', 'Niveau d\'etude', 'Gouvernorat', 'Ville',
            'Genre', 'LinkedIn', 'Facebook', 'Instagram', 'Twitter',
            'GitHub', 'Blog', 'Site Web','Statut','CV',
        ], ';');

        foreach ($apps as $app) {
            $jobInfo = SJB_ListingManager::getListingInfoBySID($app['listing_id']);
            $resumeInfo = null;
            if (isset($app['resume']) && !empty($app['resume'])) {
                $resume = SJB_ListingManager::getObjectBySID($app['resume']);
                if ($resume && $resume->getListingTypeSID() == 7) {
                    $resumeInfo = SJB_ListingManager::createTemplateStructureForListing($resume);
                }
            }

            fputcsv($output, [
                str_pad($app['date'] ?? 'N/A', 25),
                str_pad($app['username'] ?? 'N/A', 30),
                str_pad($app['email'] ?? 'N/A', 40),
                str_pad($resumeInfo['Phone'] ?? 'N/A', 20),
                str_pad($resumeInfo['OtherPhone'] ?? 'N/A', 20),
                str_pad($resumeInfo['Experience'] ?? 'N/A', 20),
                str_pad($resumeInfo['Study'] ?? 'N/A', 20),
                str_pad($resumeInfo['Location_State'] ?? 'N/A', 20),
                str_pad($resumeInfo['Location_City'] ?? 'N/A', 20),
                str_pad($resumeInfo['id_Job_Genre'] ?? 'N/A', 15),
                str_pad($resumeInfo['Linkedin_link'] ?? 'N/A', 40),
                str_pad($resumeInfo['Facebook_link'] ?? 'N/A', 40),
                str_pad($resumeInfo['Instagram_link'] ?? 'N/A', 40),
                str_pad($resumeInfo['Twitter_link'] ?? 'N/A', 40),
                str_pad($resumeInfo['GitHub_link'] ?? 'N/A', 40),
                str_pad($resumeInfo['Blog_link'] ?? 'N/A', 40),
                str_pad($resumeInfo['Website_link'] ?? 'N/A', 40),
                str_pad($app['status'] ?? 'N/A', 20),
                str_pad($app['file'] ?? 'N/A', 30),
            ], ';');
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="candidatures pour l\'offre intitulé :  ' . $jobInfo['Title']. '.csv"');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        fclose($output);
        exit;
    }
    
    private function handleExportPdf($currentUser, $appJobId, $filters)
    {
        $apps = $this->getFilteredApplications($currentUser, $appJobId, $filters);
        $apps = array_slice($apps, 0, 500);
       
        // Create ZIP archive
        $zipFilename = 'resumes_' . date('Y-m-d') . '.zip';
        $tempZipPath = tempnam(sys_get_temp_dir(), 'zip_');
        
        $zip = new ZipArchive();
        if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
            exit('Cannot create ZIP file');
        }

        $filesAdded = false;
        $uploadDir = rtrim(SJB_System::getSystemSettings('UPLOAD_FILES_DIRECTORY'), '/');
        
        foreach ($apps as $index => $app) {
            if (empty($app['file_id'])) {
                continue;
            }
            
            // Get file info by file_id
            $fileInfo = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $app['file_id']);
            $listingInfo = SJB_DB::query("SELECT `date_add` FROM listings WHERE sid=?n", $appJobId);

            if (!$fileInfo) {
                continue;
            }
            
            $fileInfo = array_pop($fileInfo);
            $listingInfo = array_pop($listingInfo);
            $listingDate = strtotime($listingInfo['date_add']);
        
            $year = date('Y', $listingDate);
            $month = date('m', $listingDate);
            $day = date('d', $listingDate);
            
            // Build the file path
            $filePath = $uploadDir . '/applications/' . $year . '/' . $month . '/' . $day . '/' . $appJobId . '/' . $fileInfo['saved_file_name'];
           
            // Create a safe filename
            $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', ($app['username'] ?? 'candidate') . '_' . $index . '_' . $fileInfo['file_name']);
        
            if (file_exists($filePath)) {
                if ($zip->addFile($filePath, $safeName)) {
                    $filesAdded = true;
                }
            }
        }

        $zip->close();

        if (!$filesAdded) {
            unlink($tempZipPath);
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            exit('No resume files found to export');
        }

        // Send ZIP to browser
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
        header('Content-Length: ' . filesize($tempZipPath));
        readfile($tempZipPath);
        
        // Clean up
        unlink($tempZipPath);
        exit;
    }

    private function executeApplicationsForEmployer($appsPerPage, $appJobId, SJB_User $currentUser)
    {
        $limit['countRows'] = $appsPerPage;
        $limit['startRow'] = $this->currentPage * $appsPerPage - ($appsPerPage);
        $apps = [];
        if ($appJobId) {
            if (SJB_Applications::isUserOwnsAppsByAppJobId($currentUser->getID(), $appJobId)) {
                $allAppsCountByJobID = SJB_Applications::getCountAppsByJob($appJobId);
                $this->setPaginationInfo($appsPerPage, $allAppsCountByJobID);
                $apps = SJB_Applications::getByJob($appJobId, $limit);
            }
        } else {
            $allAppsCount = SJB_Applications::getCountApplicationsByEmployer($currentUser->getSID());
            $this->setPaginationInfo($appsPerPage, $allAppsCount);
            $apps = SJB_Applications::getByEmployer($currentUser->getSID(), $limit);
        }
        return $apps;
    }

    private function setPaginationInfo($appsPerPage, $appsCount)
    {
        $this->totalPages = ceil($appsCount / $appsPerPage);
        if (empty($this->totalPages)) {
            $this->totalPages = 1;
        }

        $this->pages = [];
        for ($i = $this->currentPage - 2; $i < $this->currentPage + 3; $i++) {
            if ($i == $this->totalPages) {
                break;
            } else {
                if ($i > 0) {
                    $this->pages[] = $i;
                }
                if ($i * $appsPerPage > $appsCount) {
                    break;
                }
            }
        }

        if (array_search(1, $this->pages) === false) {
            array_unshift($this->pages, 1);
        }
        if (array_search($this->totalPages, $this->pages) === false) {
            array_push($this->pages, $this->totalPages);
        }
    }

    private function batchLoadListings($listingSIDs)
{
    if (empty($listingSIDs)) {
        return [];
    }
    
    // Clean and validate IDs
    $listingSIDs = array_filter($listingSIDs, 'is_numeric');
    $listingSIDs = array_unique($listingSIDs);
    
    if (empty($listingSIDs)) {
        return [];
    }
    
    // Use existing SJB_DB methods to maintain compatibility
    $listings = SJB_DB::query(
        "SELECT * FROM `listings` WHERE `sid` IN (?l)",
        $listingSIDs
    );
    
    $result = [];
    foreach ($listings as $listing) {
        $result[$listing['sid']] = $listing;
    }
    
    return $result;
}

private function batchLoadUsers($userSIDs)
{
    if (empty($userSIDs)) {
        return [];
    }
    
    // Clean and validate IDs
    $userSIDs = array_filter($userSIDs, 'is_numeric');
    $userSIDs = array_unique($userSIDs);
    
    if (empty($userSIDs)) {
        return [];
    }
    
    // Use existing SJB_DB methods
    $users = SJB_DB::query(
        "SELECT * FROM `users` WHERE `sid` IN (?l)",
        $userSIDs
    );
    
    $result = [];
    foreach ($users as $user) {
        $result[$user['sid']] = $user;
    }
    
    return $result;
}
private function loadApplicationsData(&$apps)
{
    if (empty($apps)) {
        return;
    }
    
    // Batch load all listings
    $listingIds = array_column($apps, 'listing_id');
    $listingIds = array_filter($listingIds); // Remove null/empty values
    $listingIds = array_unique($listingIds);
    
    $listings = [];
    if (!empty($listingIds)) {
        $listings = $this->batchLoadListings($listingIds);
    }
    
    // Batch load all resumes
    $resumeIds = array_column($apps, 'resume');
    $resumeIds = array_filter($resumeIds); // Remove null/empty values
    $resumeIds = array_unique($resumeIds);
    
    $resumes = [];
    if (!empty($resumeIds)) {
        $resumes = $this->batchLoadListings($resumeIds);
    }
    
    // Batch load user info for non-anonymous applicants
    $userIds = array_column($apps, 'jobseeker_id');
    $userIds = array_filter($userIds, function($id) {
        return $id != 0; // Exclude anonymous users (jobseeker_id = 0)
    });
    $userIds = array_unique($userIds);
    
    $users = [];
    if (!empty($userIds)) {
        $users = $this->batchLoadUsers($userIds);
    }
    
    // Process all applications with pre-loaded data
    foreach ($apps as $i => &$app) {
        // Load job info from pre-loaded data
        if (isset($listings[$app['listing_id']])) {
            $app['job'] = $listings[$app['listing_id']];
        } else {
            // Fallback to original method if not found in batch
            $app['job'] = SJB_ListingManager::getListingInfoBySID($app['listing_id']);
        }
        
        // Load resume info
    //     $resumeMetadata = SJB_DB::query(
    // "SELECT `sid`, `active`, `Title`, `Location_gouvernorat`, `Location_ville`, `Experience`, `Study` 
    //  FROM `listings` 
    //  WHERE `sid` IN (?l) AND `listing_type_sid` = 7",
    // $resumeIds
    // );
        if (!empty($app['resume'])) {
            if (isset($resumes[$app['resume']])) {
                $resumeData = $resumes[$app['resume']];
                // Only include active resumes
                if ($resumeData['active'] == SJB_Listing::STATUS_ACTIVE) {
                    // Use existing method to maintain structure compatibility
                    $resumeObject = SJB_ListingManager::getObjectBySID($app['resume']);
                    if ($resumeObject) {
                        $app['resumeInfo'] = SJB_ListingManager::createTemplateStructureForListing($resumeObject);
                    } else {
                        $app['resumeInfo'] = null;
                    }
                } else {
                    $app['resumeInfo'] = null;
                }
            } else {
                // Fallback to original method
                $resume = SJB_ListingManager::getObjectBySID($app['resume']);
                if ($resume && $resume->active == SJB_Listing::STATUS_ACTIVE) {
                    $app['resumeInfo'] = SJB_ListingManager::createTemplateStructureForListing($resume);
                } else {
                    $app['resumeInfo'] = null;
                }
            }
        } else {
            $app['resumeInfo'] = null;
        }
        
        // Load user info
        if ($app['jobseeker_id'] == 0) {
            $app['user']['FirstName'] = $app['username'];
        } elseif (isset($users[$app['jobseeker_id']])) {
            $app['user'] = $users[$app['jobseeker_id']];
        } else {
            // Fallback to original method
            $app['user'] = SJB_UserManager::getUserInfoBySID($app['jobseeker_id']);
        }
    }
    unset($app); // Unset reference
}


private function handleContactCandidate($currentUser)
{
    $data = $_POST;
    if (!$data || !isset($data["id"], $data["message"])) {
        header("Content-Type: application/json");
        header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request");
        echo json_encode(["success" => false, "error" => "Données manquantes (ID ou message)"]);
        return;
    }

    $appId = intval($data["id"]);
    $message = strip_tags($data["message"]); // Prevent XSS

    $application = SJB_DB::query("SELECT a.email, a.listing_id, a.username FROM applications a WHERE a.id = ?n", $appId);

    if (empty($application)) {
        header("Content-Type: application/json");
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        echo json_encode(["success" => false, "error" => "Candidature non trouvée"]);
        return;
    }

    $candidateEmail = filter_var($application[0]["email"], FILTER_VALIDATE_EMAIL);
    $listingId = $application[0]["listing_id"];
    $candidateName = $application[0]["username"] ?? "Candidat";

    if (!$candidateEmail) {
        header("Content-Type: application/json");
        header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request");
        echo json_encode(["success" => false, "error" => "Email du candidat invalide"]);
        return;
    }

    $hasPermission = SJB_Applications::isUserOwnsJobApplications($currentUser->getID(), $listingId);

    if (!$hasPermission) {
        header("Content-Type: application/json");
        header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden");
        echo json_encode(["success" => false, "error" => "Accès refusé: Vous n'avez pas la permission de contacter ce candidat."]);
        return;
    }

    try {
        // Fetch listing info for template placeholders
        $listingInfo = SJB_ListingManager::getListingInfoBySID($listingId);
        $listingTitle = $listingInfo["Title"] ?? "Offre d'emploi";

        // Prepare data for the email template
        $emailData = [
            "applicant_request" => [
                "name" => $candidateName,
                "email" => $candidateEmail,
                "message" => $message // Pass the custom message for template use
            ],
            "listing" => [
                "Title" => $listingTitle
            ],
            "user" => [
                "FullName" => $currentUser->getPropertyValue("FirstName") . " " . $currentUser->getPropertyValue("LastName")
            ],
            "GLOBALS" => [
                "settings" => [
                    "site_title" => SJB_Settings::getValue("site_title")
                ]
            ]
        ];

        // Get the email template SID by name
        $templateSID = SJB_EmailTemplateEditor::checkIfEmailTemplateExists('other', 'Contact_message');
        
        if (!$templateSID) {
            header("Content-Type: application/json");
            header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
            echo json_encode(["success" => false, "error" => "Template email 'Contact_message' non trouvé dans la base de données."]);
            return;
        }

        // Get the email object using SJB_EmailTemplateEditor with the SID
        $emailObj = SJB_EmailTemplateEditor::getEmail($candidateEmail, $templateSID, $emailData);
        
        // Set ReplyTo to the current user's email
        $emailObj->setReplyTo($currentUser->getPropertyValue('username'));

        $emailSent = $emailObj->send();

        if ($emailSent) {
            if (!SJB_Session::getValue("applicant_contacted_" . $appId)) {
                SJB_Session::setValue("applicant_contacted_" . $appId, true);
            }
            header("Content-Type: application/json");
            echo json_encode(["success" => true, "message" => "Email envoyé avec succès"]);
        } else {
            header("Content-Type: application/json");
            header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
            echo json_encode(["success" => false, "error" => "Erreur lors de l'envoi de l'email."]);
        }
    } catch (Exception $e) {
        header("Content-Type: application/json");
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
        echo json_encode(["success" => false, "error" => "Erreur interne du serveur: " . $e->getMessage()]);
    }
}
   
    
}

