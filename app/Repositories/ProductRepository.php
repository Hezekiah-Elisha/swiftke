<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    
    public function all(){
        return Product::all();
    }
    
    public function find($id){
        return Product::findOrFail($id);
    }
    
    public function store($data){
        return Product::create($data);
    }

    public function update(array $data,$id){
        return Product::whereId($id)->update($data);
    }
     
    public function delete($id){
        Product::destroy($id);
    }
}
