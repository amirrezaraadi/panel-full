<?php

namespace App\Models\Manager;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'summary',
        'min_read',
        'short_link',
        'confirmation_status',
        'author_id' ,
    ];


    const CONFIRMATION_SUCCESS = 'success';
    const CONFIRMATION_REJECT = 'reject';
    const CONFIRMATION_PENDING = 'pending';
    static $confirmationStatuses = [
        self::CONFIRMATION_PENDING,
        self::CONFIRMATION_REJECT,
        self::CONFIRMATION_SUCCESS];
    public static function booted(): void
    {
        static::saving(function ($article) {
            $article->short_link = Str::random(15);
        });
    }


    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }


    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
