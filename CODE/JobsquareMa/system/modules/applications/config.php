<?php

return [
    'display_name' => 'Applications',
    'description' => 'Job applications view',
    'classes' => 'classes/',
    'functions' => [
        'view' => [
            'display_name' => 'View applications',
            'script' => 'view.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],
    ],
];
