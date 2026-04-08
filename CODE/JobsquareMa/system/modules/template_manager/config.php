<?php

return [
	'display_name' => 'Template manager',
	'description' => 'Managing tamplates',
	'classes' => 'classes/',
	'functions' => [
		'edit_templates' => [
			'edit_templates'=> 'Display Modules',
			'script'		=> 'edit_templates.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
		'module_list' => [
			'display_name'	=> 'Display Modules',
			'script'		=> 'module_list.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
		'template_list' => [
			'display_name'	=> '',
			'script'		=> 'template_list.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
		'edit_template' => [
			'display_name'	=> '',
			'script'		=> 'edit_template.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
		'theme_editor' => [
			'display_name'	=> 'Theme Editor',
			'script'		=> 'edit_theme.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
		'customize_theme' => [
			'display_name'	=> 'Customize Theme',
			'script'		=> 'customize_theme.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
		'navigation_menu' => [
			'display_name'	=> 'Navigation Menu',
			'script'		=> 'navigation_menu.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin', 'user'],
        ],
		'edit_email_templates' => [
			'display_name'	=> 'Display Modules',
			'script'		=> 'edit_email_templates.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
		'delete_uploaded_file' => [
			'display_name'	=> 'Delete Uploaded File',
			'script'		=> 'email_templates_delete_uploaded_file.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
        ],
    ]
];
