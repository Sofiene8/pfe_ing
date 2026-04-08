<?php

return [
    'display_name' => 'Social',
    'description' => 'Social Plugins',

    'startup_script' =>	[],

    'functions' => [
        'social_plugins' => [
            'display_name'	=> 'List Of available Social Plugins',
            'script'		=> 'social_plugins.php',
            'type'			=> 'user',
            'access_type'	=> ['user'],
        ],
    ],
];
