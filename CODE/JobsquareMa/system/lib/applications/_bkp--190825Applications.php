<?php

class SJB_Applications
{
    const APPLICATION_SETTINGS_TYPE_EMAIL = 1;
    const APPLICATION_SETTINGS_TYPE_URL   = 2;

    /**
     * @param $listingID
     * @param bool $limit deprecated since SL-333 + DND
     * @return array|null
     */
	public static function getByJob($listingID, $limit = false)
	{
        $limitFilter = '';
        if (!empty($limit)) {
            $limitFilter = " LIMIT {$limit['startRow']}, {$limit['countRows']}";
        }
        $order = '`a`.`order` ASC';
        if (!SJB_H::isThemeSupportsDND()) {
            $order = '`a`.`id` DESC';
        }
		return SJB_DB::query('
            SELECT `a`.*
            FROM `applications` `a`
                INNER JOIN `listings` l ON
                    `l`.`sid` = `a`.`listing_id`
                    WHERE `a`.`listing_id` = ?s AND `a`.`hidden` = 0 ORDER BY ' . $order . $limitFilter, $listingID);
	}

	public static function getCountAppsByJob($listingID)
	{
		$appsCount = SJB_DB::queryValue("
		SELECT
			COUNT(`a`.`listing_id`)
		FROM
			`applications` `a`
		INNER JOIN `listings` l ON
			`l`.`sid` = `a`.`listing_id`
		WHERE `a`.`listing_id` = ?s AND `a`.`hidden` = 0", $listingID);

		return $appsCount;
	}

    public static function getByJobseeker($id)
    {
        return SJB_DB::query('
            select a.* from `applications` a 
            where a.`jobseeker_id` = ?s order by `a`.`date` desc', $id);
    }

    /**
     * @deprecated since SL-333 + DND
     * @param $userSID
     * @param bool $limit
     * @return array|null
     */
	public static function getByEmployer($userSID, $limit = false)
	{
        $limitFilter = '';
        if (!empty($limit)) {
            $limitFilter = "LIMIT {$limit['startRow']}, {$limit['countRows']}";
        }

		return SJB_DB::query('
			SELECT `a`.*
			FROM
				`applications` `a`
			INNER JOIN `listings` l ON
				`l`.`sid` = `a`.`listing_id`
			WHERE `l`.`user_sid` = ?s and `a`.`hidden` = 0 ORDER BY `a`.`id` DESC ' . $limitFilter, $userSID);
	}

	public static function getCountApplicationsByEmployer($userSID)
	{
		$appsCount = SJB_DB::queryValue("
			SELECT COUNT(`a`.`listing_id`)
			FROM
				`applications` `a`
			INNER JOIN `listings` l ON
				`l`.`sid` = `a`.`listing_id`
			WHERE `l`.`user_sid` = ?s AND `a`.`hidden` = 0", $userSID);
		return $appsCount;
	}

	public static function getBySID($sid)
	{
		$apps = SJB_DB::query('
			SELECT `a`.* FROM `applications` a
			WHERE a.`id` = ?n', $sid);
        if ($apps) {
            $apps = current($apps);
        }
		return $apps;
	}

    public static function getAppGroupsByEmployer($companyId)
    {
        return SJB_DB::query('
            select a.listing_id, count(*) as `count` from `applications` a
            inner join `listings` l on
                 `l`.`sid` = `a`.`listing_id`
            where `user_sid` = ?s and a.hidden = 0 GROUP BY `a`.`listing_id`', $companyId);
    }

    /**
     * Is user applied to job posting
     *
     * @param int $listing_id
     * @param int $jobseeker_id
     * @return bool
     */
    public static function isApplied($listing_id, $jobseeker_id)
    {
        if (!$jobseeker_id)
            return false;

        return count(SJB_DB::query("select * from applications where listing_id = ?s and jobseeker_id = ?s", $listing_id, $jobseeker_id)) > 0;
    }

    /**
     * Is user applied to job posting
     *
     * @param int $listing_id
     * @param int $email
     * @return bool
     */
    public static function isAppliedGuest($listing_id, $email)
    {
        return count(SJB_DB::query('select id from applications where listing_id = ?s and email = ?s and jobseeker_id = 0 limit 1', $listing_id, $email)) > 0;
    }

	public static function isListingAppliedForCompany($listing_id, $company_id)
    {
        return count(SJB_DB::query("
            SELECT a.id FROM `applications` a
            INNER JOIN `listings` l ON l.sid = a.`listing_id`
            WHERE l.user_sid = ?s AND a.resume = ?s", $company_id, $listing_id)) > 0;
    }

    /**
     * Check if user owns applications By AppJobId
     *
     * @param int $user_sid
     * @param int $app_job_id
     * @return int
     */
	public static function isUserOwnsAppsByAppJobId($user_sid, $app_job_id)
    {
        return count(SJB_DB::query("
            SELECT a. * , l.user_sid FROM `applications` a
            INNER JOIN `listings` l ON l.sid = a.`listing_id`
            WHERE l.user_sid = ?n AND a.listing_id = ?n", $user_sid, $app_job_id)) > 0;
    }

    /**
     * Creates new application
     *
     * @param int $listing_id
     * @param int $jobseeker_id
     * @param int|string $resume
     * @param $comments
     * @param $file
     * @param $file_sid
     * @param bool $post
     * @return array|bool
     */
	public static function create($listing_id, $jobseeker_id, $resume, $comments, $file, $file_sid,$mimeType, $post = false)
    {
        if (SJB_Applications::isApplied($listing_id, $jobseeker_id) && !is_null($jobseeker_id))
            return false;
   
       
	   $file_id = '';
        if ($file_sid != '') {
            $file_id = SJB_DB::queryValue("SELECT `id` FROM `uploaded_files` WHERE `sid` = ?s", $file_sid);
        }

        $jobSeekerName  = $post['name'];
        $jobSeekerEmail = $post['email'];
        $status = json_decode(SJB_Settings::getValue('application_statuses'), true);
        if (is_array($status)) {
            $status = current($status)['name'];
        }
	
		   $res = SJB_DB::query("
            insert into applications(`listing_id`, `jobseeker_id`, `comments`, `date`, `resume`, `file`, `username`, `email`, `file_id`, `order`, `status`)
            values(?s, ?s, ?s, ?s, ?n, ?s, ?s, ?s, ?s, ?s, ?s)", $listing_id, $jobseeker_id ? $jobseeker_id : 0, $comments, SJB_DateType::mysqlNow(), $resume, $file, $jobSeekerName, $jobSeekerEmail, $file_id, time()*-1, $status);
       
	   return !empty($res);
    }

	public static function remove($id)
    {
        $fileID = SJB_DB::queryValue("SELECT `file_id` FROM `applications` WHERE `id` = ?s", $id);
        if (!empty($fileID)) {
            SJB_UploadFileManager::deleteUploadedFileByID($fileID);
        }
        SJB_DB::query("delete from applications where id = ?s", $id);
    }

    /**
     * Gets an Application Email from Application Settings
     *
     * @param int $listing_id
     * @return string
     */
	public static function getApplicationEmailbyListingId($listing_id)
    {
    	$application_email = SJB_DB::queryValue("SELECT `value` FROM `listings_properties` WHERE `object_sid` = ?n AND `id` = ?s AND `add_parameter` = ?n AND `value` <> ''", $listing_id, 'ApplicationSettings', 1);
		if ($application_email)
			return $application_email;
		return '';
    }

    public static function getApplicationsInfo()
    {
        $res = [];

        // условие запроса сформируем в зависимости от требуемого периода
        $today = SJB_DateType::mysqlToday();
        $periods = [
            'Today' => "`a`.`date` >= '{$today}'",
            'Last 7 days' => "`a`.`date` >= date_sub('{$today}', interval 7 day)",
            'Last 30 days' => "`a`.`date` >= date_sub('{$today}', interval 30 day)",
            'Total' => '1=1',
        ];

        foreach ($periods as $period => $where) {
            $res[$period] = SJB_DB::queryValue('
                select count(*)
                from `applications` a
                where ' . $where);
        }
        return $res;
    }

    public static function hide($id)
    {
        return SJB_DB::query('update `applications` set `hidden` = 1 where `id` = ?n', $id);
    }

    public static function isAppBelongsTyEmployer($app, $user)
    {
        return (bool) SJB_DB::query('select `a`.`id` from `applications` a
            inner join listings l on l.sid = a.listing_id and l.user_sid = ?n
            where `a`.id = ?n', $user, $app);
    }

    public static function setStatus($app, $status, $order)
    {
        $app = self::getBySID($app);
        if (!$app) {
            return false;
        }
        foreach (json_decode(SJB_Settings::getValue('application_statuses'), true) as $item) {
            if ($item['name'] == $status) {
                $status = $item['name'];
            }
        }
        SJB_DB::query('set @o = 0');
        SJB_DB::query('update applications set `order` = (@o := @o+1)
          where listing_id = ?n and `status` = ?s order by `order` asc', $app['listing_id'], $status);
        SJB_DB::query('update applications set `status` = ?s, `order` = ?f where id = ?n', $status, $order - 0.5, $app['id']);
    }

    public static function removeByListing($listing)
    {
        $applications = SJB_DB::query('select `id`, `file_id` from `applications` where `listing_id` = ?n', $listing);
        foreach ($applications as $application) {
            if ($application['file_id']) {
                SJB_UploadFileManager::deleteUploadedFileByID($application['file_id']);
            }
        }
        SJB_DB::query('delete from `applications` where `listing_id` = ?n', $listing);
    }

    public static function setNotes($app, $notes)
    {
        SJB_DB::query('update `applications` set `notes` = ?s where `id` = ?n', $notes, $app);
    }
}
