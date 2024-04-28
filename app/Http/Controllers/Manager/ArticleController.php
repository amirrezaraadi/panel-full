<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Manager\Article;
use App\Repository\Manager\articleRepo;
use App\Repository\Manager\categoryRepo;
use App\Repository\Manager\tagRepo;
use App\Repository\Media\mediaRepo;
use App\Service\ContentText;
use App\Service\ImageService;
use App\Service\JsonResponse;
use Illuminate\Support\Str;
use SEO;

class ArticleController extends Controller
{
    public function __construct(public articleRepo  $articleRepo,
                                public tagRepo      $tagRepo,
                                public categoryRepo $categoryRepo,
                                public mediaRepo    $mediaRepo
    )
    {
    }

    public function index()
    {
        return $this->articleRepo->index();
    }

    public function store(StoreArticleRequest $request)
    {
        $article = $this->articleRepo->create($request);
        if ($request->image) {
            $path = ImageService::generate($request->file('image'));
            $media = $this->mediaRepo->createFile($path, $article);
        }
        if ($request->get('tags')) {
            $tags = $this->tagRepo->getFindMulti($request->get('tags'));
            $tagMorph = $this->tagRepo->morphTags($tags, $article);
        }
        if ($request->get('category_id')) {
            $category = $this->categoryRepo->getFindName($request->get('category_id'));
            $categoryMorph = $this->categoryRepo->morphCategory($category , $article );
            dd($categoryMorph);
        }
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
