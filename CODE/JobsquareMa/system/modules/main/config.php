<?php

return [
    'display_name' => 'Main',
    'description' => 'Home page and all site pages',
    'classes' => 'classes/',
    'startup_script' => [
        'admin' => function() {
            if (!SJB_Admin::admin_authed()) {
                echo SJB_System::executeFunction('main', 'admin_login');
            }
        }
    ],
    'functions' => [
        'admin_login' => [
            'display_name' => 'Admin Login Page',
            'script' => 'admin_login.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
    ],
];
