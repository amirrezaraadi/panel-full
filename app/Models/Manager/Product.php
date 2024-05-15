<?php

namespace App\Models\Manager;

use App\Models\User;
use App\Traits\HasBookMark;
use App\Traits\HasCategory;
use App\Traits\HasComment;
use App\Traits\HasImage;
use App\Traits\HasLike;
use App\Traits\HasTag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable,
        HasImage, HasCategory, HasTag,
        HasBookMark, HasLike, HasComment;

    protected $fillable = [
        'title',
        'slug',
        'title_en',
//        'slug_en',
        'body',
        'status',
        'price',
        'sold_number',
        'frozen_number',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_REJECT = 'reject';
    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_SUCCESS,
        self::STATUS_REJECT,
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
