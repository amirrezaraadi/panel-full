<?php

namespace App\Traits;

use App\Models\Manager\Category;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasCategory
{
    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
