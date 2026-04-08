<?php

class SJB_BlogPostDetails extends SJB_ObjectDetails
{
    public static function getDetails()
    {
        $details = [
            [
                'id' => 'title',
                'caption' => 'Title',
                'type' => 'string',
                'length' => '255',
                'is_required' => true,
                'is_system' => true,
                'order' => 0,
            ],
            [
                'id' => 'text',
                'caption' => 'Content',
                'type' => 'text',
                'maxlength' => '999999999',
                'is_required' => false,
                'is_system' => true,
                'order' => 1,
            ],
            [
                'id' => 'categories',
                'caption' => 'Categories',
                'type' => 'text',
                'is_required' => false,
                'is_system' => false,
                'save_into_db' => false,
                'order' => 2,
                'template' => 'blog_categories.tpl',
            ],
            [
                'id' => 'image',
                'caption' => 'Image',
                'type' => 'picture',
                'length' => '255',
                'is_required' => false,
                'is_system' => true,
                'order' => 3,
                'width' => 700,
                'height' => 700,
            ],
            [
                'id' => 'date',
                'caption' => 'Publish Date',
                'type' => 'date',
                'length' => '20',
                'is_required' => false,
                'is_system' => true,
                'order' => 4,
            ],
            [
                'id' => 'url',
                'caption' => 'URL',
                'type' => 'string',
                'is_required' => false,
                'is_system' => true,
                'order' => 5,
                'template' => 'blog_url.tpl',
            ],
            [
                'id' => 'description',
                'caption' => 'Meta Description',
                'type' => 'text',
                'length' => '65000',
                'is_required' => false,
                'is_system' => true,
                'order' => 6,
                'template' => 'textarea.tpl',
            ],
            [
                'id' => 'keywords',
                'caption' => 'Meta Keywords',
                'type' => 'string',
                'length' => '255',
                'is_required' => false,
                'is_system' => true,
                'order' => 7,
            ],
            [
                'id' => 'active',
                'caption' => 'Active',
                'type' => 'boolean',
                'default_value' => 1,
                'is_required' => false,
                'is_system' => true,
                'order' => 8,
            ],
        ];
        return $details;
    }
}
