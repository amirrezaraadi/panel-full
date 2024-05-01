<?php

namespace App\Repository\Attribute;

use App\Models\AttributeSite\Comment;
use App\Models\RolePermission\Permission;

class commentRepo
{
    public $query;

    public function __construct()
    {
        $this->query = Comment::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        return Comment::query()->create([
            "user_id" => auth()->id(),
            "status" => (auth()->user()->can(Permission::PERMISSION_MANAGE_COMMENTS) ||
                auth()->user()->can(Permission::PERMISSION_ADMIN))
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
        return Comment::query()->where('id', $comment)->delete();
    }

    public function searchBody($body)
    {
        $this->query->where("body", "like", "%" . $body . "%");
        return $this;
    }

    public function searchStatus($status)
    {
        if ($status)
            $this->query->where("status", $status);
        return $this;
    }

    public function searchEmail($email)
    {
        $this->query->whereHas("user", function ($q) use ($email) {
            return $q->where("email", "like", "%" . $email . "%");
        });

        return $this;
    }

    public function searchName($name)
    {
        $this->query->whereHas("user", function ($q) use ($name) {
            return $q->where("name", "like", "%" . $name . "%");
        });

        return $this;
    }

    public function paginateParents($status = null)
    {
        return $this->query->latest()->paginate();
    }

}
