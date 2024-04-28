<?php

namespace App\Repository\Manager;
use App\Models\Manager\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;

class categoryRepo
{
    public function index()
    {
        return Category::query()->get();
    }

    public function create($data , $icon)
    {
            return Category::query()->create([
                'title' => $data['title'],
                'slug' =>  SlugService::createSlug(Category::class, 'slug', $data['title']),
                'icon' => $icon,
                'parent_id' => $data['parent_id'],
                'user_id' => auth()->id(),
            ]);
    }

    public function getFindId($id)
    {
        return Category::query()->findOrFail($id);
    }

    public function getFindName($data)
    {
        $title = $this->getFindArray($data);
        return Category::query()->whereIn('title' , $title)->get()->pluck('id')->toArray();
    }

    public function update($data  , $id   , $icon)
    {
        $category = $this->getFindId($id);
        return Category::query()->where('id' , $id)->update([
            'title' => $data['title'] ?? $category->title,
            'slug' =>  SlugService::createSlug(Category::class, 'slug', $data['title'] ?? $category->title) ,
            'icon' => $icon ?? $category->icon ,
            'parent_id' => $data['parent_id'] ?? $category->parent_id,
            'user_id' => auth()->id() ,
        ]);
    }

    public function delete($id)
    {
        return Category::query()->where('id' , $id)->delete();
    }

    public function status($id , $status)
    {
        $this->getFindId($id);
        return Category::query()->where('id' , $id)->update([
           'status' => $status
        ]);
    }

//    public function getFindArray($name)
//    {
//        return explode(',' , $name);
//    }
    private function getFindArray($categories)
    {
        $tagsArray = explode(',', $categories);
        return array_map(function ($category) {
            return preg_replace('/[\[\]\s]+/', '', $category);
        }, $tagsArray);
//        return explode(',', $categories);
    }

    public function morphCategory($category , $article)
    {
        $categoreable = [];
        foreach ($category as $item) {
            $categoreable[] = [
                'category_id' =>  $item,
                'categorizable_type' =>  get_class($article),
                'categorizable_id' =>  $article->id,
                'user_id' => auth()->id()
            ];
        }
        return DB::table('categorizables')->insert($categoreable);
    }

    public function deleteMorphCategory($id)
    {
        foreach ($id->categories()->get() as $category) {
            DB::table('categorizables')->where('categorizable_id' , $id->id)
                ->orWhere('categorizable_type' , $id )->delete();
        }
    }

}
