<?php

namespace App\Repository\Manager;

use App\Models\Manager\Article;

class articleRepo
{
    public $article ;
    public function __construct(){ $this->article = Article::query() ;}
    public function index()
    {
        return $this->article->orderByDesc('created_at')->paginate();
    }

    public function create($data)
    {
        dd($data);
    }






}
