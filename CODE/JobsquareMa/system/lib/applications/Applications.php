<?php
class SJB_Applications
{
      const APPLICATION_SETTINGS_TYPE_EMAIL = 1;
    const APPLICATION_SETTINGS_TYPE_URL   = 2;

    public static function getByJob($listingID, $limit = false)
    {
        $limitFilter = !empty($limit) ? " LIMIT {$limit['startRow']}, {$limit['countRows']}" : '';
        $order = '`a`.`order` ASC';
        if (!SJB_H::isThemeSupportsDND()) $order = '`a`.`id` DESC';
        return SJB_DB::query('SELECT `a`.* FROM `applications` `a` INNER JOIN `listings` l ON `l`.`sid` = `a`.`listing_id` WHERE `a`.`listing_id` = ?s AND `a`.`hidden` = 0 ORDER BY ' . $order . $limitFilter, $listingID);
    }

    public static function getCountAppsByJob($listingID)
    {
        return SJB_DB::queryValue("SELECT COUNT(`a`.`listing_id`) FROM `applications` `a` INNER JOIN `listings` l ON `l`.`sid` = `a`.`listing_id` WHERE `a`.`listing_id` = ?s AND `a`.`hidden` = 0", $listingID);
    }

    public static function getByJobseeker($id)
    {
        return SJB_DB::query('select a.* from `applications` a where a.`jobseeker_id` = ?s order by `a`.`date` desc', $id);
    }

    public static function getByEmployer($userSID, $limit = false)
    {
        $limitFilter = !empty($limit) ? "LIMIT {$limit['startRow']}, {$limit['countRows']}" : '';
        return SJB_DB::query('SELECT `a`.* FROM `applications` `a` INNER JOIN `listings` l ON `l`.`sid` = `a`.`listing_id` WHERE `l`.`user_sid` = ?s and `a`.`hidden` = 0 ORDER BY `a`.`id` DESC ' . $limitFilter, $userSID);
    }

    public static function getCountApplicationsByEmployer($userSID)
    {
        return SJB_DB::queryValue("SELECT COUNT(`a`.`listing_id`) FROM `applications` `a` INNER JOIN `listings` l ON `l`.`sid` = `a`.`listing_id` WHERE `l`.`user_sid` = ?s AND `a`.`hidden` = 0", $userSID);
    }

    public static function getBySID($sid)
    {
        $apps = SJB_DB::query('SELECT `a`.* FROM `applications` a WHERE a.`id` = ?n', $sid);
        return $apps ? current($apps) : [];
    }

    public static function getAppGroupsByEmployer($companyId)
    {
        return SJB_DB::query('select a.listing_id, count(*) as `count` from `applications` a inner join `listings` l on `l`.`sid` = `a`.`listing_id` where `user_sid` = ?s and a.hidden = 0 GROUP BY `a`.`listing_id`', $companyId);
    }

    public static function isApplied($listing_id, $jobseeker_id)
    {
        if (!$jobseeker_id) return false;
        return count(SJB_DB::query("select * from applications where listing_id = ?s and jobseeker_id = ?s", $listing_id, $jobseeker_id)) > 0;
    }

    public static function isAppliedGuest($listing_id, $email)
    {
        return count(SJB_DB::query('select id from applications where listing_id = ?s and email = ?s and jobseeker_id = 0 limit 1', $listing_id, $email)) > 0;
    }

    public static function isListingAppliedForCompany($listing_id, $company_id)
    {
        return count(SJB_DB::query("SELECT a.id FROM `applications` a INNER JOIN `listings` l ON l.sid = a.`listing_id` WHERE l.user_sid = ?s AND a.resume = ?s", $company_id, $listing_id)) > 0;
    }

    public static function isUserOwnsAppsByAppJobId($user_sid, $app_job_id)
    {
        return count(SJB_DB::query("SELECT a.* , l.user_sid FROM `applications` a INNER JOIN `listings` l ON l.sid = a.`listing_id` WHERE l.user_sid = ?n AND a.listing_id = ?n", $user_sid, $app_job_id)) > 0;
    }

