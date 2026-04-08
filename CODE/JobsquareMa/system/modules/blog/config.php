<?php

return [
    'display_name' => 'Blog',
    'description' => 'Blog module',

    'startup_script' => [],

    'functions' => [
        'blog' => [
            'display_name' => 'Blog',
            'script' => 'blog.php',
            'type' => 'admin',
            'access_type' => ['admin', 'user'],
        ],
    ]
];
