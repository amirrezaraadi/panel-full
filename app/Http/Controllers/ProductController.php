<?php

namespace App\Http\Controllers;

use App\Models\Manager\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repository\Manager\categoryRepo;
use App\Repository\Manager\productRepo;
use App\Repository\Manager\tagRepo;
use App\Repository\Media\mediaRepo;
use App\Service\ImageService;
use App\Service\JsonResponse;

class ProductController extends Controller
{
    public function __construct(public productRepo  $productRepo,
                                public tagRepo      $tagRepo,
                                public categoryRepo $categoryRepo,
                                public mediaRepo    $mediaRepo)
    {
    }

    public function index()
    {
        return $this->productRepo->index();
    }

    public function store(StoreProductRequest $request): \Illuminate\Http\JsonResponse
    {
        $product = $this->productRepo->create($request->only(
            'title',
            'title_en',
            'body',
            'price'
        ));
        if ($request->image) {
            $path = ImageService::generate($request->file('image'));
            $media = $this->mediaRepo->createFile($path, $product);
        }
        if ($request->get('tags')) {
            $tags = $this->tagRepo->getFindMulti($request->get('tags'));
            $tagMorph = $this->tagRepo->morphTags($tags, $product);
        }
        if ($request->get('category_id')) {
            $category = $this->categoryRepo->getFindName($request->get('category_id'));
            $categoryMorph = $this->categoryRepo->morphCategory($category, $product);
        }
        return JsonResponse::SuccessResponse('delete', 'success');

    }


    public function show($product)
    {
        return $this->productRepo->getFirstId($product);
    }

    public function update(UpdateProductRequest $request, $product): \Illuminate\Http\JsonResponse
    {
        $producrId = $this->productRepo->getFindOrFail($product);
        $productss = $this->productRepo->update($request->only(
            'title',
            'title_en',
            'body',
            'price'
        ), $product);
        if ($request->image) {
            $deleteImage = ImageService::deleteImageArticle($producrId);
            $path = ImageService::generate($request->file('image'));
            $media = $this->mediaRepo->createFile($path, $producrId);
        }
        if ($request->get('tags')) {
            $deleteTags = $this->tagRepo->deleteMorphTag($producrId);
            $tags = $this->tagRepo->getFindMulti($request->get('tags'));
            $tagMorph = $this->tagRepo->morphTags($tags, $producrId);
        }
        if ($request->get('category_id')) {
            $deleteCategory = $this->categoryRepo->deleteMorphCategory($producrId);
            $category = $this->categoryRepo->getFindName($request->get('category_id'));
            $categoryMorph = $this->categoryRepo->morphCategory($category, $producrId);
        }
        return JsonResponse::SuccessResponse('create article success', 'success');
    }


    public function destroy($product): \Illuminate\Http\JsonResponse
    {

        $id = $this->productRepo->getFindOrFail($product);
        $deleteImage = $id->image()->delete();
        $deleteCategory = $this->categoryRepo->deleteMorphCategory($id);
        $deleteMorphTag = $this->tagRepo->deleteMorphTag($id);
        $delete = $this->productRepo->delete($product);
        return JsonResponse::SuccessResponse('delete Article OK', 'success');
    }

    public function success($id): \Illuminate\Http\JsonResponse
    {
        $this->productRepo->getFindOrFail($id);
        $this->productRepo->status($id, Product::STATUS_SUCCESS);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }

    public function pending($id): \Illuminate\Http\JsonResponse
    {
        $this->productRepo->getFindOrFail($id);
        $this->productRepo->status($id, Product::STATUS_PENDING);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }

    public function reject($id): \Illuminate\Http\JsonResponse
    {
        $this->productRepo->getFindOrFail($id);
        $this->productRepo->status($id, Product::STATUS_REJECT);
        return JsonResponse::SuccessResponse('The situation changed correctly', 'success');
    }
}
