<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->product = $product;
    }

    public function createProduct($product)
    {
        return $product->save();
    }

    public function showProduct($productId)
    {
        return $this->product->where('id', $productId)->get();
    }

    public function editProduct($productId)
    {
        return $this->product->find($productId);
    }

    public function findProductById($productId)
    {
        return $this->product->findOrFail($productId);
    }

    public function getAllProducts()
    {
        return $this->product->count();
    }

    public function deleteProduct($productId)
    {
        $this->product->where('id', $productId)->delete();
    }

    public function searchProduct($query)
    {
        return $this->product->query()->where('name', 'like', '%' . $query . '%')->get();
    }

    public function getProducts()
    {
        return $this->product->with('category', 'brand')->paginate(3);
    }

    public function getProductswithCategories($categoryId)
    {
        return $this->product->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('categories.id', $categoryId)->get();
    }

}