    public static function create($listing_id, $jobseeker_id, $resume, $comments, $file, $file_sid, $mimeType, $post = false, $phone='')
    {
        if (SJB_Applications::isApplied($listing_id, $jobseeker_id) && !is_null($jobseeker_id)) return false;
        $file_id = $file_sid ? SJB_DB::queryValue("SELECT `id` FROM `uploaded_files` WHERE `sid` = ?s", $file_sid) : '';
        $jobSeekerName = $post['name'];
        $jobSeekerEmail = $post['email'];
        $status = json_decode(SJB_Settings::getValue('application_statuses'), true);
        $status = is_array($status) ? current($status)['name'] : '';
        if ($phone === '' && !empty($post['phone'])) {
            $phone = $post['phone'];
        }
       
        $res = SJB_DB::query("insert into applications(`listing_id`, `jobseeker_id`, `comments`, `date`, `resume`, `file`, `username`, `email`, `file_id`, `order`, `status`,`Phone`) values(?s, ?s, ?s, ?s, ?n, ?s, ?s, ?s, ?s, ?s, ?s, ?s)", $listing_id, $jobseeker_id ? $jobseeker_id : 0, $comments, SJB_DateType::mysqlNow(), $resume, $file, $jobSeekerName, $jobSeekerEmail, $file_id, time()*-1, $status,$phone);
        return !empty($res);
    }

    public static function remove($id)
    {
        $fileID = SJB_DB::queryValue("SELECT `file_id` FROM `applications` WHERE `id` = ?s", $id);
        if (!empty($fileID)) SJB_UploadFileManager::deleteUploadedFileByID($fileID);
        SJB_DB::query("delete from applications where id = ?s", $id);
    }

    public static function getApplicationEmailbyListingId($listing_id)
    {
        $application_email = SJB_DB::queryValue("SELECT `value` FROM `listings_properties` WHERE `object_sid` = ?n AND `id` = ?s AND `add_parameter` = ?n AND `value` <> ''", $listing_id, 'ApplicationSettings', 1);
        return $application_email ?: '';
    }

    public static function getApplicationsInfo()
    {
        $today = SJB_DateType::mysqlToday();
        $periods = [
            'Today' => "`a`.`date` >= '{$today}'",
            'Last 7 days' => "`a`.`date` >= date_sub('{$today}', interval 7 day)",
            'Last 30 days' => "`a`.`date` >= date_sub('{$today}', interval 30 day)",
            'Total' => '1=1',
        ];
        $res = [];
        foreach ($periods as $period => $where) {
            $res[$period] = SJB_DB::queryValue('select count(*) from `applications` a where ' . $where);
        }
        return $res;
    }

    public static function hide($id)
    {
        return SJB_DB::query('update `applications` set `hidden` = 1 where `id` = ?n', $id);
    }

    public static function isAppBelongsTyEmployer($app, $user)
    {
        return (bool) SJB_DB::query('select `a`.`id` from `applications` a inner join listings l on l.sid = a.listing_id and l.user_sid = ?n where `a`.id = ?n', $user, $app);
    }

    public static function setStatus($app, $status, $order)
    {
        $app = self::getBySID($app);
        if (!$app) return false;
        foreach (json_decode(SJB_Settings::getValue('application_statuses'), true) as $item) if ($item['name'] == $status) $status = $item['name'];
        SJB_DB::query('set @o = 0');
        SJB_DB::query('update applications set `order` = (@o := @o+1) where listing_id = ?n and `status` = ?s order by `order` asc', $app['listing_id'], $status);
        SJB_DB::query('update applications set `status` = ?s, `order` = ?f where id = ?n', $status, $order - 0.5, $app['id']);
    }

    public static function removeByListing($listing)
    {
        $applications = SJB_DB::query('select `id`, `file_id` from `applications` where `listing_id` = ?n', $listing);
        foreach ($applications as $application) if ($application['file_id']) SJB_UploadFileManager::deleteUploadedFileByID($application['file_id']);
        SJB_DB::query('delete from `applications` where `listing_id` = ?n', $listing);
    }

    public static function setNotes($app, $notes)
    {
        SJB_DB::query('update `applications` set `notes` = ?s where `id` = ?n', $notes, $app);
    }



    public static function getFilteredByJob($listingID, $limit = null, $filters = [])
{
    try {
        $conditions = ["`a`.`listing_id` = ?n", "`a`.`hidden` = ?n"];
        $params = [$listingID, 0];
        
        self::addFilterConditions($conditions, $params, $filters);
        
        $order = "`a`.`order` ASC";
        if (!SJB_H::isThemeSupportsDND()) {
            $order = "`a`.`id` DESC";
        }
        
        // Get total count for pagination
        $countQuery = "
            SELECT COUNT(`a`.`id`) 
            FROM `applications` `a` 
            INNER JOIN `listings` `l` ON `l`.`sid` = `a`.`listing_id`
            LEFT JOIN `listings` `resume_listing` ON `a`.`resume` = `resume_listing`.`sid` AND `resume_listing`.`listing_type_sid` = 7
            WHERE " . implode(" AND ", $conditions);
        
        $totalCount = SJB_DB::queryValue($countQuery, ...$params);
        
        // Get paginated results
        $limitFilter = self::buildLimitFilter($limit);
        $applications = self::fetchFilteredApplications($conditions, $params, $order, $limitFilter);
        
        return [
            'applications' => $applications,
            'total_count' => $totalCount
        ];
        
    } catch (Exception $e) {
        error_log("Filter error in getFilteredByJob: " . $e->getMessage());
        return ['applications' => [], 'total_count' => 0];
    }
}

