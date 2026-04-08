<?php

$protocol = 'http://';
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
	$protocol = 'https://';
return array(
	'HTTPHOST' => 'localhost',
	'BASEURL' => '/JobsquareMa/',
	'DBHOST' => 'localhost',
	'DBNAME' => 'jobsquaremadb',
	'DBUSER' => 'root',
	'DBPASSWORD' => '',
	'DBADAPTER' => 'Pdo_Mysql',
	'MYSQL_CHARSET' => 'utf8',
	'SITE_URL' => 'http://localhost/JobsquareMa',
	'USER_SITE_URL' => 'http://localhost/JobsquareMa/',
	'ADMIN_SITE_URL' => 'http://localhost/JobsquareMa/admin',
);
