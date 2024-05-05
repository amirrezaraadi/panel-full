<?php

namespace App\Models\Manager;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory , Sluggable , SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'link' ,
        'status' ,
        'user_id',
    ];
    protected $hidden = [
        "updated_at" ,
        "created_at" ,
        "deleted_at" ,
        "user_id" ,
        "status" ,
        "slug" ,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    const STATUS_SUCCESS = 'success';
    const STATUS_REJECT = 'reject';
    const STATUS_PENDING = 'pending';
    static $status = [
        self::STATUS_PENDING,
        self::STATUS_REJECT,
        self::STATUS_SUCCESS
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
