<?php

namespace App\Http\Controllers\Attribute;

use App\Events\Attribute\CommentSubmittedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\AttributeSite\Comment;
use App\Repository\Attribute\commentRepo;
use App\Service\JsonResponse;
use App\Service\morph;

class CommentController extends Controller
{
    public function __construct(public commentRepo $commentRepo){}

    public function index()
    {
        return $this->commentRepo->index();
    }


    public function store(StoreCommentRequest $request)
    {
        $commets = $this->commentRepo->create($request->all());
//        event(new CommentSubmittedEvent($commets));
        return JsonResponse::SuccessResponse('success' , 'success');
    }

    public function show(Comment $comment)
    {
        //
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
