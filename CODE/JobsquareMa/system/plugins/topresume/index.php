<?php

require_once 'topresume.php';

if (SJB_PluginManager::isPluginActive('TopresumePlugin')) {
    SJB_Event::handle('moduleManagerCreated', ['TopresumePlugin', 'handleSystemBoot']);
    if (SJB_Settings::getValue('topresume_key') && SJB_Settings::getValue('topresume_secret')) {
        SJB_Event::handle('ListingSaved', ['TopresumePlugin', 'listingSaved']);
        SJB_Event::handle('AddListingForm', ['TopresumePlugin', 'addListingForm']);
    }
}
