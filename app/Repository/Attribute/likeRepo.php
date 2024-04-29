<?php

namespace App\Repository\Attribute;

use App\Models\AttributeSite\Like;
use Illuminate\Support\Facades\DB;
use function Psy\debug;

class likeRepo
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
        $check = $this->checkLike($bookmarkable);
        if (!is_null($check)) {
            $check->delete();
            return true ;
        }
        return Like::query()->create([
            'likeable_type' => get_class($bookmarkable),
            'likeable_id' => $bookmarkable->id,
            'is_state' => 1,
            'user_id' => auth()->user()->id
        ]);
    }

    public function checkLike($bookmarkable)
    {
        return Like::query()->where('likeable_type', get_class($bookmarkable))
            ->orWhere('likeable_id', $bookmarkable->id)
            ->orWhere('user_id', auth()->id())
            ->first();
    }

}
