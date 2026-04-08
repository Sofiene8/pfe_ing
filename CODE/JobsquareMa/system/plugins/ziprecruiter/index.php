<?php

require_once 'ziprecruiter_plugin.php';

SJB_Event::handle('ziprecruiterBeforeGenerateListingStructure', ['ZiprecruiterPlugin', 'getListingsFromZiprecruiter']);
SJB_Event::handle('ziprecruiterAfterGenerateListingStructure', ['ZiprecruiterPlugin', 'addZiprecruiterListingsToListingStructure']);
// register plugin as listings provider for ajax requests
SJB_Event::handle('registerListingProviders', ['ZiprecruiterPlugin', 'registerAsListingsProvider']);