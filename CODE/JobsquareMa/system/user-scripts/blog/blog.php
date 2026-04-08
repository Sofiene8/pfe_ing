<?php

class SJB_Blog_Blog extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $tp->assign('categories', SJB_BlogManager::getCategories(true));
        
        $page = SJB_Request::getInt('page');
        if (empty($page) || $page < 0) {
            $page = 1;
        }
        $params = SJB_UrlParamProvider::getParams();
        if ($params) {
            $param = array_shift($params);
            switch ($param) {
                case 'rss':
                    header('Content-Type: application/rss+xml; charset=UTF-8');
                    $posts = SJB_BlogManager::getBlogPosts('date', 'DESC', $page, 10, true);
                    $tp->assign('posts', $posts);
                    $tp->display('blog_rss.tpl');
                    exit();
                    break;
                default:
                    $post = false;
                    if (is_numeric($param)) {
                        $post = SJB_BlogManager::getBlogPostInfoBySid($param, true);
                    }

                    if (!empty($post['categories'])) {
                        $post['breadcrumbsCategories'] = explode(',', $post['categories']);
                    }


                    if (!$post) {
                        $post = SJB_BlogManager::getBlogPostInfoByUrl(preg_replace('|^/blog|ui', '', rawurldecode(SJB_Navigator::getURI())));
                    }
                    if ($post) {

                        $tp->_tpl_head([], sprintf('
                            <meta property="og:title" content="%s"/>
                            <meta property="og:site_name" content="%s"/>
                            <meta property="og:type" content="article"/>
                            <meta property="og:image" content="%s"/>
                            <meta property="og:description" content="%s"/>
                            <meta property="og:url" content="%s"/>'
                            ,
                            htmlspecialchars($post['title'], ENT_QUOTES),
                            htmlspecialchars(SJB_Settings::getValue('site_title'), ENT_QUOTES),
                            htmlspecialchars($post['image'], ENT_QUOTES),
                            htmlspecialchars(!empty($post['description']) ? $post['description'] : strip_tags($post['text']), ENT_QUOTES),
                            htmlspecialchars(SJB_HelperFunctions::getUserSiteUrl() . SJB_TemplateProcessor::blog_url($post), ENT_QUOTES)
                        ));
                        $tp->assign('post', $post);
                        $tp->display('blog_item.tpl');
                        return;
                    } else {
                        $posts = SJB_BlogManager::getBlogPosts('date', 'DESC', $page, 10, true, $param);
                        if (!$posts) {
                            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
                            return;
                        }
                        $tp->assign('current_category', $param);
                    }
                    break;
            }
        } else {
            $posts = SJB_BlogManager::getBlogPosts('date', 'DESC', $page, 10, true);
        }

        $tp->assign('posts', $posts);
        $tp->display('blog.tpl');
    }
}