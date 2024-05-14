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

    public function getFirstId($id)
    {
        return $this->quety->firstWhere('id' , $id);
    }

    public function getFindOrFail($id)
    {
        return $this->quety->findOrFail($id);
    }

    public function delete($product)
    {
        $this->getFindOrFail($product);
        return $this->quety->where('id' , $product)->delete();
    }
}
