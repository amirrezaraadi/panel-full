<?php

namespace App\Models\Manager;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable =
        [
            'title',
            'slug',
            'icon',
            'status',
            'parent_id',
            'user_id',
        ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function child(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    const STATUS_USER_SUCCESS = 'success';
    const STATUS_USER_PENDING = 'pending';
    const STATUS_USER_REJECT = 'reject';
    public static $status = [
        self::STATUS_USER_SUCCESS,
        self::STATUS_USER_PENDING,
        self::STATUS_USER_REJECT
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
