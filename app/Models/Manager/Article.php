<?php

namespace App\Models\Manager;

use App\Traits\HasCategory;
use App\Traits\HasImage;
use App\Traits\HasTag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory , SoftDeletes , Sluggable , HasImage , HasCategory , HasTag ;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'summary',
        'min_read',
        'short_link',
        'status',
        'author_id' ,
    ];
        protected $hidden = ['image'];
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
        self::STATUS_SUCCESS];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getArticleImageAttribute(): string
    {
        dd(asset('images/articles/' . $this->image->url ?? null ) );
        return asset('images/articles/' . $this->image->url ?? null ) ;
    }
}
