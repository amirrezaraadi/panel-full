<?php

namespace App\Repository\Manager;
use App\Models\Manager\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

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


}