    public static function getFilteredByEmployer($userSID, $limit = null, $filters = [])
{
    try {
        $conditions = ["`l`.`user_sid` = ?n", "`a`.`hidden` = ?n"];
        $params = [$userSID, 0];
        
        self::addFilterConditions($conditions, $params, $filters);
        
        $order = "`a`.`id` DESC";
        
        // Get total count for pagination
        $countQuery = "
            SELECT COUNT(`a`.`id`) 
            FROM `applications` `a` 
            INNER JOIN `listings` `l` ON `l`.`sid` = `a`.`listing_id`
            LEFT JOIN `listings` `resume_listing` ON `a`.`resume` = `resume_listing`.`sid` AND `resume_listing`.`listing_type_sid` = 7
            WHERE " . implode(" AND ", $conditions);
        
        $totalCount = SJB_DB::queryValue($countQuery, ...$params);
        
        // Get paginated results
        $limitFilter = self::buildLimitFilter($limit);
        $applications = self::fetchFilteredApplications($conditions, $params, $order, $limitFilter);
        
        return [
            'applications' => $applications,
            'total_count' => $totalCount
        ];
        
    } catch (Exception $e) {
        error_log("Filter error in getFilteredByEmployer: " . $e->getMessage());
        return ['applications' => [], 'total_count' => 0];
    }
}

    private static function fetchFilteredApplications($conditions, $params, $order, $limitFilter)
    {
        // MODIFIED: Added LEFT JOIN to get resume properties for filtering
        $query = "
            SELECT `a`.* 
            FROM `applications` `a` 
            INNER JOIN `listings` `l` ON `l`.`sid` = `a`.`listing_id`
            LEFT JOIN `listings` `resume_listing` ON `a`.`resume` = `resume_listing`.`sid` AND `resume_listing`.`listing_type_sid` = 7
            WHERE " . implode(" AND ", $conditions);
            
        $query .= " ORDER BY " . $order . " " . $limitFilter;
        
        return SJB_DB::query($query, ...$params);
    }

    private static function buildLimitFilter($limit)
    {
        return $limit ? "LIMIT {$limit['startRow']}, {$limit['countRows']}" : '';
    }

