<?php

class SJB_TemplateManager_NavigationMenu extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $menuItems = SJB_DB::query('select * from `navigation_menu` order by id asc');
        $pages = SJB_PageManager::get_pages(true);
        foreach ($menuItems as $key => $menuItem) {
            $menuItems[$key]['fixed_url'] = $menuItem['url'];
            if (in_array($menuItem['url'], array_keys(SJB_Admin_TemplateManager_NavigationMenu::getSystemPages()))) {
                $menuItems[$key]['fixed_url'] = SJB_HelperFunctions::getSiteUrl() . $menuItem['url'];
            }
            foreach ($pages as $page) {
                if ($menuItem['url'] == $page['uri']) {
                    $menuItems[$key]['fixed_url'] = SJB_HelperFunctions::getSiteUrl() . $menuItem['url'];
                }
            }
        }

        $tp->assign('menuItems', self::buildTree($menuItems));
        $tp->display('navigation_menu.tpl');
    }

    /**
     * @param $items
     * @param bool|array $tree
     * @return array|bool
     */
    public static function buildTree($items, $tree = false)
    {
        $root = false;
        if ($tree === false) {
            $root = true;
            $tree = [['id' => 0, 'parent' => null]];
        }

        foreach ($tree as $key => $leaf) {
            foreach ($items as $item) {
                if ($leaf['id'] == $item['parent']) {
                    if (empty($leaf['children'])) {
                        $leaf['children'] = [];
                    }
                    $leaf['children'][] = $item;
                }
            }
            if (!empty($leaf['children'])) {
                $leaf['children'] = self::buildTree($items, $leaf['children']);
            }
            $tree[$key] = $leaf;
        }

        if ($root) {
            $tree = $tree[0]['children'];
        }
        return $tree;
    }
}
