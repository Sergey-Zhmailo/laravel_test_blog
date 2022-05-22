<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperBlogCategory
 */
class BlogCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'description',
    ];
//
//    protected $guarded = [
//        '_method',
//        '_token'
//    ];
}
