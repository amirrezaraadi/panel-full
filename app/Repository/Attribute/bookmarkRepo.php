<?php

namespace App\Repository\Attribute;

use App\Models\AttributeSite\Bookmark;

class bookmarkRepo
{
    public function index_manager()
    {
        // TODO
    }

    public function index_accessed()
    {
        // TODO
    }

    public function index_you_tuber()
    {
        // TODO
    }

    public function index_user()
    {
        // TODO
    }

    public function store($bookmarkable)
    {
        $check = $this->checkBookMark($bookmarkable);

        if (!is_null($check) ) {
            if($check->is_state === 0 ){
                $check->update(['is_state' => 1]);
                return true;
            }
            // $check->delete();
            $check->update(['is_state' => false]);
            return false;
        }
            return Bookmark::query()->create([
                'bookmarkable_type' => get_class($bookmarkable),
                'bookmarkable_id' => $bookmarkable->id,
                'is_state' => 1,
                'user_id' => auth()->user()->id
            ]);
    }

    public function checkBookMark($bookmarkable)
    {
        return Bookmark::query()->where('bookmarkable_type', get_class($bookmarkable))
            ->where('bookmarkable_id', $bookmarkable->id)
            ->where('user_id', auth()->id() )
            ->first();
    }

}
