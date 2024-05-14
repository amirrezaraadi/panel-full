<?php

namespace App\Http\Controllers;

use App\Models\Manager\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repository\Manager\productRepo;
use App\Service\JsonResponse;

class ProductController extends Controller
{
    public function __construct(public productRepo $productRepo)
    {
    }

    public function index()
    {
        return $this->productRepo->index();
    }

    public function store(StoreProductRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->productRepo->create($request->only(
            'title',
            'title_en',
            'body',
            'price'
        ));
        return JsonResponse::SuccessResponse('delete', 'success');

    }


    public function show($product)
    {
        return $this->productRepo->getFirstId($product);
    }

    public function update(UpdateProductRequest $request, $product): \Illuminate\Http\JsonResponse
    {

    }

    public function destroy($product): \Illuminate\Http\JsonResponse
    {
        $this->productRepo->delete($product);
        return JsonResponse::SuccessResponse('delete', 'success');
    }
}
