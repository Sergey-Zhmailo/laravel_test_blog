<?php

namespace App\Services;

use App\Models\BlogPost;

/**
 * Class BlogPostService.
 */
class BlogPostService
{
    public static function getAllWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];
        
        $result = BlogPost::select($columns)
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
        
        return $result;
    }
}
