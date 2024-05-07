<?php

namespace App\Traits;

use App\Models\AttributeSite\Bookmark;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait HasBookMark
{
    use HasRelationships ;
    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function bookmark()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable')
            ->where("is_state", 1);
    }
}
