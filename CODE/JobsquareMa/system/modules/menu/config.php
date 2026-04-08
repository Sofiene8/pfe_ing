<?php

return [
    'display_name' => 'Menu',
    'description' => 'Top menu, My Account, User Menu',
    'classes' => 'classes/',
    'functions' => [
        'show_left_menu' => [
            'display_name' => 'Left admin menu',
            'script' => 'menu_block.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
        'user_menu' => [
            'display_name' => 'User Menu',
            'script' => 'user_menu.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],
        'footer_menu' => [
            'display_name' => 'Footer',
            'script' => 'footer_menu.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],
    ],
];
