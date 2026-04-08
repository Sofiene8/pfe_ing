<?php

class SJB_Admin_Miscellaneous_Migrate extends SJB_Function
{
	private $from;

	public function execute()
	{
		if (SJB_Request::getVar('download')) {
			header("Content-type: application/octet-stream");
			header("Content-disposition: attachment; filename=migrate.php");
			header("Content-Length: " . filesize(__DIR__ . '/migrate_src.php'));
			readfile(__DIR__ . '/migrate_src.php');
			exit();
		}
		
		// Don't hesitate php, but don't forget about apache timeouts
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
		ini_set('allow_url_fopen', 1);

		$tp = SJB_System::getTemplateProcessor();
		$step = SJB_Request::getVar('step', '0');
		$errors = array();
		$this->from = SJB_Request::getVar('from');

		switch ($step) {
			case '0':
				break;

			// Selecting fields for import
			case '1':
				step1:
				if (strpos($this->from, 'http') !== 0) {
					$this->from = 'http://' . $this->from;
				}
				if (strpos($this->from, 'migrate.php') === false) {
					$this->from = rtrim($this->from, '/') . '/migrate.php';
				}
				if ($this->from) {
					try {
						// allow migration only from 4.2
						$settings = $this->php('
							return include SJB_BASE_DIR . "system/admin-config/DefaultSettings.php";
						');
						if ($settings['version']['major'] != 4 || $settings['version']['minor'] != 2) {
							throw new Exception('Migration only available from SJB version 4.2');
						}

						$extraFields = $this->getRemoteFields();

						$commonFields = SJB_ListingFieldManager::getListingFieldsInfoByListingType(0);
						$existingFields = array(
							'6' => array_merge($commonFields, SJB_ListingFieldManager::getListingFieldsInfoByListingType(6)),
							'7' => array_merge($commonFields, SJB_ListingFieldManager::getListingFieldsInfoByListingType(7))
						);
						$excludeFields = array(
							'screening_questionnaire',
							'expiration_date',
							'access_type',
							'anonymous',
							'Resume',
							'JobDescription',
							'ApplicationSettings',
							'Title',

							'SalaryType',
							'DesiredSalaryType',
							'JobRequirements',
							'Objective'
						);

						foreach ($extraFields as $type => $fields) {
							foreach ($fields as $key => $field) {
								foreach ($existingFields[$type] as $existingField) {
									$exclude = $existingField['id'] == $field['id'] || in_array($field['id'], $excludeFields);
									$exclude |= in_array($field['type'], ['video', 'complex', 'location']);
									if ($exclude) {
										unset($extraFields[$type][$key]);
									}
								}
							}
						}

						$tp->assign('extra_fields', $extraFields);
						$step = '2';
					} catch (Exception $ex) {
						$step = 0;
						$errors[] = 'Unable to connect';
						break;
					}
				}
				break;

			// Import
			case '3':
				try {
					$extraFields = SJB_Request::getVar('import_field', []);

					$remoteFields = $this->getRemoteFields();

					// Sync and prepare extra fields
					$lm = new SJB_ListingFieldListItemManager();
					foreach ($extraFields as $type => $fields) {
						foreach ($fields as $key => $field) {
							foreach ($remoteFields[$type] as $remoteField) {
								if ($remoteField['id'] == $field) {
									$remoteField['from_field'] = $remoteField['id'];
									$remoteField['id'] = 'id_' . ($type == '6' ? 'Job' : 'Resume') . '_' . $remoteField['id'];
									$existingField = SJB_ListingFieldManager::getListingFieldSIDByID($remoteField['id']);
									if ($existingField) {
										SJB_ListingFieldManager::deleteListingFieldBySID($existingField);
									}
									$listingField = $remoteField;
									$listingField['sid'] = null;
									$listingField['order'] = null;
									switch ($listingField['type']) {
										case 'tree':
											$listingField['type'] = 'multilist';
											break;
										case 'monetary':
										case 'geo':
											$listingField['type'] = 'string';
											break;
									}

									$listingField = new SJB_ListingField($listingField, $type);
									$pages = SJB_PostingPagesManager::getPagesByListingTypeSID($type);
									SJB_ListingFieldManager::saveListingField($listingField, $pages);

									if ($remoteField['type'] == 'tree') {
										$addedItems = [];
										$remoteField['map'] = [];
										foreach ($remoteField['tree_values'] as $node) {
											foreach ($node as $item) {
												if (in_array($item['caption'], array_keys($addedItems))) { // skip duplicates
													$remoteField['map'][$item['sid']] = $addedItems[$item['caption']];
													continue;
												}
												if (empty($item['parent_sid']) || !empty($remoteField['tree_values'][$item['sid']])) { // nodes with leaves
													continue;
												}
												$list_item = new SJB_ListItem();
												$list_item->setFieldSID($listingField->getSID());
												$list_item->setValue($item['caption']);
												$sid = $lm->saveListItem($list_item);

												$addedItems[$item['caption']] = $sid;
												$remoteField['map'][$item['sid']] = $sid;
											}
										}
									} elseif (in_array($remoteField['type'], array('list', 'multilist'))) {
										$remoteField['map'] = [];
										foreach ($remoteField['list_values'] as $item) {
											$list_item = new SJB_ListItem();
											$list_item->setFieldSID($listingField->getSID());
											$list_item->setValue($item['caption']);
											$sid = $lm->saveListItem($list_item);
											$remoteField['map'][$item['id']] = $sid;
										}
									}

									$extraFields[$type][$field] = $remoteField;
									unset($extraFields[$type][$key]);
								}
							}
						}
					}

					// sync categories and employment type
					foreach ($remoteFields as $key => $type) {
						foreach ($type as $remoteField) {
							if (in_array($remoteField['sid'], [198, 199])) { // merge categories and employment types
								$currentField = SJB_ListingFieldDBManager::getListingFieldInfoBySID($remoteField['sid']);
								$remoteField['from_field'] = $remoteField['id'];
								$remoteField['map'] = [];
								foreach ($remoteField['list_values'] as $remoteValue) {
									foreach ($currentField['list_values'] as $value) {
										if ($remoteValue['caption'] == $value['caption']) {
											$remoteField['map'][$remoteValue['id']] = $value['id'];
											break;
										}
									}
									if (empty($remoteField['map'][$remoteValue['id']])) {
										$list_item = new SJB_ListItem();
										$list_item->setFieldSID($remoteField['sid']);
										$list_item->setValue($remoteValue['caption']);
										$sid = $lm->saveListItem($list_item);
										$remoteField['map'][$remoteValue['id']] = $sid;
									}
								}
								$extraFields[$key][$remoteField['id']] = $remoteField;
							}
						}
					}

					SJB_DB::query('truncate table listings');
					SJB_DB::query('truncate table listings_properties');
					$count = $this->query('select count(*) from listings where listing_type_sid in (7, 6)');
					$count = array_pop($count);
					$count = intval(array_pop($count));
					for ($i = 0; $i < $count; $i+=200) {
						$rows = $this->query(sprintf('select sid from listings where listing_type_sid in (7, 6) order by sid limit %s, %s', $i, 200));
						$sids = [];
						foreach($rows as $row) {
							$sids[] = $row['sid'];
						}
						$remoteListings = $this->php(sprintf('
						$listingsInfo = array();
						foreach (array(%s) as $sid) {
							$listingInfo = SJB_ListingManager::getListingInfoBySID($sid);
							
							// ignore listings from other user groups
							$userInfo = SJB_DB::query("select user_group_sid, username from users where sid = " . $listingInfo["user_sid"]);
							if (empty($userInfo)) {
								continue;
							}
							$userInfo = $userInfo[0];
							if (!in_array($userInfo["user_group_sid"], array(36, 41))) {
								continue;
							}
							
							// skip jobg8
							if (stripos($userInfo["username"], "jobg8") !== false) {
								continue;
							}
							
							// ignore preview listngs
							if (!empty($listingInfo["preview"])) {
								continue;
							}
							if ($listingInfo["Location_ZipCode"] && $listingInfo["Location_Country"]) {
								$location = SJB_DB::query("select longitude, latitude from locations where country_sid = ?n and name = ?s limit 1", $listingInfo["Location_Country"], $listingInfo["Location_ZipCode"]);
								if ($location) {
									$location = array_pop($location);
									$listingInfo["Location_Longitude"] = $location["longitude"];
									$listingInfo["Location_Latitude"] = $location["latitude"];
								}
							}
							if ($listingInfo["Location_Country"]) {
								$listingInfo["Location_Country"] = SJB_CountriesManager::getCountryInfoBySID($listingInfo["Location_Country"]);
								if ($listingInfo["Location_Country"]) {
									$listingInfo["Location_Country"] = $listingInfo["Location_Country"]["country_name"];
								}
							}
							if ($listingInfo["Location_State"]) {
								$listingInfo["Location_State"] = SJB_StatesManager::getStateInfoBySID($listingInfo["Location_State"]);
								if ($listingInfo["Location_State"]) {
									$listingInfo["Location_State_Code"] = $listingInfo["Location_State"]["state_code"];
									$listingInfo["Location_State"] = $listingInfo["Location_State"]["state_name"];
								}
							}

							if ($listingInfo["complex"]) {
								$complex = unserialize($listingInfo["complex"]);
								if (!empty($complex["WorkExperience"])) {
									$complex["WorkExperience"]["WE_From"] = $complex["WorkExperience"]["StartDate"];
									unset($complex["WorkExperience"]["StartDate"]);
									$complex["WorkExperience"]["WE_To"] = $complex["WorkExperience"]["EndDate"];
									unset($complex["WorkExperience"]["EndDate"]);
									$complex["WorkExperience"]["WE_JobTitle"] = $complex["WorkExperience"]["JobTitle"];
									unset($complex["WorkExperience"]["JobTitle"]);
									$complex["WorkExperience"]["WE_Company"] = $complex["WorkExperience"]["CompanyName"];
									unset($complex["WorkExperience"]["CompanyName"]);
									$complex["WorkExperience"]["WE_Description"] = $complex["WorkExperience"]["Description"];
									unset($complex["WorkExperience"]["Description"]);
									unset($complex["WorkExperience"]["Industry"]);
								}
								if (!empty($complex["Education"])) {
									$complex["Education"]["ED_From"] = $complex["Education"]["EntranceDate"];
									unset($complex["Education"]["EntranceDate"]);
									$complex["Education"]["ED_To"] = $complex["Education"]["GraduationDate"];
									unset($complex["Education"]["GraduationDate"]);
									$complex["Education"]["ED_DegreeSpecialty"] = $complex["Education"]["Major"];
									$m = new SJB_ListingFieldListItemManager();
									$degreeMap = $m->getHashedListItemsByFieldSID(1275916386);
									foreach ($complex["Education"]["DegreeLevel"] as $key => $degree) {
										if ($degree && !empty($degreeMap[$degree])) {
											$complex["Education"]["ED_DegreeSpecialty"][$key] .= " " . $degreeMap[$degree];
										}
									}
									unset($complex["Education"]["DegreeLevel"]);
									unset($complex["Education"]["Major"]);
									$complex["Education"]["ED_UniversityInstitution"] = $complex["Education"]["InstitutionName"];
									unset($complex["Education"]["InstitutionName"]);
								}
								$listingInfo["complex"] = @serialize($complex);
							}
							$listingsInfo[] = $listingInfo;
						}
						return $listingsInfo;
					', implode(',', $sids)));
						foreach ($remoteListings as $remoteListing) {
							$listing = $this->prepareArray(['sid', 'listing_type_sid', 'user_sid', 'product_info', 'active', 'keywords',
								'views', 'activation_date', 'expiration_date', 'featured_last_showed', 'access_type', 'access_list', 'data_source',
								'external_id', 'Title', 'JobCategory', 'Location_Country', 'Location_City', 'Location_State', 'Location_ZipCode', 'Location_Longitude', 'Location_Latitude',
								'EmploymentType', 'JobDescription', 'Resume', 'featured_expiration', 'complex', 'checkouted', 'Skills'], $remoteListing);
							$listing['featured'] = $remoteListing['featured'] || $remoteListing['priority'];
							$listing['GooglePlace'] = implode(', ', [
								$listing['Location_City'],
								$remoteListing['Location_State_Code'] . ' ' . $listing['Location_ZipCode'],
								$listing['Location_Country'],
							]);
							$listing['GooglePlace'] = str_replace(', , ', ', ', $listing['GooglePlace']);
							$listing['GooglePlace'] = str_replace(', , ', ', ', $listing['GooglePlace']);
							$listing['GooglePlace'] = str_replace('  ', ' ', $listing['GooglePlace']);
							$listing['GooglePlace'] = trim($listing['GooglePlace'], ', ');
							$listing['Location'] = $listing['GooglePlace'];

							if (!empty($remoteListing['Objective'])) {
								$listing['Skills'] = '<h3>Objective:</h3> ' . $remoteListing['Objective'] . ($listing['Skills'] ? ' <h3>Skills:</h3> ' . $listing['Skills'] : '');
							}

							if ($listing['JobDescription'] && !empty($remoteListing['JobRequirements'])) {
								$listing['JobDescription'] .= '<br/><h3>Job Requirements:</h3> ' . $remoteListing['JobRequirements'];
							}

							foreach ($extraFields[$remoteListing['listing_type_sid']] as $extraField) {
								$value = $remoteListing[$extraField['from_field']];
								if ($value) {
									switch ($extraField['type']) {
										case 'list':
										case 'multilist':
										case 'tree':
											$vals = explode(',', $value);
											foreach ($vals as $key => $val) {
												if (empty($extraField['map'][$val])) {
													unset($vals[$key]);
												} else {
													$vals[$key] = $extraField['map'][$val];
												}
											}
											$value = implode(',', $vals);
											break;
										case 'monetary':
											foreach ($extraField['currency_values'] as $currency) {
												if ($currency['sid'] == $value['add_parameter']) {
													$value = $currency['currency_sign'] . $value['value'];
													break;
												}
											}
											if (is_array($value)) {
												$value = $value['value'];
											}
											break;
									}
								}

								if (in_array($extraField['from_field'], ['Salary', 'DesiredSalary'])) {
									if (!empty($remoteListing[$extraField['from_field'] . 'Type'])) {
										$field = $this->getRemoteFields($extraField['from_field'] . 'Type');
										foreach ($field['list_values'] as $fieldValue) {
											if ($fieldValue['id'] == $remoteListing[$extraField['from_field'] . 'Type']) {
												$value .= ' ' . $fieldValue['caption'];
												break;
											}
										}
									}
								}
								$listing[$extraField['id']] = $value;
							}

							$this->insert('listings', $listing);
						}
						$applicationSettings = $this->query('select * from listings_properties where object_sid in (' . join(',', $sids) . ') and id = "ApplicationSettings"');
						foreach ($applicationSettings as $applicationSetting) {
							$this->insert('listings_properties', $applicationSetting);
						}
					}
					SJB_BrowseDBManager::rebuildBrowses();

					// Users
					// todo: users registered from facebook
					SJB_DB::query('truncate table users');
					$count = $this->query('select count(u.sid)
					from users u
					  left join countries c on c.sid = u.Location_Country
					  left join locations l on l.name = Location_ZipCode and l.country_sid = u.Location_Country
					  left join states s on s.sid = u.Location_State where u.user_group_sid in (36, 41) and u.username not like "jobg8%%"');
					$count = array_pop($count);
					$count = intval(array_pop($count));
					for ($i = 0; $i < $count; $i+=1000) {
						$rows = $this->query(sprintf('select
					  u.*, l.latitude Location_Latitude, l.longitude Location_Longitude, c.country_name Location_Country, s.state_name Location_State, s.state_code as Location_State_Code,
					  trim(concat_ws(\' \', u.FirstName, u.LastName, u.ContactName)) FullName
					from users u
					  left join countries c on c.sid = u.Location_Country
					  left join locations l on l.name = Location_ZipCode and l.country_sid = u.Location_Country
					  left join states s on s.sid = u.Location_State where u.user_group_sid in (36, 41) and u.username not like "jobg8%%" order by u.sid limit %s, %s', $i, 1000));
						foreach($rows as $row) {
							if ($row['email']) {
								$row['username'] = $row['email'];
							}
							switch ($row['user_group_sid']) {
								case '36': //js
									$cols = $this->prepareArray(array('sid', 'username', 'password', 'email', 'user_group_sid', 'registration_date',
										'active', 'verification_key', 'ip', 'reference_uid', 'trial', 'FullName'), $row);
									$this->insert('users', $cols);
									break;
								case '41': //emp
									if (!empty($row['parent_sid'])) {
										continue;
									}
									$cols = $this->prepareArray(array('sid', 'username', 'password', 'email', 'user_group_sid',
										'registration_date', 'active', 'verification_key', 'ip', 'FullName', 'reference_uid', 'trial',
										'CompanyName', 'CompanyDescription', 'WebSite', 'Logo', 'featured',
										'Location_Country', 'Location_State', 'Location_City', 'Location_ZipCode', 'Location_Latitude',
										'Location_Longitude', 'Location', 'GooglePlace'), $row);
									$cols['GooglePlace'] = trim(join(', ', array($row['Location_Address'], $row['Location_City'], $row['Location_State_Code'] . ' ' . $row['Location_ZipCode'], $row['Location_Country'])));
									$cols['GooglePlace'] = str_replace(', , ', ', ', $cols['GooglePlace']);
									$cols['GooglePlace'] = str_replace(', , ', ', ', $cols['GooglePlace']);
									$cols['GooglePlace'] = str_replace('  ', ' ', $cols['GooglePlace']);
									$cols['GooglePlace'] = trim($cols['GooglePlace'], ', ');
									$this->insert('users', $cols);
									break;
							}
						}
					}

					// Files
					$this->php('
					$htacc = __DIR__ . "/files/files/.htaccess";
					if (file_exists($htacc)) {
						rename($htacc, $htacc . "_");
					}
					return array("r" => true);
				');
					SJB_DB::query('truncate table uploaded_files');
					$count = $this->query('select count(*) from uploaded_files where file_group in ("pictures", "files")');
					$count = array_pop($count);
					$count = intval(array_pop($count));
					for ($i = 0; $i < $count; $i+=1000) {
						$rows = $this->query(sprintf('select * from uploaded_files where file_group in ("pictures", "files") order by sid limit %s, %s', $i, 1000));
						foreach($rows as $row) {
							$this->insert('uploaded_files', $row);
							copy(str_replace('migrate.php', 'files/' . $row['file_group'] . '/', $this->from) . rawurlencode($row['saved_file_name']), SJB_BASE_DIR . 'files/' . $row['file_group'] . '/' . $row['saved_file_name']);
						}
					}
					$this->php('
					$htacc = __DIR__ . "/files/files/.htaccess";
					if (file_exists($htacc . "_")) {
						rename($htacc . "_", $htacc);
					}
					return array("r" => true);
				');

					// Applications
					SJB_DB::query('truncate table applications');
					$count = $this->query('select count(*) from applications a inner join listings l on a.listing_id = l.sid');
					$count = array_pop($count);
					$count = intval(array_pop($count));
					for ($i = 0; $i < $count; $i+=1000) {
						$apps = $this->query(sprintf('select a.*, trim(concat_ws(\' \', u.FirstName, u.LastName)) FullName from applications a inner join listings l on a.listing_id = l.sid left join users u on u.sid = a.jobseeker_id order by a.id limit %s, %s', $i, 1000));
						foreach($apps as $app) {
							$cols = $this->prepareArray(array('listing_id', 'jobseeker_id', 'comments', 'date', 'resume', 'file', 'mime_type', 'file_id', 'username', 'email'), $app);
							if (empty($cols['username']) && !empty($app['FullName'])) {
								$cols['username'] = $app['FullName'];
							}
							$this->insert('applications', $cols);
						}
					}

					// Alerts
					SJB_DB::query('truncate table guest_alerts');
					$count = $this->query('select count(*) from guest_alerts where status = "active"');
					$count = array_pop($count);
					$count = intval(array_pop($count));
					for ($i = 0; $i < $count; $i+=1000) {
						$rows = $this->query(sprintf('select * from guest_alerts where status = "active" order by sid limit %s, %s', $i, 1000));
						foreach($rows as $row) {
							$cols = $this->prepareArray(array('email', 'data', 'last_send', 'email_frequency', 'subscription_date', 'status'), $row);
							if ($cols['status'] !== 'active') {
								continue;
							}
							$data = unserialize($cols['data']);
							if ($data['listing_type']['equal'] == 'Resume') {
								continue;
							}
							$cols['status'] = 1;
							if (!empty($data['Location'])) {
								$data['GooglePlace'] = $data['Location'];
							}
							foreach ($data as $criteria => $value) {
								if (!in_array($criteria, ['active', 'listing_type', 'keywords', 'GooglePlace', 'JobCategory', 'EmploymentType'])) {
									unset($data[$criteria]);
								}
							}
							if (!empty($data['EmploymentType'])) {
								foreach ($data['EmploymentType'] as $criteriaKey => $criteria) {
									foreach ($criteria as $key => $item) {
										$data['EmploymentType'][$criteriaKey][$key] = $extraFields[6]['EmploymentType']['map'][$item];
									}
								}
							}
							if (!empty($data['JobCategory'])) {
								foreach ($data['JobCategory'] as $criteriaKey => $criteria) {
									foreach ($criteria as $key => $item) {
										if ($item) {
											$data['JobCategory'][$criteriaKey][$key] = $extraFields[6]['JobCategory']['map'][$item];
										}
									}
								}
							}

							$cols['data'] = serialize($data);
							$cols['alert_key'] = md5($cols['email'] . $cols['data']);
							$this->insert('guest_alerts', $cols);
						}
					}
					$count = $this->query('SELECT count(s.sid) FROM `saved_searches` as s inner join users u on s.user_sid = u.sid where s.is_alert = 1');
					$count = array_pop($count);
					$count = intval(array_pop($count));
					for ($i = 0; $i < $count; $i+=1000) {
						$rows = $this->query(sprintf('SELECT u.email, s.data, s.last_send, s.email_frequency FROM `saved_searches` as s inner join users u on s.user_sid = u.sid where s.is_alert = 1 order by s.sid limit %s, %s', $i, 1000));
						foreach($rows as $row) {
							$cols = $this->prepareArray(array('email', 'data', 'last_send', 'email_frequency', 'subscription_date', 'status'), $row);
							if (empty($cols['subscription_date'])) {
								$cols['subscription_date'] = date("Y-m-d");
							}
							$data = unserialize($cols['data']);
							if (!empty($data['Location'])) {
								$data['GooglePlace'] = $data['Location'];
							}
							foreach ($data as $criteria => $value) {
								if (!in_array($criteria, ['active', 'listing_type', 'keywords', 'GooglePlace', 'JobCategory', 'EmploymentType'])) {
									unset($data[$criteria]);
								}
							}
							if ($data['listing_type']['equal'] == 'Resume') {
								continue;
							}
							if (!empty($data['EmploymentType'])) {
								foreach ($data['EmploymentType'] as $criteriaKey => $criteria) {
									foreach ($criteria as $key => $item) {
										$data['EmploymentType'][$criteriaKey][$key] = $extraFields[6]['EmploymentType']['map'][$item];
									}
								}
							}
							if (!empty($data['JobCategory'])) {
								foreach ($data['JobCategory'] as $criteriaKey => $criteria) {
									foreach ($criteria as $key => $item) {
										$data['JobCategory'][$criteriaKey][$key] = $extraFields[6]['JobCategory']['map'][$item];
									}
								}
							}
							$cols['status'] = 1;
							$cols['data'] = serialize($data);
							$cols['alert_key'] = md5($cols['email'] . $cols['data']);
							$this->insert('guest_alerts', $cols);
						}
					}
				} catch (Exception $ex) {
					$errors[] = mb_substr(strip_tags($ex->getMessage()), 0, 255);
					$step--;
					goto step1;
				}
				break;
		}

		$tp->assign('from', $this->from);
		$tp->assign('step', $step);
		$tp->assign('errors', $errors);
		$tp->display(__DIR__ . '/migrate.tpl');
	}

	private function query($query)
	{
		$response = SJB_H::getUrlContentByCurl($this->from, ['query' => $query]);
		$array = @json_decode($response, true);
		if (!is_array($array)) {
			throw new Exception('Invalid response:' . $response);
		}
		return $array;
	}

	private function php($src)
	{
		$response = SJB_H::getUrlContentByCurl($this->from, ['src' => $src]);
		$array = @json_decode($response, true);
		if (!is_array($array)) {
			throw new Exception('Invalid response: ' . $response);
		}
		return $array;
	}

	private function insert($table, $vals)
	{
		return call_user_func_array(
			'SJB_DB::query',
			array(
				sprintf(
					'insert into `%s` (%s) values(%s)',
					$table,
					join(',', array_map(function($val) {return "`{$val}`";}, array_keys($vals))),
					join(',', array_fill(0, count($vals), '?s')))
			) +
			$vals
		);
	}

	/**
	 * Make array with all required fields
	 * @param $requiredFields
	 * @param $sourceRow
	 * @return array
	 */
	private function prepareArray($requiredFields, $sourceRow)
	{
		$requiredFields = array_flip($requiredFields);
		foreach (array_keys($requiredFields) as $requiredField) {
			$requiredFields[$requiredField] = isset($sourceRow[$requiredField]) ? $sourceRow[$requiredField] : null;
		}
		return $requiredFields;
	}

	private $remoteFields = [];

	/**
	 * @param bool $specificField
	 * @return mixed
	 * @throws Exception
	 */
	private function getRemoteFields($specificField = false)
	{
		if (!$this->remoteFields) {
			$this->remoteFields = $this->php('
			$commonFields = SJB_ListingFieldManager::getListingFieldsInfoByListingType(0);
			return array(
				"6" => array_merge(
					$commonFields,
					SJB_ListingFieldManager::getListingFieldsInfoByListingType(6)
				),
				"7" => array_merge(
					$commonFields,
					SJB_ListingFieldManager::getListingFieldsInfoByListingType(7)
				)
			);');
		}
		if (!$specificField) {
			return $this->remoteFields;
		}

		foreach ($this->remoteFields as $listingType) {
			foreach ($listingType as $remoteField) {
				if ($remoteField['id'] == $specificField) {
					return $remoteField;
				}
			}
		}
		return null;
	}
}
