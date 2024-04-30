<?php

namespace App\Http\Controllers\Front;

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
        $articleId = $slug;
        $articlesRepo = $this->articleRepo->getBySlug($articleId);
        $articlesRepo->load([
            'author' => function ($query) {
                return $query->select(['users.id', 'users.name', 'users.profile', 'users.email']);
            }, 'tags' => function ($query) {
                return $query->select(['tags.id', 'tags.title']);
            }, 'categories' => function ($query) {
                return $query->select(['categories.id', 'categories.title']);
            }, 'comments' => function ($query) {
                return $query->where('comment_id', null)->where('status', Comment::STATUS_APPROVED);
            }])->loadCount('comments', 'liked', 'bookmarks')->append(['article_image']);
//        $category = $articlesRepo->categories()->get()->pluck('id');
        $articlesRepo->makeHidden(['image', 'summary', 'status', 'author_id', 'updated_at']);
//        Cache::add('__Articles__Single__Page__route__' . $articlesRepo->title, $articlesRepo,
//            now()->addMinutes(300));
        return response()->json(['data' => $articlesRepo], 200);
    }

    public function categoryArticle($category, categoryRepo $categoryRepo)
    {
        $ArticleInCategory = $categoryRepo->getArticleInCategory($category);
        $articleData = $ArticleInCategory->articles;
        return response()->json(['data' => $articleData], 200);
    }
}
