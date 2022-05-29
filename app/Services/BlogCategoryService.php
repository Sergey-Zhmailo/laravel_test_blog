<?php

namespace App\Services;

use App\Models\BlogCategory;

/**
 * Class BlogCategoryService.
 */
class BlogCategoryService
{
    public static function getEdit($id)
    {
        return BlogCategory::find($id);
    }
    
    public static function getForComboBox()
    {
//        return BlogCategory::all();
        $fields = implode(',', [
            'id',
            'CONCAT (id, ". ", title) as id_title'
        ]);
        
//        $result[] = BlogCategory::select('blog_categories.*',
//            \DB::raw('CONCAT (id, ". ", title) as id_title'))
//            ->toBase()
//            ->get();
//        dd($result);
        $result = BlogCategory::selectRaw($fields)
            ->toBase()
            ->get();
        
//        dd($result);
        
        return $result;
    }
    
    public static function getAllWithPaginate($perPage = null)
    {
        $fields = ['id', 'title', 'parent_id'];
        
        $result = BlogCategory::select($fields)->paginate($perPage);
        
        return $result;
    }
}
