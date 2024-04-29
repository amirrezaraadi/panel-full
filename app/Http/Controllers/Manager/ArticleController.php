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
use App\Service\ImageService;
use App\Service\JsonResponse;

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

    public function store(StoreArticleRequest $request): \Illuminate\Http\JsonResponse
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
            $categoryMorph = $this->categoryRepo->morphCategory($category, $article);
        }
        return JsonResponse::SuccessResponse('create article success', 'success');
    }


    public function show($article)
    {
        return $this->articleRepo->getFindId($article);
    }


    public function update(UpdateArticleRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $articleId = $this->articleRepo->getFindCategory($id);
        $article = $this->articleRepo->update($request, $articleId->id);
        if ($request->image) {
            $deleteImage = ImageService::deleteImageArticle($articleId);
            $path = ImageService::generate($request->file('image'));
            $media = $this->mediaRepo->createFile($path, $articleId);
        }
        if ($request->get('tags')) {
            $deleteTags = $this->tagRepo->deleteMorphTag($articleId);
            $tags = $this->tagRepo->getFindMulti($request->get('tags'));
            $tagMorph = $this->tagRepo->morphTags($tags, $articleId);
        }
        if ($request->get('category_id')) {
            $deleteCategory = $this->categoryRepo->deleteMorphCategory($articleId);
            $category = $this->categoryRepo->getFindName($request->get('category_id'));
            $categoryMorph = $this->categoryRepo->morphCategory($category, $articleId);
        }
        return JsonResponse::SuccessResponse('create article success', 'success');
    }


    public function destroy($article): \Illuminate\Http\JsonResponse
    {
        $id = $this->articleRepo->getFindCategory($article);
        $deleteImage = $id->image()->delete();
        $deleteCategory = $this->categoryRepo->deleteMorphCategory($id);
        $deleteMorphTag = $this->tagRepo->deleteMorphTag($id);
        $delete = $this->articleRepo->delete($article);
        return JsonResponse::SuccessResponse('delete Article OK', 'success');
    }

    public function success($id): \Illuminate\Http\JsonResponse
    {
        $this->articleRepo->getFindCategory($id);
        $this->articleRepo->status($id, Article::STATUS_SUCCESS);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }

    public function pending($id): \Illuminate\Http\JsonResponse
    {
        $this->articleRepo->getFindCategory($id);
        $this->articleRepo->status($id, Article::STATUS_PENDING);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }

    public function reject($id): \Illuminate\Http\JsonResponse
    {
        $this->articleRepo->getFindCategory($id);
        $this->articleRepo->status($id, Article::STATUS_REJECT);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }
}
