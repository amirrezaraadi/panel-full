<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'imageable_type',
        'imageable_id',
        'user_id',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
