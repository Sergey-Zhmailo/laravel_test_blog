<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }
    
    /**
     * Handle the BlogPost "before create" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setUser($blogPost);
        $this->setHtml($blogPost);
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }
    
    /**
     * Handle the BlogPost "before update" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
//        $test[] = $blogPost->isDirty(); // изменялась ли модель, если хоть одно поле, то  true
//        $test[] = $blogPost->isDirty('is_published'); // изменялась ли конкретное поле
//        $test[] = $blogPost->getAttribute('is_published'); // получить значение измененного поля
//        $test[] = $blogPost->is_published; // получить значение измененного поля
//        $test[] = $blogPost->getOriginal('is_published'); // получить значение старого значения
//        dd($test);
        
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
//        return false; // отменить сохранение, вернуть ошибку
    }
    
    protected function setPublishedAt(BlogPost $blogPost) {
        
        if (empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
//        dd($blogPost->published_at);
    }
    
    protected function setSlug(BlogPost $blogPost) {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }
    
    protected function setHtml(BlogPost $blogPost) {
        if ($blogPost->isDirty('content_raw')) {
            // TODO make html generation
            $blogPost->content_html = $blogPost->content_raw;
        }
    }
    
    protected function setUser(BlogPost $blogPost) {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
