<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class ProductService
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;

    }
    public function createProduct(array $data)
    {
  
            $product = new Product();
            $product->setProductName($data['product_name']);
            $product->setProductPrice($data['product_price']);
            $product->setProductContent($data['product_content']);
            $product->setCategoryID($data['product_cate']);
            $product->setBrandID($data['product_brand']);
            $product->setProductStatus($data['product_status']);
            $image = $data['product_image'];
            $product->setProductImage($image);
            $image = $product->getProductImage();
            return $this->productRepository->createProduct($product);
         
    }   
    public function updateProduct( array $data , $product_id)
    {
            $product = $this->productRepository->findProductById($product_id);
            $product->setProductName($data['product_name']);
            $product->setProductPrice($data['product_price']);
            $product->setProductContent($data['product_content']);
            $product->setCategoryID($data['product_cate']);
            $product->setBrandID($data['product_brand']);
            $product->setProductStatus($data['product_status']);
            $image = $data['product_image'];
            $product->setProductImage($image);
            $image = $product->getProductImage();
            $product->save();
       
    }
    public function deleteProduct($product_id) {
        $this->productRepository->deleteProduct($product_id);

    }
    public function searchProduct($query){
        return $this->productRepository->searchProduct($query);

    }
    public function showProduct($product_id){
        return $this->productRepository->showProduct($product_id);
        
    }
} 
?>