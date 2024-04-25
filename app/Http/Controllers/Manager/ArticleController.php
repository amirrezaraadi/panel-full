<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Manager\Article;
use App\Repository\Manager\articleRepo;
use App\Repository\Manager\categoryRepo;
use App\Repository\Manager\tagRepo;
use App\Service\JsonResponse;
use SEO;

class ArticleController extends Controller
{
    public function __construct(public articleRepo  $articleRepo,
                                public tagRepo      $tagRepo,
                                public categoryRepo $categoryRepo)
    {
    }

    public function index()
    {
        return $this->articleRepo->index();
    }

    public function store(StoreArticleRequest $request)
    {
        $category = $this->categoryRepo->getFindName($request->get('category_id'));
        dd($category);
        return JsonResponse::SuccessResponse('create article success', 'success');
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
