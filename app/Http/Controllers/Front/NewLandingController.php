<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repository\Manager\categoryRepo;
use App\Repository\Manager\newRepo;

class NewLandingController extends Controller
{
    public function __construct(public newRepo $newRepo){}

    public function index()
    {
        return $this->newRepo->landingArticleSuccess();
    }

    public function single($slug)
    {
        $newSingle = $this->newRepo->frontSingleNews($slug);
//        Cache::add('__Articles__Single__Page__route__' . $articlesRepo->title, $articlesRepo,
//            now()->addMinutes(300));
        return response()->json(['data' => $newSingle], 200);
    }

    public function categoryArticle($category, categoryRepo $categoryRepo)
    {
        $ArticleInCategory = $categoryRepo->getArticleInCategory($category);
        $articleData = $ArticleInCategory->articles;
        return response()->json(['data' => $articleData], 200);
    }
}
