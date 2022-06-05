<?php

namespace App\Services;

use App\Models\BlogPost;

/**
 * Class BlogPostService.
 */
class BlogPostService
{
    public function getAllWithPaginate($perPage = null)
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
//            ->with(['category', 'user'])
            ->with([
                'category' => function($query) {
                $query->select(['id', 'title']);
                },
                'user:id,name',
])
            ->paginate($perPage);
        
        return $result;
    }
    
    public function getEdit($id)
    {
        return BlogPost::find($id);
    }
}
