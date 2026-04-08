<?php

$modules = SJB_System::getModuleManager()->getModulesList();
$modules['miscellaneous']['functions']['migrate'] = array(
	'display_name'		=> 'Migrate Plugin',
	'script'		=> '../../plugins/migrate/module/miscellaneous/migrate.php',
	'type'			=> 'admin',
	'access_type'	=> array('admin'),
);
return $modules['miscellaneous'];
