<?php

require_once 'jobs2careers_plugin.php';

SJB_Event::handle('jobs2careersBeforeGenerateListingStructure', ['Jobs2careersPlugin', 'getListingsFromJobs2careers']);
SJB_Event::handle('jobs2careersAfterGenerateListingStructure', ['Jobs2careersPlugin', 'addJobs2careersListingsToListingStructure']);
// register plugin as listings provider for ajax requests
SJB_Event::handle('registerListingProviders', ['Jobs2careersPlugin', 'registerAsListingsProvider']);