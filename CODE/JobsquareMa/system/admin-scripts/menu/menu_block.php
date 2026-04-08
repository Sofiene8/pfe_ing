<?php

class SJB_Admin_Menu_ShowLeftMenu extends SJB_Function
{
    private $pageID;

    public function __construct(SJB_Acl $acl, array $params, $roleID)
    {
        parent::__construct($acl, $params, $roleID);

        $GLOBALS['LEFT_ADMIN_MENU'] = [
            'Job Board' => [
                [
                    'title' => 'Job Postings',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-jobs/',
                    'highlight' => [],
                ],
                [
                    'title' => "Employer Profiles",
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-users/employer/',
                    'highlight' => [],
                ],
                [
                    'title' => 'Resumes',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-resumes/',
                    'highlight' => [],
                ],
                [
                    'title' => "Job Seeker Profiles",
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-users/jobseeker/',
                    'highlight' => [],
                ],
                [
                    'title' => 'Job Alerts',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/guest-alerts/',
                    'highlight' => [],
                ],
                [
                    'title' => 'Trainig Postings',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-trainings/',
                    'highlight' => [],
                ],
            ],
            'Appearance' => [
                [
                    'title' => 'Themes',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/edit-themes/',
                ],
                [
                    'title' => 'Customize Theme',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/customize-theme/',
                ],
				
                [
                    'title' => 'Navigation Menu',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/navigation-menu/',
                ],
                [
                    'title' => 'Templates',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/edit-templates/',
                ],
                [
                    'title' => 'Email Templates',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/edit-email-templates/',
                ],
            ],
            'Content' => [
                [
                    'title' => 'Pages',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/user-pages/',
                ],
				 [
                    'title' => 'Banners ',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-banner-groups/',
                ],
                [
                    'title' => 'Blog',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/blog/',
                ],
            ],
            'eCommerce' => [
                [
                    'title' => 'Orders',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-invoices/',
                    'highlight' =>
                        [
                            SJB_System::getSystemSettings('SITE_URL') . '/view-invoice/',
                        ]
                ],
                [
                    'title' => 'Employer Products',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/products/employer/',
                    'highlight' => [],
                ],
                [
                    'title' => 'Job Seeker Products',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/products/jobseeker/',
                    'highlight' => [],
                ],
                [
                    'title' => 'Discounts',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/promotions/',
                    'highlight' => [
                        SJB_System::getSystemSettings('SITE_URL') . '/add-promotion-code/',
                        SJB_System::getSystemSettings('SITE_URL') . '/edit-promotion-code/',
                        SJB_System::getSystemSettings('SITE_URL') . '/promotions/log/',
                    ],
                ],
                [
                    'title' => 'Payment Methods',
                    'reference' => SJB_System::getSystemSettings('SITE_URL') . '/system/payment/gateways/',
                    'highlight' => [
                        SJB_System::getSystemSettings('SITE_URL') . '/configure-gateway/',
                    ],
                ],

            ]
        ];
        $GLOBALS['LEFT_ADMIN_MENU']['Listing Fields'] = [
            [
                'title' => 'Custom Fields',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/custom-fields/',
                'highlight' => [
                    SJB_System::getSystemSettings('SITE_URL') . '/posting-pages/resume/edit/19',
                    SJB_System::getSystemSettings('SITE_URL') . '/posting-pages/job/edit/11',
                    SJB_System::getSystemSettings('SITE_URL') . '/user-profile-fields/',
                    SJB_System::getSystemSettings('SITE_URL') . '/edit-user-profile-field/',
                    SJB_System::getSystemSettings('SITE_URL') . '/posting-pages/',
                    SJB_System::getSystemSettings('SITE_URL') . '/delete-listing-type-field/',
                    SJB_System::getSystemSettings('SITE_URL') . '/edit-listing-field/edit-fields/',
                    SJB_System::getSystemSettings('SITE_URL') . '/add-listing-type-field/',
                ],
            ],
            [
                'title' => 'Categories',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/edit-listing-type-field/?list_visible=visible&sid=' . SJB_ListingField::CATEGORIES,
                'highlight' =>
                    [
                        SJB_System::getSystemSettings('SITE_URL') . '/edit-listing-type-field/?sid=' . SJB_ListingField::CATEGORIES,
                    ],
            ],
            [
                'title' => 'Job Types',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/edit-listing-type-field/?list_visible=visible&sid=' . SJB_ListingField::JOB_TYPE,
                'highlight' =>
                    [
                        SJB_System::getSystemSettings('SITE_URL') . '/edit-listing-type-field/?sid=' . SJB_ListingField::JOB_TYPE,
                    ],
            ]
        ];

        $GLOBALS['LEFT_ADMIN_MENU']['Settings'] = [
            [
                'title' => 'System Settings',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/settings/',
                'highlight' => [],
            ],
            [
                'title' => 'Site Admins',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/admins/',
                'highlight' => [],
            ],
            [
                'title' => 'Edit Language',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/manage-phrases/',
                'highlight' => [],
            ],
			[
				'title' => 'Messages Employeur',
				'reference' => SJB_System::getSystemsettings('SITE_URL') . '/manage_messages/',
				'perm_label' => 'Messages Employeur',
			],
			[
				'title' => 'Governorats',
				'reference' => SJB_System::getSystemsettings('SITE_URL') . '/manage_states/',
				'perm_label' => 'Governorats',
			],
			[
				'title' => 'Secteurs',
				'reference' => SJB_System::getSystemsettings('SITE_URL') . '/manage_secteurs/',
				'perm_label' => 'Secteurs',
			],
            [
                'title' => 'Refine Search Settings',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/refine-search-settings/',
            ],
            [
                'title' => 'Task Scheduler',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/task-scheduler-settings/',
            ],
            [
                'title' => 'Job Backfilling',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/backfilling/',
                'highlight' => [
                    SJB_System::getSystemSettings('SITE_URL') . '/backfilling/?action=settings&plugin=IndeedPlugin',
                    SJB_System::getSystemSettings('SITE_URL') . '/backfilling/?action=settings&plugin=Jobs2CareersPlugin',
                    SJB_System::getSystemSettings('SITE_URL') . '/backfilling/?action=settings&plugin=ZiprecruiterPlugin',
                ],
            ],
            [
                'title' => 'RSS/XML Feeds',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/listing-feeds/',
                'highlight' => [],
            ],
            [
                'title' => 'Job Auto Import',
                'reference' => SJB_System::getSystemSettings('SITE_URL') . '/show-import/',
                'highlight' =>
                    [
                        SJB_System::getSystemSettings('SITE_URL') . '/add-import/',
                        SJB_System::getSystemSettings('SITE_URL') . '/edit-import/',
                        SJB_System::getSystemSettings('SITE_URL') . '/run-import/',
                    ],
            ],
			[
				'title' => 'Breadcrumbs Config',
				'reference' => SJB_System::getSystemsettings('SITE_URL') . '/manage-breadcrumbs/',
				'perm_label' => 'configure_breadcrumbs',
			],
        ];


        $acl = SJB_Acl::getInstance();
        if (!$acl->isAllowed(SJB_Acl::ADMIN_JOB_BOARD)) {
            unset($GLOBALS['LEFT_ADMIN_MENU']['Job Board']);
        }
        if (!$acl->isAllowed(SJB_Acl::ADMIN_SETTINGS)) {
            unset($GLOBALS['LEFT_ADMIN_MENU']['Settings']);
            unset($GLOBALS['LEFT_ADMIN_MENU']['Listing Fields']);
        }
        if (!$acl->isAllowed(SJB_Acl::ADMIN_ECOMMERCE)) {
            unset($GLOBALS['LEFT_ADMIN_MENU']['eCommerce']);
        }
        if (!$acl->isAllowed(SJB_Acl::ADMIN_CONTENT)) {
            unset($GLOBALS['LEFT_ADMIN_MENU']['Content']);
        }
        if (!$acl->isAllowed(SJB_Acl::ADMIN_APPEARANCE)) {
            unset($GLOBALS['LEFT_ADMIN_MENU']['Appearance']);
        }
        if (!$acl->isAllowed(SJB_Acl::ADMIN_FULL) && !empty($GLOBALS['LEFT_ADMIN_MENU']['Settings'])) {
            foreach ($GLOBALS['LEFT_ADMIN_MENU']['Settings'] as $key => $setting) {
                if ($setting['title'] == 'Site Admins') {
                    unset($GLOBALS['LEFT_ADMIN_MENU']['Settings'][$key]);
                }
            }
        }

        if (SJB_System::getSystemSettings("isSaas")) {
            foreach ($GLOBALS['LEFT_ADMIN_MENU'] as $menuKey => $menuItems) {
                foreach ($menuItems as $key => $menuItem) {
                    if (in_array($menuItem['title'], ['Templates', 'Task Scheduler'])) {
                        unset ($GLOBALS['LEFT_ADMIN_MENU'][$menuKey][$key]);
                    }
                }
            }
        }
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $this->pageID = SJB_PageManager::getPageParentURI(SJB_Navigator::getURI(), SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE'), false);
        if (empty($this->pageID) || $this->pageID == '/') {
            $this->pageID = $GLOBALS['uri'];
        }

        $tp->assign('left_admin_menu', $this->mark_active_items($GLOBALS['LEFT_ADMIN_MENU']));

        $tp->display('admin_left_menu.tpl');
    }

    private function mark_active_items($arr)
    {
        $itemsMarked = false;
        foreach ($arr as $key => $items) {
            $arr[$key]['active'] = false;
            foreach ($items as $item_key => $item) {
                $arr[$key][$item_key]['active'] = false;
                $item['highlight'][] = $item['reference'];
                foreach ($item['highlight'] as $menuItem) {
                    if (stripos($menuItem, SJB_Navigator::getURIThis()) && SJB_Navigator::getURI() !== '/') {
                        $arr[$key][$item_key]['active'] = true;
                        $arr[$key]['active'] = true;
                        $itemsMarked = true;
                    }
                }
            }
        }
        if (!$itemsMarked) {
            foreach ($arr as $key => $items) {
                foreach ($items as $item_key => $item) {
					
					if(!is_array($item)) $item = [];
                    $item['highlight'][] = $item['reference'];
                    foreach ($item['highlight'] as $menuItem) {
                        if (stripos(preg_replace('/\\?.*/u', '', (string)$menuItem), SJB_Navigator::getURIThis()) && SJB_Navigator::getURI() !== '/') {
                            $arr[$key][$item_key]['active'] = true;
                            $arr[$key]['active'] = true;
                        }
                    }
                }
            }
        }
        foreach ($arr as $key => $items) {
            $arr[$key]['id'] = str_replace(' ', '_', $key);
        }
        return $arr;
    }
}
