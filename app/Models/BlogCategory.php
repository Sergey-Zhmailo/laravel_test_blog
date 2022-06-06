<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperBlogCategory
 *
 * @package App\Models
 *
 * @property-read \App\Models\BlogCategory $parentCategory
 * @property-read string $parentTitle
 */
class BlogCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    const ROOT = 1;
    
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
    
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }
    
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
                 ?? ($this->isRoot() ? 'Root' : '?');
        
        return $title;
    }
    
    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }
    
    /**
     * accessor
     * @param $valueFromObject
     *
     * @return array|false|string|string[]|null
     */
    public function getTitleAttribute($valueFromObject) {
        return mb_strtoupper($valueFromObject);
    }
    
    // error make
//    protected function title(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => mb_strtoupper($value),
//        );
//    }
    
    /**
     * mutator
     * @param $incomingValue
     */
    public function setTitleAttribute($incomingValue) {
        $this->attributes['title'] = mb_strtolower($incomingValue);
    }
}
