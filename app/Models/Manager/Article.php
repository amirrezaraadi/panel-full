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
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes, Sluggable,
        HasImage, HasCategory, HasTag,
        HasBookMark, HasLike, HasComment;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'summary',
        'min_read',
        'short_link',
        'status',
        'author_id',
    ];
    protected $hidden = [
        'image' ,
        'deleted_at' ,
        'updated_at' ,
        'status' ,
        'author_id' ,
        ];

    public static function booted(): void
    {
        static::saving(function ($article) {
            $article->short_link = Str::random(15);
        });
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
    protected $appends = ['article_image'];
    public function getArticleImageAttribute(): string
    {
        return asset('images/articles/' . $this->image->url ?? null);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function path()
    {
        return route('article/', $this->id . '-' . $this->slug);
    }

}
