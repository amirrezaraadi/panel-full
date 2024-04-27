<?php

namespace App\Models\Manager;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'status',
    ];

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
