<?php

namespace App\Service;
use Cviebrock\EloquentSluggable\Services\SlugService;

class sluggable
{
    public static function generate($model , $title)
    {
        return SlugService::createSlug($model , 'slug', $title);
    }
}
