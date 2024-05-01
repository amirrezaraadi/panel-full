<?php

namespace App\Repository\Attribute;

use App\Models\AttributeSite\Comment;
use App\Models\RolePermission\Permission;

class commentRepo
{
    public $query ;
    public function __construct()
    {
        $this->query =  Comment::query() ;
    }

    public function index()
    {
        return  $this->query->paginate();
    }

    public function create($data)
    {
        return Comment::query()->create([
            "user_id" => auth()->id(),
            "status" => (auth()->user()->can(Permission::PERMISSION_MANAGE_COMMENTS) ||
                auth()->user()->can(Permission::PERMISSION_TEACH))
                ?
                Comment::STATUS_APPROVED
                :
                Comment::STATUS_NEW,
            "comment_id" => array_key_exists("comment_id", $data) ? $data["comment_id"] : null,
            "body" => $data["body"],
            "commentable_id" => $data["commentable_id"],
            "commentable_type" => $data["commentable_type"],
        ]);
    }
    public function findOrFail($id)
    {
        return Comment::query()->findOrFail($id);
    }

    public function delete($comment)
    {
        $id = $this->findOrFail($comment);
        return Comment::query()->where('id' , $comment)->delete();
    }
}
