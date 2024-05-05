<?php

namespace App\Http\Controllers\Front;

use App\Events\Views\VisitEvent;
use App\Http\Controllers\Controller;
use App\Models\AttributeSite\Comment;
use App\Repository\Manager\articleRepo;
use App\Repository\Manager\categoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingArticleController extends Controller
{
    public function __construct(public articleRepo $articleRepo)
    {
    }

    public function index()
    {
        return $this->articleRepo->landingArticleSuccess();
    }

    public function single($slug)
    {
        $articleSingle = $this->articleRepo->frontSingleArticle($slug) ;
//        event(new VisitEvent($articleSingle));
//        Cache::add('__Articles__Single__Page__route__' . $articlesRepo->title, $articlesRepo,
//            now()->addMinutes(300));
        return response()->json(['data' => $articleSingle], 200);
    }

    public function categoryArticle($category, categoryRepo $categoryRepo)
    {
        $ArticleInCategory = $categoryRepo->getArticleInCategory($category);
        $articleData = $ArticleInCategory->articles;
        return response()->json(['data' => $articleData], 200);
    }
}
