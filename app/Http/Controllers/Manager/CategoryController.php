<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Manager\Category;
use App\Repository\Manager\categoryRepo;
use App\Service\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(public categoryRepo $categoryRepo)
    {
    }

    public function index()
    {
         $categories = $this->categoryRepo
            ->searchTitle(request('title'))
            ->searchName(request('name'))
            ->searchEmail(request('email'))
            ->searchStatus(request('status'));

        return $categories->paginageCategorey();
    }

    public function store(StoreCategoryRequest $request)
    {
        //  TODO -> send image module
        $image = 'dsadasd';
        $this->categoryRepo->create($request->only(['title', 'parent_id']), $image);
        return JsonResponse::SuccessResponse('success create category', 'success');
    }

    public function show($category)
    {
        return $category = $this->categoryRepo->getFindId($category);
    }

    public function update(UpdateCategoryRequest $request, $category)
    {
        $image = 'sdsada';
        $this->categoryRepo->update($request->only(['title', 'parent_id']), $category, $image);
        return JsonResponse::SuccessResponse('success create category', 'success');

    }

    public function destroy($category)
    {
        $delete = $this->categoryRepo->delete($category);
        if ($delete === 0) return JsonResponse::NotFoundResponse('not found category', 'error');
        return JsonResponse::SuccessResponse('success delete category', 'success');
    }

    public function success($id)
    {
        $this->categoryRepo->status($id , Category::STATUS_USER_SUCCESS);
        return JsonResponse::SuccessResponse('success change status' , 'success');
    }

    public function reject($id)
    {
        $this->categoryRepo->status($id , Category::STATUS_USER_REJECT);
        return JsonResponse::SuccessResponse('success change status' , 'success');
    }

    public function pending($id)
    {
        $this->categoryRepo->status($id , Category::STATUS_USER_PENDING);
        return JsonResponse::SuccessResponse('success change status' , 'success');
    }

}
