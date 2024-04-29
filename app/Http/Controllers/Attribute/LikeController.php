<?php

namespace App\Http\Controllers\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\AttributeSite\Like;
use App\Repository\Attribute\likeRepo;
use App\Repository\Manager\articleRepo;
use App\Service\JsonResponse;
use Psy\Util\Json;

class LikeController extends Controller
{
    public function __construct(public likeRepo $likeRepo)
    {
    }

    public function index()
    {
        //
    }

    public function store(StoreLikeRequest $request, articleRepo $articleRepo): \Illuminate\Http\JsonResponse
    {
        $type = $request->input('type');
        $id = $request->input('id');

        switch ($type) {
            case 'article':
                $bookmarkable = $articleRepo->getFindCategory($id);
                break;
            default:
                return JsonResponse::NotFoundResponse('not model', 'error');
        }
        $like = $this->likeRepo->store($bookmarkable);
        if($like === true)
            return JsonResponse::SuccessResponse('Dislike done right :)', 'success');
        return JsonResponse::SuccessResponse('Liked done right :)', 'success');
    }


    public function show(Like $like)
    {
        //
    }

    public function update(UpdateLikeRequest $request, Like $like)
    {
        //
    }


    public function destroy(Like $like)
    {
        //
    }
}
