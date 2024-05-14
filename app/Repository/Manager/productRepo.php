<?php

namespace App\Repository\Manager;

use App\Models\Manager\Product;

class productRepo
{
    private $quety ;
    public function __construct()
    {
        $this->quety = Product::query();
    }

    public function index()
    {
        return $this->quety->paginate();
    }

    public function create($data)
    {
        return $data ;
    }
}
