<?php

namespace App\Repository\Media ;
use App\Models\Media\Image;

class mediaRepo
{
    private $query ;
    public function __construct()
    {
        $this->query = Image::query() ;
    }

    public function index()
    {
        return $this->query->paginate();
    }

    public function createFile($path , $article)
    {
        return $this->query->create([
            'url' => $path,
            'imageable_type' => get_class($article),
            'imageable_id' => $article->id,
            'user_id' => auth()->id(),
        ]);
    }
}
