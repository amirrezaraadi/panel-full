<?php

namespace App\Repository\Manager;

use App\Models\Manager\Tag;
use App\Service\sluggable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function getFindMulti($request)
    {
        $explode = $this->explodeId($request);
        $tagIds = [];
        foreach ($explode as $id) {
            $tag = Tag::query()->firstOrCreate(
                ['title' => $id],
                ['title' => $id, 'slug' => Str::slug($id), 'user_id' => auth()->id()]
            );
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }

    private function explodeId($tags)
    {
        $tagsArray = explode(',', $tags);
        return array_map(function ($tag) {
            return preg_replace('/[\[\]\s]+/', '', $tag);
        }, $tagsArray);
//        return explode(',', $tags);
    }

    public function morphTags($tags,  $article)
    {
        return DB::table('taggables')->insert([
            'taggable_id' => $article,
            'taggable_type' => get_class($article),
            'tag_id' => $tags,
            'user_id' => auth()->id()
        ]);
    }

}

/*   زوش دوم برای تگ ها
        public function getFindMulti($tags): array
    {
        $ids = $this->explodeId($tags);
        return $this->query->whereIn('id', $ids)->get()->pluck('id')->toArray();
   }
 private function explodeId($tags)
    {
             return explode(',', $tags);
    }
*/
