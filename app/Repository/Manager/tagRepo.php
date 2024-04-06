<?php

namespace App\Repository\Manager;

use App\Models\Manager\Tag;
use App\Service\sluggable;

class tagRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Tag::query();
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function create($data)
    {
        return $this->query->create([
            'title' => $data['title'],
            'slug' => sluggable::generate(Tag::class, $data['title']),
            'user_id' => auth()->id(),
        ]);
    }

    public function createMorhph($data, $model)
    {
        return $this->query->create([
            'title' => $data['title'],
            'slug' => sluggable::generate(Tag::class, $data['title']),
            'user_id' => auth()->id(),
            'taggable_type' => $model,
            'taggable_id' => $model->id
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function update($data, $id)
    {
        $tagId = $this->getFindId($id);
        return $this->query->where('id', $id)->update([
            'title' => $data['title'] ?? $tagId->title,
            'slug' => sluggable::generate(Tag::class, $data['title']
                ?? $tagId->title),
            'user_id' => auth()->id(),
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id', $id)->delete();
    }

    public function status($id, $STATUS_USER_PENDING)
    {
        return $this->query->where('id', $id)
            ->update([
                'status' => $STATUS_USER_PENDING
            ]);
    }
}
