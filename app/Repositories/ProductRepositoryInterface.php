<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function createProduct(Product $product);

    public function showProduct($productId);

    public function editProduct($productId);

    public function deleteProduct($productId);

    public function getAllProducts();

    public function searchProduct($query);

    public function findProductById($productId);

    public function getProductswithCategories($categoryId);

    public function getProducts();

}


