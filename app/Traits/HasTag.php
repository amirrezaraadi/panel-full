<?php

namespace App\Traits;

use App\Models\Manager\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTag
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
