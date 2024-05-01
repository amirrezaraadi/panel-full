<?php

namespace App\Http\Controllers\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\AttributeSite\Comment;
use App\Models\Manager\Article;
use App\Models\RolePermission\Permission;
use App\Repository\Attribute\commentRepo;
use App\Service\JsonResponse;

class CommentController extends Controller
{
    public function __construct(public commentRepo $commentRepo)
    {
    }

    public function index()
    {
        $comments = $this->commentRepo
            ->searchBody(request("body"))
            ->searchEmail(request("email"))
            ->searchName(request("name"))
            ->searchStatus(request("status"));

//        if (!auth()->user()->hasAnyPermission(Permission::PERMISSION_MANAGE_COMMENTS,
//            Permission::PERMISSION_MANAGE)) {
//            $comments->query->whereHasMorph("commentable", [Article::class], function ($query) {
//                return $query->where("author_id", auth()->id());
//            })->where("status", Comment::STATUS_APPROVED);
//        }

       return  $comments->paginateParents();
    }

    public function store(StoreCommentRequest $request)
    {
        $commets = $this->commentRepo->create($request->all());
//        event(new CommentSubmittedEvent($commets));
        return JsonResponse::SuccessResponse('success', 'success');
    }

    public function show($comment)
    {
        return Comment::query()->where("id", $comment)
            ->with(["commentable", "user", "comments"])->firstOrFail();
    }

    public function update(UpdateCommentRequest $request, $comment)
    {
        return 'not found update  ';
    }

    public function destroy($comment)
    {
        $delete = $this->commentRepo->delete($comment);
        if ($delete === 0)
            return JsonResponse::NotFoundResponse('not found id comment ', 'error');
        return JsonResponse::SuccessResponse('delete comment ', 'success');
    }
}
