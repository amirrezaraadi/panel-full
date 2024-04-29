<?php

namespace App\Traits;

use App\Models\AttributeSite\Like;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait HasLike
{
    use HasRelationships ;
    public function liked()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

}