    private static function addFilterConditions(&$conditions, &$params, $filters)
    {
        // Search (name, email, keywords)
        if (!empty($filters['search'])) {
            $conditions[] = "(LOWER(`a`.`username`) LIKE LOWER(?s) OR LOWER(`a`.`email`) LIKE LOWER(?s) OR LOWER(`resume_listing`.`keywords`) LIKE LOWER(?s))";
            $searchParam = "%" . $filters['search'] . "%";
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }
        
        // Status
        if (!empty($filters['status'])) {
            $conditions[] = "`a`.`status` = ?s";
            $params[] = $filters['status'];
        }
        
        // Date
if (!empty($filters['date_month']) || !empty($filters['date_year'])) {
    // Default year = current year if not provided
    $year = !empty($filters['date_year']) ? intval($filters['date_year']) : date('Y');
    $month = intval($filters['date_month']);

    if (!empty($filters['date_month']) && !empty($filters['date_year'])) {
        // Filter by year AND month
        $conditions[] = "(YEAR(a.date) = ?n AND MONTH(a.date) = ?n)";
        $params[] = $year;
        $params[] = $month;
    } elseif (!empty($filters['date_month'])) {
        // Only month selected → current year automatically
        $conditions[] = "(YEAR(a.date) = ?n AND MONTH(a.date) = ?n)";
        $params[] = $year;
        $params[] = $month;
    } elseif (!empty($filters['date_year'])) {
        // Only year selected
        $conditions[] = "YEAR(a.date) = ?n";
        $params[] = $year;
    }
}
        
        // Email
        if (!empty($filters['email'])) {
            $conditions[] = "LOWER(`a`.`email`) LIKE LOWER(?s)";
            $params[] = "%" . $filters['email'] . "%";
        }

        // Viewed Status
        if (isset($filters['viewedStatus']) && $filters['viewedStatus'] !== '') {
            if ($filters['viewedStatus'] === 'viewed') {
                $conditions[] = "`a`.`deja_vu` = 1";
            } elseif ($filters['viewedStatus'] === 'unviewed') {
                $conditions[] = "`a`.`deja_vu` = 0";
            }
        }

        // ** NEW FILTERS on resume_listing **
        // Gouvernorat (assuming it's stored in resume listing property 'Location_gouvernorat')
        if (!empty($filters['gouvernorat'])) {
        // La valeur stockée est le SID, donc la comparaison est directe.
        $conditions[] = "`resume_listing`.`Location_gouvernorat` = ?s";
        $params[] = $filters['gouvernorat'];
    }

    // Filtre Ville
    if (!empty($filters['ville'])) {
		if ($filters['ville'] !== 'autre') {
		   $conditions[] = "`resume_listing`.`Location_ville` = ?s";
        	$params[] = $filters['ville'];
		}
        // La valeur stockée est le SID, donc la comparaison est directe.
     
    }

    // Filtre Expérience
    if (!empty($filters['experience'])) {
        // La valeur stockée est le SID de l'option d'expérience.
        $conditions[] = "`resume_listing`.`Experience` = ?s";
        $params[] = $filters['experience'];
    }

    // Filtre Niveau d'étude
    if (!empty($filters['study'])) {
        // La valeur stockée est le SID de l'option d'étude.
        $conditions[] = "`resume_listing`.`Study` = ?s";
        $params[] = $filters['study'];
    }

    // Filtre Langue
    if (!empty($filters['language'])) {
        // La valeur stockée est une liste de SIDs séparés par des virgules.
        // FIND_IN_SET est la fonction parfaite pour cela.
        $conditions[] = "FIND_IN_SET(?s, `resume_listing`.`id_Job_Langue`)";
        $params[] = $filters['language'];
    }
        
        // LinkedIn Profile
        if (isset($filters['linkedin']) && $filters['linkedin'] !== '') {
            if ($filters['linkedin'] == '1') {
                $conditions[] = "(`resume_listing`.`Linkedin_link` IS NOT NULL AND `resume_listing`.`Linkedin_link` != '')";
            } elseif ($filters['linkedin'] == '0') {
                $conditions[] = "(`resume_listing`.`Linkedin_link` IS NULL OR `resume_listing`.`Linkedin_link` = '')";
            }
        }
        if (!empty($filters['contractType'])) {
        // Note : Ce filtre s'applique à l'offre d'emploi (`l`), pas au CV du candidat.
        $conditions[] = "`l`.`EmploymentType` = ?s";
        $params[] = $filters['contractType'];
    }

    // Filtre par Secteur d'Activité (JobCategory)
    if (!empty($filters['jobCategory'])) {
        // Note : Ce filtre s'applique à l'offre d'emploi (`l`), pas au CV du candidat.
        $conditions[] = "`l`.`JobCategory` = ?s";
        $params[] = $filters['jobCategory'];
    }

    // Filtre par Genre
    if (!empty($filters['gender'])) {
        // La colonne `id_Job_Genre` est sur le CV (`resume_listing`)
        $conditions[] = "`resume_listing`.`id_Job_Genre` = ?s";
        $params[] = $filters['gender'];
    }

    // Filtres pour la présence de liens (réseaux sociaux, etc.)
    // On vérifie que le champ n'est NI NULL, NI une chaîne vide.
    if (isset($filters['has_facebook']) && $filters['has_facebook'] == '1') {
        $conditions[] = "(`resume_listing`.`Facebook_link` IS NOT NULL AND `resume_listing`.`Facebook_link` != '')";
    }
    if (isset($filters['has_instagram']) && $filters['has_instagram'] == '1') {
        $conditions[] = "(`resume_listing`.`Instagram_link` IS NOT NULL AND `resume_listing`.`Instagram_link` != '')";
    }
    if (isset($filters['has_twitter']) && $filters['has_twitter'] == '1') {
        $conditions[] = "(`resume_listing`.`Twitter_link` IS NOT NULL AND `resume_listing`.`Twitter_link` != '')";
    }
    if (isset($filters['has_github']) && $filters['has_github'] == '1') {
        $conditions[] = "(`resume_listing`.`GitHub_link` IS NOT NULL AND `resume_listing`.`GitHub_link` != '')";
    }
    if (isset($filters['has_blog']) && $filters['has_blog'] == '1') {
        $conditions[] = "(`resume_listing`.`Blog_link` IS NOT NULL AND `resume_listing`.`Blog_link` != '')";
    }
    if (isset($filters['has_website']) && $filters['has_website'] == '1') {
        $conditions[] = "(`resume_listing`.`Website_link` IS NOT NULL AND `resume_listing`.`Website_link` != '')";
    }
    }

    public static function isUserOwnsJobApplications($userSid, $appJobId)
    {
        if (!is_numeric($appJobId) || !is_numeric($userSid)) return false;
        $result = SJB_DB::queryValue("SELECT COUNT(*) FROM `listings` WHERE `sid` = ?n AND `user_sid` = ?n", $appJobId, $userSid);
        return $result > 0;
    }
}