<?php

namespace App\Observers;


use App\Models\Manager\Article;

class CacheObserver
{

    public function created(Article $article): void
    {
        //
    }


    public function updated(Article $article): void
    {
        //
    }


    public function deleted(Article $article): void
    {
        //
    }


    public function restored(Article $article): void
    {
        //
    }


    public function forceDeleted(Article $article): void
    {
        //
    }
}
