<?php

class SJB_Blog_Blog extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $page = SJB_Request::getInt('page');
        if (empty($page) || $page < 0) {
            $page = 1;
        }

        $params = SJB_UrlParamProvider::getParams();
        if ($params) {
            $param = array_shift($params);
            switch ($param) {
                case 'rss':
                    header('Content-Type: application/rss+xml');
                    $posts = SJB_BlogManager::getBlogPosts('date', 'DESC', $page, 10, true);
                    $tp->assign('posts', $posts);
                    $tp->display('blog_rss.tpl');
                    exit();
                    break;
                default:
                    $post = SJB_BlogManager::getBlogPostInfoBySid($param, true);
                    if ($post) {
                        $tp->assign('post', $post);
                        $tp->display('blog_item.tpl');
                    } else {
                        echo SJB_System::executeFunction('miscellaneous', '404_not_found');
                    }
                    break;
            }
            return;
        }

        $posts = SJB_BlogManager::getBlogPosts('date', 'DESC', $page, 10, true);
        $tp->assign('posts', $posts);
        $tp->display('blog.tpl');
    }
}