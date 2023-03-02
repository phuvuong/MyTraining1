<?php
namespace App\Repositories;

use App\Models\CategoryProduct;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ProductRequest;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);

    }
    public function createProduct(Product $product)
    {
        return $product->save();

    }
    public function showProduct($product_id)
    {
        return Product::where('product_id',$product_id)->get();

    }
    public function editProduct($product_id)
    {
        return Product::find($product_id);

    }
    public function findProductById( $product_id)
    {
        return Product::findOrFail($product_id);

    }
    public function getAllProducts()
    {
        return Product::count();

    }
    public function deleteProduct($product_id)
    {
        Product::where('product_id', $product_id)->delete();

    }
    public function searchProduct($query)
    {
        return Product::query()->where('product_name', 'like', '%' . $query . '%')->get();

    }
}
?>