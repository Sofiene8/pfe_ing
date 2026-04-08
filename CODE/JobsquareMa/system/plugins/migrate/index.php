<?php

require_once __DIR__ . '/migrate.php';

SJB_Event::handle('moduleManagerCreated', array('MigratePlugin', 'handleSystemBoot'));
