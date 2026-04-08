<?php

class SJB_BlogManager extends SJB_ObjectManager
{
    static $uploadFileManager = null;

    /**
     * get instance of upload file manager
     * @return SJB_UploadFileManager
     */
    private static function getUploadFileManager()
    {
        if (self::$uploadFileManager == null)
            self::$uploadFileManager = new SJB_UploadFileManager();
        return self::$uploadFileManager;
    }

    /**
     * Save blog post in database
     * @param SJB_BlogPost $post
     */
    public static function saveBlogPost($post)
    {
        SJB_ObjectDBManager::saveObject('blog', $post);
        $categories = $post->getPropertyValue('categories');
        $categories = explode(',', trim($categories));
        SJB_DB::query('delete from blog_category where blog_id = ?n', $post->getID());
        foreach ($categories as $category) {
            if (empty($category)) {
                continue;
            }
            SJB_DB::query(
                'insert into blog_category (blog_id, category, url) values (?n, ?s, ?s)',
                $post->getID(),
                $category,
                self::categoryToUrl($category)
            );
        }
    }

    /**
     * delete blog post by SID
     * @param integer $postId
     */
    public static function delete($postId)
    {
        // delete picture
        $image = SJB_BlogDBManager::getImageFileIDByArticleSID($postId);
        if ($image) {
            $uploadFileManager = self::getUploadFileManager();
            $uploadFileManager->deleteUploadedFileByID($image);
        }
        SJB_BlogDBManager::delete($postId);
    }

    /**
     * Delete image from blog post
     * @param integer $postId
     */
    public static function deleteBlogPostImage($postId)
    {
        // delete picture
        $image = SJB_BlogDBManager::getImageFileIDByArticleSID($postId);
        if ($image) {
            $uploadFileManager = self::getUploadFileManager();
            $uploadFileManager->deleteUploadedFileByID($image);
        }
    }

    /**
     * get count of all posts
     * @return integer
     */
    public static function getAllPostsCount()
    {
        return SJB_DB::queryValue('SELECT count(*) as count FROM `blog`');
    }

    /**
     * activate blog post by id
     * @param integer $postId
     * @return array|null
     */
    public static function activate($postId)
    {
        return SJB_BlogDBManager::activateItemBySID($postId);
    }

    /**
     * deactivate blog post by id
     * @param integer $postId
     * @return array|null
     */
    public static function deactivate($postId)
    {
        return SJB_BlogDBManager::deactivate($postId);
    }

    public static function getBlogPostInfoBySid($sid, $forView = false)
    {
        $post = SJB_BlogDBManager::getObjectInfo('blog', $sid);
        $fm = new SJB_UploadPictureManager();
        if ($post) {
            if ($forView && $post['image']) {
                $post['image'] = $fm->getUploadedFileLink($post['image']);
            }
            $post['categories'] = [];
            foreach (SJB_DB::query('select category from blog_category where blog_id = ?n', $sid) as $row) {
                $post['categories'][] = $row['category'];
            }
            $post['categories'] = join(',', $post['categories']);
        }
        return $post;
    }

    public static function getBlogPostInfoByUrl($url)
    {
        $sid = SJB_DB::queryValue('select sid from blog where url = ?s or url = ?s', $url, $url . '/');
        $post = SJB_BlogDBManager::getObjectInfo('blog', $sid);
        $fm = new SJB_UploadPictureManager();
        if ($post['image']) {
            $post['image'] = $fm->getUploadedFileLink($post['image']);
        }
        return $post;
    }

    public static function getBlogPostBySid($sid)
    {
        $articleInfo = self::getBlogPostInfoBySid($sid);
        $articleObj = null;
        if (!empty($articleInfo)) {
            $articleObj = new SJB_BlogPost($articleInfo);
            $articleObj->setSID($sid);
        }
        return $articleObj;
    }

    // TODO: fix to work with objects
    /**
     * Get all blog posts
     *
     * @param string $sortingField
     * @param string $sortingOrder
     * @param int $page
     * @param int $itemsPerPage
     * @param bool $activeOnly
     * @param string $category
     * @return array|null
     */
    public static function getBlogPosts($sortingField = 'date', $sortingOrder = 'DESC', $page = 1, $itemsPerPage = 10, $activeOnly = false, $category = '')
    {
        $start = ($page - 1) * $itemsPerPage;
        if ($sortingOrder != 'ASC' && $sortingOrder != 'DESC') {
            $sortingOrder = 'ASC';
        }
        $active = '';
        if ($activeOnly) {
            $active = 'WHERE `active` = 1';
        }
        if ($category) {
            $category = 'inner join blog_category bc on bc.blog_id = b.sid and bc.url = "' . SJB_DB::quote($category) . '"';
        }
        $posts = SJB_DB::query("SELECT b.* FROM `blog` b {$category} {$active} ORDER BY `{$sortingField}` {$sortingOrder}, b.`sid` DESC LIMIT ?n, ?n", $start, $itemsPerPage);
        $fm = new SJB_UploadFileManager();
        foreach ($posts as $key => $post) {
            $post['categories'] = [];
            foreach (SJB_DB::query('select category from blog_category where blog_id = ?n', $post['sid']) as $row) {
                $post['categories'][] = $row['category'];
            }
            if ($post['image']) {
                $posts[$key]['image'] = $fm->getUploadedFileLink($post['image']);
            }
            if (!$post['url']) {
                $post['url'] = "/" . $post['sid'] . "/" . SJB_TemplateProcessor::pretty_url($post['title']);

            }
            if (in_array($_SERVER['REMOTE_ADDR'], array('158.181.241.207'))) {
//                echo '<pre>';
//                var_dump($post);
//                echo '</pre>';
            }


        }
        return $posts;
    }

    public static function getCategories($activeOnly = false)
    {
        $categories = [];
        if ($activeOnly) {
            $rows = SJB_DB::query('select distinct bc.`category`, bc.`url` from `blog_category` bc inner join blog b on b.sid = bc.blog_id where b.active = 1 order by bc.`category`');
        } else {
            $rows = SJB_DB::query('select distinct `category`, `url` from `blog_category` order by `category`');
        }
        foreach ($rows as $row) {
            $categories[$row['url']] = $row['category'];
        }
        return $categories;
    }

    public static function categoryToUrl($category)
    {
        $category = preg_replace('/[^\\pL\\d]/ui', '-', mb_strtolower($category));
        return trim($category, '-');
    }

    public static function isUrlExists($url, $excludeId = 0)
    {
        return SJB_DB::queryValue('select count(*) from blog where url = ?s and sid != ?n', $url, $excludeId);
    }
}
