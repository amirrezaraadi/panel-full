<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Manager\Tag;
use App\Repository\Manager\tagRepo;
use App\Service\JsonResponse;

class TagController extends Controller
{
    public function __construct(public tagRepo $tagRepo)
    {
    }

    public function index()
    {
        return $this->tagRepo->index();
    }

    public function store(StoreTagRequest $request)
    {
        $this->tagRepo->create($request->only('title'));
        return JsonResponse::SuccessResponse('success create tag', 'success');
    }

    public function show($tag)
    {
        return $this->tagRepo->getFindId($tag);
    }

    public function update(UpdateTagRequest $request, $tag)
    {
        $this->tagRepo->update($request, $tag);
        return JsonResponse::SuccessResponse('Editing was done correctly ', 'success');
    }
    public function destroy( $tag)
    {
        $delete = $this->tagRepo->delete($tag);
        if ($delete === 0) return JsonResponse::NotFoundResponse('not found tags', 'error ');
        return JsonResponse::SuccessResponse('success delete tags ', 'success');
    }
    public function success($id)
    {
        $this->tagRepo->status($id , Tag::STATUS_USER_SUCCESS);
        return JsonResponse::SuccessResponse('success change status' , 'success');
    }

    public function reject($id)
    {
        $this->tagRepo->status($id , Tag::STATUS_USER_REJECT);
        return JsonResponse::SuccessResponse('success change status' , 'success');
    }

    public function pending($id)
    {
        $this->tagRepo->status($id , Tag::STATUS_USER_PENDING);
        return JsonResponse::SuccessResponse('success change status' , 'success');
    }

}
