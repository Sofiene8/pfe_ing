<?php


return [
	'display_name' => 'Banners',
	'description' => 'Banners',
	'classes' => 'classes/',
	'functions' => [
	
		'manage_banners' => [
			'display_name'	=> 'Manage Banners',
			'script'		=> 'manage_banners.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
		 ],
		'show_banners' => [
			'display_name'	=> 'Display Banners',
			'script'		=> 'show_banners.php',
			'type'			=> 'user',
			'access_type'	=> ['user'],
			//'params' => ['group'],		
		 ],
		'add_banner' => [
			'display_name'	=> 'Add Banner',
			'script'		=> 'add_banner.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
			// 'params' => array ('banner_id'),		
		 ],
		'edit_banner' => [
			'display_name'	=> 'Edit Banner',
			'script'		=> 'edit_banner.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
			'params' => ['banner_id'],		
	 ],
		'go_link' => [
			'display_name'	=> 'Go to Link',
			'script'		=> 'banner_go_link.php',
			'type'			=> 'user',
			'access_type'	=> ['user'],
			'params' => ['banner_id'],		
		 ],
		
		
		'manage_banner_groups' => [
			'display_name'	=> 'Banner Groups',
			'script'		=> 'manage_banner_groups.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
		 ],
		'add_banner_group' => [
			'display_name'	=> 'Add Banner Group',
			'script'		=> 'add_banner_group.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
		 ],
		'edit_banner_group' => [
				'display_name'	=> 'Edit Banner Group',
			'script'		=> 'edit_banner_group.php',
			'type'			=> 'admin',
			'access_type'	=> ['admin'],
		 ],
	 ]
 ];

