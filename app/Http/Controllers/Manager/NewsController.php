<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Front\News;
use App\Models\Manager\Article;
use App\Repository\Manager\articleRepo;
use App\Repository\Manager\categoryRepo;
use App\Repository\Manager\newRepo;
use App\Repository\Manager\tagRepo;
use App\Repository\Media\mediaRepo;
use App\Service\ImageService;
use App\Service\JsonResponse;

class NewsController extends Controller
{
    public function __construct(public newRepo $newRepo,
                                public tagRepo      $tagRepo,
                                public categoryRepo $categoryRepo,
                                public mediaRepo    $mediaRepo
    )
    {
    }

    public function index()
    {
        $news = $this->newRepo
            ->searchTitle(request("title"))
            ->searchEmail(request("email"))
            ->searchName(request("name"))
            ->searchStatus(request("status"));
//        if (!auth()->user()->hasAnyPermission(Permission::PERMISSION_MANAGE_COMMENTS,
//            Permission::PERMISSION_MANAGE)) {
//            $comments->query->whereHasMorph("commentable", [Article::class], function ($query) {
//                return $query->where("author_id", auth()->id());
//            })->where("status", Comment::STATUS_APPROVED);
//        }

        return  $news->paginateParents();
    }

    public function store(StoreArticleRequest $request): \Illuminate\Http\JsonResponse
    {
        $news = $this->newRepo->create($request);
        if ($request->image) {
            $path = ImageService::generate_new($request->file('image'));
            $media = $this->mediaRepo->createFile($path, $news);
        }
        if ($request->get('tags')) {
            $tags = $this->tagRepo->getFindMulti($request->get('tags'));
            $tagMorph = $this->tagRepo->morphTags($tags, $news);
        }
        if ($request->get('category_id')) {
            $category = $this->categoryRepo->getFindName($request->get('category_id'));
            $categoryMorph = $this->categoryRepo->morphCategory($category, $news);
        }
        return JsonResponse::SuccessResponse('create article success', 'success');
    }


    public function show($article)
    {
        return $this->newRepo->getFindId($article);
    }


    public function update(UpdateArticleRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $news = $this->newRepo->getFindCategory($id);
        $article = $this->newRepo->update($request, $news->id);
        if ($request->image) {
            $deleteImage = ImageService::deleteImage_new($news);
            $path = ImageService::generate_new($request->file('image'));
            $media = $this->mediaRepo->createFile($path, $news);
        }
        if ($request->get('tags')) {
            $deleteTags = $this->tagRepo->deleteMorphTag($news);
            $tags = $this->tagRepo->getFindMulti($request->get('tags'));
            $tagMorph = $this->tagRepo->morphTags($tags, $news);
        }
        if ($request->get('category_id')) {
            $deleteCategory = $this->categoryRepo->deleteMorphCategory($news);
            $category = $this->categoryRepo->getFindName($request->get('category_id'));
            $categoryMorph = $this->categoryRepo->morphCategory($category, $news);
        }
        return JsonResponse::SuccessResponse('create article success', 'success');
    }


    public function destroy($article): \Illuminate\Http\JsonResponse
    {
        $id = $this->newRepo->getFindCategory($article);
        $deleteImage = $id->image()->delete();
        $deleteCategory = $this->categoryRepo->deleteMorphCategory($id);
        $deleteMorphTag = $this->tagRepo->deleteMorphTag($id);
        $delete = $this->newRepo->delete($article);
        return JsonResponse::SuccessResponse('delete Article OK', 'success');
    }

    public function success($id): \Illuminate\Http\JsonResponse
    {
        $this->newRepo->getFindCategory($id);
        $this->newRepo->status($id, Article::STATUS_SUCCESS);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }

    public function pending($id): \Illuminate\Http\JsonResponse
    {
        $this->newRepo->getFindCategory($id);
        $this->newRepo->status($id, Article::STATUS_PENDING);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }

    public function reject($id): \Illuminate\Http\JsonResponse
    {
        $this->newRepo->getFindCategory($id);
        $this->newRepo->status($id, Article::STATUS_REJECT);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }
}
