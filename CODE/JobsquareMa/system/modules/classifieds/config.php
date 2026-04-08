<?php

return [

    'display_name' => 'Classifieds engine',
    'description' => 'Classifieds engine',
    'classes' => 'classes/',

    'functions' => [

        'listing_fields' => [
            'display_name' => 'Listing Fields',
            'script' => 'listing_fields.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'edit_listing_field' => [
            'display_name' => 'Edit Listing Field',
            'script' => 'edit_listing_field.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'delete_listing_field' => [
            'display_name' => 'Delete Listing Field',
            'script' => 'delete_listing_field.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'edit_listing_type' => [
            'display_name' => 'Edit Listing Type',
            'script' => 'edit_listing_type.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'add_listing_type_field' => [
            'display_name' => 'Add Listing Type Field',
            'script' => 'add_listing_type_field.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
  'manage_messages' => [
            'display_name' => 'Manages messages',
            'script' => 'manage_messages.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		
		 'edit_message' => [
            'display_name' => 'Edit message',
            'script' => 'edit_message.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		 'delete_message' => [
            'display_name' => 'Delete message',
            'script' => 'delete_message.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		  'manage_states' => [
            'display_name' => 'Manages states',
            'script' => 'manage_states.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		 'edit_state' => [
            'display_name' => 'Edit state',
            'script' => 'edit_state.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		 'delete_state' => [
            'display_name' => 'Delete state',
            'script' => 'delete_state.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		 'random_states' => [
            'display_name' => 'States',
            'script' => 'random_states.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],
		
		
		'manage_secteurs' => [
            'display_name' => 'Manages secteurs',
            'script' => 'manage_secteurs.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		 'edit_secteur' => [
            'display_name' => 'Edit state',
            'script' => 'edit_secteur.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		 'delete_secteur' => [
            'display_name' => 'Delete secteur',
            'script' => 'delete_secteur.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],
		 'random_secteurs' => [
            'display_name' => 'Secteurs',
            'script' => 'random_secteurs.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],
        'edit_listing_type_field' => [
            'display_name' => 'Edit Listing Type Field',
            'script' => 'edit_listing_type_field.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'delete_listing_type_field' => [
            'display_name' => 'Delete Listing Type Field',
            'script' => 'delete_listing_type_field.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'add_listing' => [
            'display_name' => 'Add Listing',
            'script' => 'add_listing.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
            'params' => ['input_template']
        ],
         
     
        'display_listing' => [
            'display_name' => 'Display Listing',
            'script' => 'display_listing.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
            'params' => ['display_template', 'listing_type_id']
        ],

        'application_redirect' => [
            'display_name' => 'Application Redirect',
            'script' => 'application_redirect.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],

        'search_form' => [
            'display_name' => 'Search Form',
            'script' => 'search_form.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['listing_type_id', 'form_template'],
        ],

        'search_results' => [
            'display_name' => 'Search Form',
            'script' => 'search_results.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => [
                'default_sorting_field',
                'default_sorting_order',
                'default_listings_per_page',
                'results_template',
                'listing_type_id'
            ],
        ],

        'pay_for_listing' => [
            'display_name' => 'Pay For Listing',
            'script' => 'pay_for_listing.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],

        'manage_listings' => [
            'display_name' => 'Manage Listings',
            'script' => 'manage_listings.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'listing_actions' => [
            'display_name' => '',
            'script' => 'listing_actions.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'edit_listing' => [
            'display_name' => 'Edit Listing',
            'script' => 'edit_listing.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
            'params' => ['edit_template']
        ],
       'edit_listing_step' => [
            'display_name' => 'Edit Listing',
            'script' => 'edit_listing_step.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
            'params' => ['edit_template']
        ],
        'clone_listing' => [
            'display_name' => 'Clone Listing',
            'script' => 'clone_listing.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
            'params' => ['clone_template']
        ],

        'add_listing_step' => [
            'display_name' => 'Add Listing',
            'script' => 'add_listing_step.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
            'params' => ['edit_template']
        ],

        'my_listings' => [
            'display_name' => 'My Listings',
            'script' => 'my_listings.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['listing_type_id'],
        ],

        'edit_list' => [
            'display_name' => 'Edit List',
            'script' => 'edit_list.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'edit_complex_fields' => [
            'display_name' => 'Edit Fields',
            'script' => 'edit_complex_fields.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'manage_listing' => [
            'display_name' => 'Manage Listing',
            'script' => 'manage_listing.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
        ],

        'apply_now' => [
            'display_name' => 'Apply Now',
            'script' => 'apply_now.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],

        'delete_uploaded_file' => [
            'display_name' => 'Delete Uploaded File',
            'script' => 'delete_uploaded_file.php',
            'type' => 'user',
            'access_type' => ['user', 'admin'],
        ],

        'plus_city_listings' => [
            'display_name' => 'Plus City Listings',
            'script' => 'plus_city_listings.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['items_count', 'listing_type','listing_id', 'template'],
        ],
		  'plus_category_listings' => [
            'display_name' => 'Plus Category Listings',
            'script' => 'plus_category_listings.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['items_count', 'listing_type','listing_id', 'template'],
        ],
		  'plus_featured_listings' => [
            'display_name' => 'Plus Featured Listings',
            'script' => 'plus_featured_listings.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['items_count', 'listing_type','listing_id', 'template'],
        ],
		  'listings_user_profile' => [
            'display_name' => 'Offres recommandées',
            'script' => 'listings_user_profile.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['items_count', 'listing_type','listing_id', 'template'],
        ],
		 'featured_listings_sponsorise' => [
            'display_name' => 'Listings similaires sponsorises',
            'script' => 'featured_listings_sponsorise.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['items_count', 'listing_type','listing_id', 'template'],
        ],
		  'featured_listings_home' => [
            'display_name' => 'Featured Listings',
            'script' => 'featured_listings_home.php',
              'type' => 'user',
				'access_type' => ['user'],
				'params' => ['items_count', 'listing_type', 'template'],
        ],
		'featured_listings_interne' => [
            'display_name' => 'Featured Listings',
            'script' => 'featured_listings_interne.php',
              'type' => 'user',
				'access_type' => ['user'],
				'params' => ['items_count', 'listing_type', 'template'],
        ],
		 'plus_training_listings' => [
            'display_name' => 'Plus Training Listings',
            'script' => 'plus_training_listings.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['items_count', 'listing_type','listing_id', 'template'],
        ],
	 'featured_listings' => [
				'display_name' => 'Featured Listings',
				'script' => 'featured_listings.php',
				'type' => 'user',
				'access_type' => ['user'],
				'params' => ['items_count', 'listing_type', 'template'],
			],

        'latest_listings' => [
            'display_name' => 'Latest Listings',
            'script' => 'latest_listings.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['items_count', 'listing_type', 'template', 'mime_type'],
        ],

        'import_listings' => [
            'display_name' => 'Import Listings',
            'script' => 'import_listings.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'export_listings' => [
            'display_name' => 'Export Listings',
            'script' => 'export_listings.php',
            'type' => 'admin',
            'access_type' => ['admin'],
            'raw_output' => false,
        ],

        'browse' => [
            'display_name' => 'Browse',
            'script' => 'browse.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => [
                'level1Field',
                'browse_template',
                'listing_type_id',
                'columns',
                'recordsNumToDisplay',
                'parent'
            ],
        ],

        'display_my_listing' => [
            'display_name' => 'Display My Listing',
            'script' => 'display_my_listing.php',
            'type' => 'user',
            'access_type' => ['admin', 'user'],
            'params' => ['display_template', 'listing_type_id']
        ],

        'listing_feeds' => [
            'display_name' => 'Listing Feeds',
            'script' => 'listing_feeds.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['count_listings'],
        ],

        'browseCompany' => [
            'display_name' => 'companies',
            'script' => 'browseCompany.php',
            'type' => 'user',
            'access_type' => ['user'],
            'params' => ['display_template', 'listing_type_id']
        ],

        'import_users' => [
            'display_name' => 'Import Users',
            'script' => 'import_users.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'refine_search' => [
            'display_name' => 'refine search settings',
            'script' => 'refine_search.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'count_listings' => [
            'display_name' => 'count_listings',
            'script' => 'count_listings.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],

        'posting_pages' => [
            'display_name' => 'posting_pages',
            'script' => 'posting_pages.php',
            'type' => 'admin',
            'access_type' => ['admin'],
        ],

        'listing_preview' => [
            'display_name' => 'listing_preview',
            'script' => 'listing_preview.php',
            'type' => 'user',
            'access_type' => ['user'],
        ],
    ],
];
