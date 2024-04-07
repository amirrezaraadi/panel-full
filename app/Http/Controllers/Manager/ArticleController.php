<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Manager\Article;
use App\Service\JsonResponse;
use SEO;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all();

        foreach ($articles as $article )
        {
            SEO::setTitle($article->title);
            SEO::setDescription($article->description);
        }
        return response()->json([
            'articles' => $article,
            'seo' => SEO::generate(),
        ]);
    }

    public function store(StoreArticleRequest $request)
    {
        Article::query()->create([
           'title' => $request->title  ,
           'description' => $request->description
        ]);

        return JsonResponse::SuccessResponse('create article success' , 'success');
    }


    public function show(Article $article)
    {
        //
    }


    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }


    public function destroy(Article $article)
    {
        //
    }
}
