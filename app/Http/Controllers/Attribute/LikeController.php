<?php

namespace App\Http\Controllers\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\AttributeSite\Like;
use App\Repository\Attribute\likeRepo;
use App\Repository\Manager\articleRepo;
use App\Service\JsonResponse;
use App\Service\morph;
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

    public function store(StoreLikeRequest $request): \Illuminate\Http\JsonResponse
    {
        $likes = morph::morph($request);
        $like = $this->likeRepo->store($likes);
        if($like === false)
            return JsonResponse::SuccessResponse('Dislike done right :)', 'success');
        if($like === true)
            return JsonResponse::SuccessResponse('like Again :)', 'success');
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
