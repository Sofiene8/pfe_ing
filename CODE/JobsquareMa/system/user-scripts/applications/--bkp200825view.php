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
        $this->currentPage = SJB_Request::getVar("page", 1);
        $currentUser = SJB_UserManager::getCurrentUser();
        $appJobId = SJB_Request::getVar("appJobId", false, null, "int");
        $displayTemplate = "view.tpl";
        $errors = [];

        if (!SJB_UserManager::isUserLoggedIn()) {
            $tp->assign("ERROR", "NOT_LOGIN");
            $tp->display("../miscellaneous/error.tpl");
            return;
        }

        // Handle file downloads (no changes needed here)
        $filename = SJB_Request::getVar("filename", false);
        if ($filename) {
            $appsID = SJB_Request::getVar("appsID", false);
            if ($appsID) {
                $file = SJB_UploadFileManager::openApplicationFile2($filename, $appsID);
                if (!$file) $errors["NO_SUCH_FILE"] = true;
            } elseif (SJB_Request::getVar("listing_id")) {
                $file = SJB_UploadFileManager::openFile($filename, SJB_Request::getVar("listing_id"));
                if (!$file) $errors["NO_SUCH_FILE"] = true;
            } else {
                $errors["NO_SUCH_APPS"] = true;
            }
        }

        if (!is_numeric($this->currentPage) || $this->currentPage < 1) {
            $this->currentPage = 1;
        }

        $tp->assign("appJobId", $appJobId ?? "");
        $action = SJB_Request::getVar("action");
        $action2 = "filter_applications";

        // AJAX filter request handler
        if ($action2  && $_SERVER["REQUEST_METHOD"] === "POST") {
            $this->handleAjaxFilterRequest($currentUser, $appJobId);
            exit; // Stop script execution after sending JSON response
        }

        $exportAction = SJB_Request::getVar('export_action');
        if ($exportAction === 'csv') {
            // On récupère les filtres actuels depuis la session ou les paramètres GET/POST
            // Pour la simplicité, on va supposer que les filtres sont passés en GET pour l'export
            $filters = $_GET; 
            $this->handleExportCsv($currentUser, $appJobId, $filters);
            exit; // Important pour ne pas afficher le reste de la page
        } else if ($exportAction ==='pdf') {
            $filters = $_GET; 
            $this->handleExportPdf($currentUser, $appJobId, $filters);
            exit; // Important pour ne pas afficher le reste de la page


        }

        // Fetch data for filter dropdowns
        $gouvernorats = SJB_DB::query("SELECT `sid`, `name` FROM `states` WHERE `country_sid` = 1 AND `display` = 1 ORDER BY `name` ASC");
        $villes = SJB_DB::query("
    		SELECT cities.sid, cities.name, cities.state_sid AS gouvernorat_sid 
    		FROM cities 
    		ORDER BY cities.name ASC
		");
        
        // Assuming 'Experience' field for resumes is a list type with field_sid = 403
        $experience_options = SJB_DB::query("SELECT `sid` as id, `value` as name FROM `listing_field_list` WHERE `field_sid` = 382 ORDER BY `order` ASC");
        // Assuming 'Languages' field for resumes is a list type with field_sid = 406
        $language_options = SJB_DB::query("SELECT `sid` as id, `value` as name FROM `listing_field_list` WHERE `field_sid` = 406 ORDER BY `order` ASC");
        // Assuming 'Study' field for resumes is a list type with field_sid = 404
        $study_options = SJB_DB::query("SELECT `sid` as id, `value` as name FROM `listing_field_list` WHERE `field_sid` = 361 ORDER BY `order` ASC");

        $contract_types = SJB_DB::query("SELECT `sid`, `value` as name FROM `listing_field_list` WHERE `field_sid` = 199 ORDER BY `order` ASC");
        $job_categories = SJB_DB::query("SELECT `sid`, `value` as name FROM `listing_field_list` WHERE `field_sid` = 198 ORDER BY `order` ASC");

        if ($currentUser->getUserGroupSID() == SJB_UserGroup::EMPLOYER) {
            // Permissions check for actions
            if ($action && in_array($action, ['delete', 'set_status', 'set_viewed_status', 'get_application_info'])) {
                if (!SJB_Applications::isAppBelongsTyEmployer(SJB_Request::getVar('id'), $currentUser->getSID())) {
                    $tp->assign('ERROR', 'ACCESS_DENIED');
                    $tp->display('../miscellaneous/error.tpl');
                    return;
                }
            }

            // Permissions check for the job offer
            if ($appJobId && !SJB_Applications::isUserOwnsJobApplications($currentUser->getSID(), $appJobId)) {
                $tp->assign('ERROR', 'ACCESS_DENIED');
                $tp->display('../miscellaneous/error.tpl');
                return;
            }

            // Initial load with no filters
            $initialFilters = []; 
            $apps = $this->getFilteredApplications($currentUser, $appJobId, $initialFilters);

            // Process applications to add resume and user info
            foreach ($apps as $i => &$app) {
                $app['job'] = SJB_ListingManager::getListingInfoBySID($app['listing_id']);
                if (isset($app['resume']) && !empty($app['resume'])) {
                    $resume = SJB_ListingManager::getObjectBySID($app['resume']);
                    // Ensure the resume is a valid, active listing of type "Resume" (sid=7)
                    if ($resume && $resume->active == SJB_Listing::STATUS_ACTIVE && $resume->getListingTypeSID() == 7) {
                        $app['resumeInfo'] = SJB_ListingManager::createTemplateStructureForListing($resume);
                        // Explicitly add properties for filtering/sorting
                        $app['Experience'] = $resume->getPropertyValue('Experience');
                        $app['Gouvernorat'] = $resume->getPropertyValue('Location_gouvernorat');
                        $app['Ville'] = $resume->getPropertyValue('Location_ville');
                        $app['Langue'] = $resume->getPropertyValue('id_Job_Langue');
                        $app['Etude'] = $resume->getPropertyValue('id_Job_Niveaudtude');
                    } else {
                        $app['resumeInfo'] = null;
                    }
                }
                $app['user'] = SJB_UserManager::getUserInfoBySID($app['jobseeker_id']) ?: ['FirstName' => $app['username']];
            }
            unset($app);


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

            // Get employer's jobs for the dropdown
            $jobs = SJB_DB::query('SELECT `Title` as `title`, `sid` as `id` FROM `listings` WHERE `user_sid` = ?n', $currentUser->getSID());
            $listingTitle = null;
            foreach ($jobs as $job) {
                if ($job['id'] == $appJobId) $listingTitle = $job['title'];
            }

            $tp->assign('appJobs', $jobs);
            $tp->assign('current_filter', $appJobId);
            $tp->assign('listing_title', $listingTitle);

        } else { // Job Seeker view
            $apps = SJB_Applications::getByJobseeker($currentUser->getSID());
            foreach ($apps as $i => $app) {
                $apps[$i]['job'] = SJB_ListingManager::getListingInfoBySID($apps[$i]['listing_id']);
                $apps[$i]['company'] = SJB_UserManager::getUserInfoBySID($apps[$i]['job']['user_sid']);
                $apps[$i]['candidats'] = SJB_Applications::getCountAppsByJob($apps[$i]['listing_id']);
            }
            $displayTemplate = 'view_seeker.tpl';
        }

        $start_year = 2013;
$current_year = date('Y');
$year_options_html = ''; // On initialise une chaîne vide

for ($y = $current_year; $y >= $start_year; $y--) {
    // On concatène chaque <option> à notre chaîne HTML
    $year_options_html .= "<option value='{$y}'>{$y}</option>";
}

// On passe cette chaîne HTML complète au template


        if (empty($apps)) $errors['APPLICATIONS_NOT_FOUND'] = true;
$tp->assign('year_options_html', $year_options_html);
        // Final template assignments
        $tp->assign('applications', $apps);
        $tp->assign('errors', $errors);
        $tp->assign('statuses', $statuses);
        $tp->assign('gouvernorats', $gouvernorats);
        $tp->assign('villes', $villes);
        $tp->assign('experience_options', $experience_options);
        $tp->assign('language_options', $language_options);
        $tp->assign('study_options', $study_options);
        $tp->assign('contract_types', $contract_types);
        $tp->assign('job_categories', $job_categories);
        $tp->display($displayTemplate);
    }

     private function handleAjaxFilterRequest($currentUser, $appJobIdFromUrl, $debug_info_from_execute = [])
    {
        // *** DEBUGGING OUTPUT ***
        $debug_info = array_merge($debug_info_from_execute, [
            'handleAjaxFilterRequest_start' => true,
            'appJobIdFromUrl_in_ajax' => $appJobIdFromUrl,
        ]);
        // **********************

        // Récupérer les filtres depuis le corps de la requête POST
        $input = file_get_contents('php://input');
        $filters = [];
        if (!empty($input)) {
            $filters = json_decode($input, true);
            $debug_info['raw_input'] = $input;
            $debug_info['decoded_filters_json'] = $filters;
            $debug_info['json_decode_error'] = json_last_error_msg();

            if (json_last_error() !== JSON_ERROR_NONE) {
                $filters = $_POST; // Fallback si le JSON est invalide
                $debug_info['fallback_to_post'] = $filters;
            }
        } else {
            $filters = $_POST;
            $debug_info['empty_input_using_post'] = $filters;
        }

        // Le appJobId pour la vérification des permissions doit être celui qui est filtré
        // Il peut venir de l'URL (appJobIdFromUrl) ou du corps de la requête (filters['appJobId'])
        // Priorisons celui du corps de la requête si présent, sinon celui de l'URL
        $appJobId = isset($filters['appJobId']) ? $filters['appJobId'] : $appJobIdFromUrl;
        $debug_info['final_appJobId_for_permission'] = $appJobId;

        // Valider les permissions pour la requête AJAX
        $hasPermission = SJB_Applications::isUserOwnsJobApplications($currentUser->getID(), $appJobId);
        $debug_info['isUserOwnsJobApplications_result'] = $hasPermission;

        if (!$appJobId || !$hasPermission) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            header('Content-Type: application/json'); // Assurez-vous que le Content-Type est JSON
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
            // Obtenir les applications filtrées
            $apps = $this->getFilteredApplications($currentUser, $appJobId, $filters);
            $debug_info['applications_count'] = count($apps);

            // Traiter les données des applications
            foreach ($apps as $i => $app) {
                $apps[$i]['job'] = SJB_ListingManager::getListingInfoBySID($apps[$i]['listing_id']);
                if (isset($apps[$i]['resume']) && !empty($apps[$i]['resume'])) {
                    $resume = SJB_ListingManager::getObjectBySID($apps[$i]['resume']);
                    if ($resume && $resume->active == SJB_Listing::STATUS_ACTIVE) {
                        $apps[$i]['resumeInfo'] = SJB_ListingManager::createTemplateStructureForListing($resume);
                    } else {
                        $apps[$i]['resumeInfo'] = null;
                    }
                }
                if ($apps[$i]['jobseeker_id'] == 0) {
                    $apps[$i]['user']['FirstName'] = $apps[$i]['username'];
                } else {
                    $apps[$i]['user'] = SJB_UserManager::getUserInfoBySID($apps[$i]['jobseeker_id']);
                }
            }

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
                'count' => count($apps)
            ]));

        } catch (Exception $e) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
            header('Content-Type: application/json'); // Assurez-vous que le Content-Type est JSON
            echo json_encode(array_merge($debug_info, [
                'success' => false,
                'error' => 'Une erreur est survenue lors du filtrage: ' . $e->getMessage()
            ]));
        }
        
        // Terminer le script après avoir envoyé la réponse
        exit;
    }

    private function getFilteredApplications($currentUser, $appJobId, $filters)
    {
        $limit = null; // No pagination on filtered results for now
        $apps = [];
        
        if ($appJobId) {
            // Filter applications for a specific job
            if (SJB_Applications::isUserOwnsAppsByAppJobId($currentUser->getID(), $appJobId)) {
                $apps = SJB_Applications::getFilteredByJob($appJobId, $limit, $filters);
            }
        } else {
            // Filter all applications for the employer
            $apps = SJB_Applications::getFilteredByEmployer($currentUser->getSID(), $limit, $filters);
        }
        
        return $apps ?: [];
    }

    // Dans la classe SJB_Applications_View
