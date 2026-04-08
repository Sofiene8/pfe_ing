<?php

return [
	'display_name' => 'Static Content',
	'description' => 'Static Content',
	'classes' => 'classes/',
	'functions' => [
		'show_static_content' => [
			'display_name'	=> 'Show Static Content',
			'script'		=> 'show_static_content.php',
			'type'			=> 'user',
			'access_type'	=> ['user'],
			'params'		=> [],
        ],
    ]
];
