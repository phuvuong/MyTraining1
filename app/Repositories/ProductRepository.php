<?php
namespace App\Repositories;

use App\Models\CategoryProduct;
use App\Models\Product;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->product = $product;

    }

    public function createProduct(Product $product)
    {
        return $product->save();

    }

    public function showProduct($productId)
    {
        return $this->product->where('product_id', $productId)->get();

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
        $this->product->where('product_id', $productId)->delete();

    }

    public function searchProduct($query)
    {
        return $this->product->query()->where('product_name', 'like', '%' . $query . '%')->get();

    }

    public function getProducts()
    {
        return $this->product->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')->paginate(3);
    }

    public function getProductswithCategories($categoryId)
    {
        return $this->product->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->where('categories.category_id', $categoryId)->get();

    }
}


