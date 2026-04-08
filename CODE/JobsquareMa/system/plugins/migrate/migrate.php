<?php

class MigratePlugin extends SJB_PluginAbstract
{
	public static function handleSystemBoot()
	{
		$plugin = SJB_PluginManager::getPluginByName('MigratePlugin');
		$isPluginActive = $plugin && $plugin['active'] == '1';
		if (!$isPluginActive) {
			return;
		}
		$isFbAppSettingsPage = SJB_Request::getVar('action') == 'settings' && SJB_Request::getVar('plugin') == 'MigratePlugin';
		if ($isFbAppSettingsPage) {
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('ADMIN_SITE_URL') . '/system/miscellaneous/migrate/');
		}
		if (SJB_Navigator::getURI() == '/system/miscellaneous/migrate/') {
			SJB_System::getModuleManager()->includeModule(SJB_BASE_DIR . 'system/plugins/migrate/module', 'miscellaneous');
			require_once __DIR__ . '/module/miscellaneous/migrate.php';
		}
	}
}
