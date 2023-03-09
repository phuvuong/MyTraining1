<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
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

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;

    }

    public function createProduct(array $data)
    {
        if (!empty($data['product_content'])) {
            $product = new Product();
            $product->setProductName($data['product_name']);
            $product->setProductPrice($data['product_price']);
            $product->setProductContent($data['product_content']);
            $product->setCategoryID($data['productCate']);
            $product->setBrandID($data['productBrand']);
            $product->setProductStatus($data['product_status']);
            $image = $data['product_image'];
            $product->setProductImage($image);
            return $this->productRepository->createProduct($product);
        }
    }

    public function updateProduct(array $data, $productId)
    {
        $product = $this->productRepository->findProductById($productId);
        if (!empty($data['product_content'])) {
            $product->setProductName($data['product_name']);
            $product->setProductPrice($data['product_price']);
            $product->setProductContent($data['product_content']);
            $product->setCategoryID($data['productCate']);
            $product->setBrandID($data['productBrand']);
            $product->setProductStatus($data['product_status']);
            $image = $data['product_image'];
            $product->setProductImage($image);
            $product->save();
        }
    }

    public function deleteProduct($productId)
    {
        $this->productRepository->deleteProduct($productId);
    }

    public function searchProduct($query)
    {
        return $this->productRepository->searchProduct($query);
    }

    public function showProduct($productId)
    {
        return $this->productRepository->showProduct($productId);
    }

    public function getProductsWithCategories($categoryId)
    {
        return $this->productRepository->getProductsWithCategories($categoryId);
    }

    public function getProducts()
    {
        return $this->productRepository->getProducts();
    }

}
