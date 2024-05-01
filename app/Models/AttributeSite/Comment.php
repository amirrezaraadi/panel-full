<?php

namespace App\Models\AttributeSite;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'commentable_type', 'commentable_id', 'user_id', 'comment_id', 'status'];
    const STATUS_NEW = "new";
    const STATUS_APPROVED = "approved";
    const STATUS_REJECTED = "rejected";

    static $statues = [
        self::STATUS_REJECTED,
        self::STATUS_APPROVED,
        self::STATUS_NEW
    ];
    protected $hidden = [
        'deleted_at',
        'updated_at',
        'created_at',
        'comment_id',
        'user_id',
        'commentable_type',
        'commentable_id'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class);
    }

    public function notApprovedComments()
    {
        return $this->hasMany(Comment::class)->where("status", self::STATUS_NEW);
    }

    public function getStatusCssClass()
    {
        if ($this->status == self::STATUS_APPROVED) return "text-success";
        elseif ($this->status == self::STATUS_REJECTED) return "text-error";

        return "text-warning";
    }


}
