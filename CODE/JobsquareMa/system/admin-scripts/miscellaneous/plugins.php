<?php

class SJB_Admin_Miscellaneous_Plugins extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();

        $saved = false;
        $action = SJB_Request::getVar('action');
        $form_submitted = SJB_Request::getVar('submit');
        $template = 'plugins.tpl';
        if (SJB_Navigator::getURI() == '/backfilling/') {
            $template = 'backfilling-plugins.tpl';
        }
        $errors = [];
        if (SJB_Request::getVar('error', false))
            $errors[] = SJB_Request::getVar('error', false);
        $messages = [];
        if (SJB_Request::getVar('message', false))
            $messages[] = SJB_Request::getVar('message', false);

        switch ($action) {
            case 'switch_backfilling':
                SJB_Settings::updateSetting('enable_backfilling', SJB_Request::getVar('enable', 0));
                echo 'ok';
                return;
                break;
            case 'save':
                $plugin = SJB_PluginManager::getPluginByName(SJB_Request::getVar('plugin'));
                $config = SJB_PluginManager::getPluginConfigFromIniFile($plugin['config_file']);
                $config['active'] = SJB_Request::getInt('active', 1);
                try {
                    if ($config['active']) {
                        if ($plugin['name'] == 'FacebookApplicationPlugin' && !$this->acl->isFeatureAllowed('Facebook app')) {
                            throw new Exception('Failed to save ' . $plugin['name'] . ' settings');
                        }
                        if ($plugin['name'] == 'JobG8IntegrationPlugin' && !$this->acl->isFeatureAllowed('Jobg8')) {
                            throw new Exception('Failed to save ' . $plugin['name'] . ' settings');
                        }
                    }
                    if (!SJB_PluginManager::savePluginConfigIntoIniFile($plugin['config_file'], $config)) {
                        throw new Exception('Failed to save ' . $plugin['name'] . ' settings');
                    }
                    if ($plugin['group'] == 'Job Backfilling' && $config['active']) {
                        foreach (SJB_PluginManager::getAllPluginsList() as $plg) {
                            if ($plg['group'] == 'Job Backfilling' && $plg['active'] && $plg['name'] != $plugin['name']) {
                                $cfg = SJB_PluginManager::getPluginConfigFromIniFile($plg['config_file']);
                                $cfg['active'] = '0';
                                SJB_PluginManager::savePluginConfigIntoIniFile($plg['config_file'], $cfg);
                            }
                        }
                    }

                    if ($config['active']) {
                        if ($plugin['name'] == 'SocialLoginPlugin') {
                            SJB_H::redirect(SJB_H::getAdminSiteUrl() . '/social-media/');
                        } else {
                            if ($plugin['group'] == 'Job Backfilling') {
                                SJB_H::redirect(SJB_H::getAdminSiteUrl() . '/backfilling/?action=settings&plugin=' . $plugin['name']);
                            }
                            SJB_H::redirect(SJB_H::getAdminSiteUrl() . '/system/miscellaneous/plugins/?action=settings&plugin=' . $plugin['name']);
                        }
                    }
                } catch (Exception $ex) {
                    $errors[] = $ex->getMessage();
                }
                SJB_PluginManager::reloadPlugins();
                break;

            case 'save_settings':
                $request = $_REQUEST;
                $request = self::checkRequiredFields($request);
                if (!isset($request['setting_errors'])) {
                    SJB_Settings::updateSettings($request);
                    if ($form_submitted == 'save') {
                        break;
                    } else if ($form_submitted == 'apply') {
                        $pluginName = SJB_Request::getVar('plugin');
                        $plugin = SJB_PluginManager::getPluginByName($pluginName);
                        if ($plugin['group'] == 'Job Backfilling') {
                            \SJB\Analytics\Logger::log('Changed backfilling');
                        }
                        SJB_HelperFunctions::redirect('?action=settings&plugin=' . $pluginName);
                    }
                } else {
                    unset($request['setting_errors']);
                    $errors = $request;
                }
            // no break;

            case 'settings':
                $pluginName = SJB_Request::getVar('plugin');
                $plugin = SJB_PluginManager::getPluginByName($pluginName);
                if (isset($plugin['name'])) {
                    if ($plugin['name'] == 'SocialLoginPlugin') {
                        SJB_H::redirect(SJB_H::getAdminSiteUrl() . '/social-media/');
                    }
                    $pluginObj = new $plugin['name'];
                    $settings = $pluginObj->pluginSettings();
                    $template = 'plugin_settings.tpl';
                    $savedSettings = SJB_Settings::getSettings();
                    SJB_Event::dispatch('RedefineSavedSetting', $savedSettings, true);
                    SJB_Event::dispatch('RedefineTemplateName', $template, true);
                    $tp->assign('plugin', $plugin);
                    $tp->assign('settings', $settings);
                    $tp->assign('savedSettings', $savedSettings);
                }
                break;
        }

        $listPlugins = SJB_PluginManager::getAllPluginsList();
        $plugins = [];
        foreach ($listPlugins as $key => $plugin) {
            $uri = SJB_Navigator::getURI();
            $group = !empty($plugin['group']) ? $plugin['group'] : 'Common';
            if (in_array($plugin['name'], ['ApiPlugin'])) {
                continue;
            }
            if (($uri == '/backfilling/' && $group != 'Job Backfilling') || ($uri != '/backfilling/' && $group != 'Common')) {
                continue;
            }
            $plugins[$group][$key] = $plugin;
        }

        $tp->assign('saved', $saved);
        $tp->assign('groups', $plugins);
        $tp->assign('errors', $errors);
        $tp->assign('messages', $messages);
        $tp->assign('upgradeUrl', SJB_AdminAcl::getUpgradeUrl());
        $tp->display($template);
    }

    public static function checkRequiredFields($settings)
    {
        if (isset($settings['plugin'])) {
            $pluginObj = new $settings['plugin'];
            $settingsFields = $pluginObj->pluginSettings();
            $errors = [];
            foreach ($settingsFields as $settingsField) {
                if (!empty($settingsField['is_required']) && $settingsField['is_required'] === true && empty($settings[$settingsField['id']])) {
                    $errors[$settingsField['caption']] = $settingsField['caption'] . ' is empty';
                } else if (!empty($settingsField['validators'])) {
                    foreach ($settingsField['validators'] as $validator) {
                        $isValid = $validator::isValid($settings[$settingsField['id']]);
                        if ($isValid !== true) {
                            $errors[$settingsField['caption']] = $isValid;
                        }
                    }
                }
            }

            if ($errors) {
                $errors['setting_errors'] = true;
                return $errors;
            }
        }

        return $settings;
    }
}
