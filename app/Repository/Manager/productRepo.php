<?php

namespace App\Repository\Manager;

use App\Http\Controllers\ProductController;
use App\Models\Manager\Product;
use App\Service\sluggable;
use Illuminate\Support\Str;

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
        return $this->quety->create([
            'title' => $data['title'],
            'slug' => sluggable::generate(Product::class , $data['title'] ),
            'title_en' => $data['title_en'],
//            'slug_en' => Str::slug($data['slug_en']),
            'body' => $data['body'],
            'price' => $data['price'],
            'user_id' => auth()->id(),
        ]);
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

    public function update( $data, $product)
    {
        $productId = $this->getFirstId($product);
        return $this->quety->create([
            'title' => $data['title'] ?? $productId->title,
            'slug' => sluggable::generate(Product::class , $data['title']  ?? $productId->title),
            'title_en' => $data['title_en']  ?? $productId->title_en,
//            'slug_en' => Str::slug($data['slug_en']),
            'body' => $data['body']  ?? $productId->body,
            'price' => $data['price'] ?? $productId->price,
            'user_id' => auth()->id(),
        ]);
    }

    public function status($id, $status)
    {
        return $this->quety->where('id' , $id)->update([
           'status' => $status
        ]);
    }
}
