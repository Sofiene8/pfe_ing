<?php

class SJB_Admin_TemplateManager_NavigationMenu extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_APPEARANCE);
        return parent::isAccessible();
    }

    public function execute()
    {
        if (SJB_Request::getMethod() == SJB_Request::METHOD_POST) {
            $menuItems = SJB_Request::getVar('menu_item', []);
            $links = SJB_Request::getVar('link', []);
            $parents = SJB_Request::getVar('parent', []);

            if ($menuItems) {
                SJB_DB::query('truncate `navigation_menu`');
                foreach ($menuItems as $key => $menuItem) {
                    SJB_DB::query('insert into `navigation_menu` (`name`, `url`, `parent`) values(?s, ?s, ?n)', $menuItem, $links[$key], $parents[$key]);
                }
            }
        }

        $tp = SJB_System::getTemplateProcessor();
        $menuItems = SJB_DB::query('select * from `navigation_menu`');
        $menuItems = SJB_TemplateManager_NavigationMenu::buildTree($menuItems);
        $tp->assign('menuItems', $menuItems);
        $tp->assign('system_pages', self::getSystemPages());
        $tp->assign('pages', SJB_PageManager::get_pages(true));
        $tp->display('navigation_menu.tpl');
    }

    public static function getSystemPages()
    {
        return [
            '/' => 'Home',
            '/add-listing/?listing_type_id=Job' => 'Post a Job',
            '/add-listing/?listing_type_id=Training' => 'Post a Training',
            '/jobs/' => 'Search Jobs',
            '/trainings/' => 'Search Trainings',
            '/companies/' => 'Company Search',
			 '/jobs/?JobCategory[multi_like][]=706' => 'Emploi centres d\'appels',
            '/resumes/' => 'Resume Search',
            '/employer-products/' => 'Employer Products',
            '/jobseeker-products/' => 'Job Seeker Products',
            '/blog/' => 'Blog',
        ];
    }
}
