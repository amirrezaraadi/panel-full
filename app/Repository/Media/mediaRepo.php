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

    public function createFile($path , $model)
    {
        return $this->query->create([
            'url' => $path,
            'imageable_type' => get_class($model),
            'imageable_id' => $model->id,
            'user_id' => auth()->id(),
        ]);
    }
}
