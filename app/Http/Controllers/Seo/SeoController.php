<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
class SeoController extends Controller
{
    public function sitemap()
    {
        $sitemap=Sitemap::create()
            ->add(Url::create(env('APP_NAME')));

//        Post::all()->each(function(Post $post) use ($sitemap){
//            $sitemap->add(Url::create("/posts/{$post->slug}"));
//        });

        $sitemap->writeTofile(public_path('sitemap.xml'));

        return 'Sitemap Created Succesfully';
    }
}
