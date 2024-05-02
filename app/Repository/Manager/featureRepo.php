<?php

namespace App\Repository\Manager;

use App\Models\Manager\Feature;
use App\Service\sluggable;
use Psy\Util\Str;

class featureRepo
{
    public function index()
    {
        return Feature::query()->paginate();
    }

    public function create($data)
    {
        return Feature::query()->create([
            'title' => $data['title'],
            'slug' => sluggable::generate(Feature::class, $data['title']),
            'body' => $data['body'],
            'link' => $data['link'],
            'user_id' => auth()->id(),
        ]);
    }

    public function getFindId($feature)
    {
        return Feature::query()->findOrFail($feature);
    }

    public function update($data, $feature)
    {
        $id = $this->getFindId($feature);
        return Feature::query()->where('id', $feature)->update([
            'title' => $data['title'] ?? $id->title,
            'slug' => sluggable::generate(Feature::class, $data['title'] ?? $id->title),
            'body' => $data['body'] ?? $id->body,
            'link' => $data['link'] ?? $id->link,
            'user_id' => auth()->id(),
        ]);
    }
    public function delete($feature)
    {
        return Feature::query()->where('id', $feature)->delete();
    }

    public function status($id,  $status)
    {
        return Feature::query()->where('id' , $id)->update(['status' => $status]);
    }
}