private function handleExportCsv($currentUser, $appJobId, $filters)
    {
        $apps = $this->getFilteredApplications($currentUser, $appJobId, $filters);
                $output = fopen('php://output', 'w');

        fputcsv($output, [
            'Date de Candidature', 'Nom du Candidat', 'Email', 'numéro de téléphone ', ' autre numéro de téléphone ', 'Experience', 'Niveau d\'etude', 'Gouvernorat', 'Ville'
			, 'Genre', 'LinkedIn', 'Facebook', 'Instagram', 'Twitter',
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
    
    $apps = array_slice($apps, 0, 300);
   
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
            //error_log("Skipping application $index: No file_id specified");
      
            continue;
        }
        
        // Get file info by file_id
        $fileInfo = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $app['file_id']);
        $listingInfo=SJB_DB::query("SELECT `date_add` FROM listings WHERE sid=?n",$appJobId);

		
        if (!$fileInfo) {
            error_log("No file info found for file_id: {$app['file_id']}");
         
            continue;
        }
        
        $fileInfo = array_pop($fileInfo);
        $listingInfo = array_pop($listingInfo);
        // Use creation_time from uploaded_files for path
        $listingDate = strtotime($listingInfo['date_add']);
    
    // Build the correct file path using the listing date
    	$year = date('Y', $listingDate);
    	$month = date('m', $listingDate);
    	$day = date('d', $listingDate);
       
        
        // Build the file path
        $filePath = $uploadDir . '/applications/' . $year . '/' . $month . '/' . $day . '/' . $appJobId . '/' . $fileInfo['saved_file_name'];
       
		
        // Create a safe filename
        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', ($app['username'] ?? 'candidate') . '_' . $index . '_' . $fileInfo['file_name']);
    
        
        if (!file_exists($filePath)) {
            error_log("File not found at path: $filePath");
      
            continue;
        }
        
        // Add file to ZIP
        if ($zip->addFile($filePath, $safeName)) {
            $filesAdded = true;
         
        } else {
            error_log("Failed to add file to ZIP: $filePath");
            
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
}