<?php

namespace App\Models\Manager;

use App\Models\Media\Image;
use App\Models\User;
use App\Traits\HasBookMark;
use App\Traits\HasComment;
use App\Traits\HasLike;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class LatestNews extends Model
{
    use HasFactory, SoftDeletes, Sluggable,
        HasBookMark, HasLike, HasComment;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'summary',
        'min_read',
        'short_link',
        'status',
        'reporter_id',
    ];
    protected $table = 'news';

    protected $hidden = ['image'];

    public static function booted(): void
    {
        static::saving(function ($new) {
            $new->short_link = Str::random(15);
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
    protected $appends = ['news_image'];
    public function getNewsImageAttribute(): string
    {
        return asset('images/news/' . $this->image->url ?? null);
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
    public function path()
    {
        return route('news/', $this->id . '-' . $this->slug);
    }
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
