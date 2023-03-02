<?php

namespace App\Repositories;
use App\Models\CategoryProduct;
use App\Models\Brand;
use App\Models\Product;

class HomeRepository extends BaseRepository 
{
    public function __construct(CategoryProduct $categoryProduct, Brand $brand , Product $product)
    {
        parent::__construct($categoryProduct);
        parent::__construct($brand);
        parent::__construct($product);

    }
    public function getActiveCategories()
    {
        return CategoryProduct::where('category_status', 1)->orderBy('category_id','DESC')->get();

    }
    public function getActiveBrands()
    {
        return Brand::where('brand_status', 1)->orderBy('brand_id','DESC')->get();

    }
    public function getProducts()
    {
        return Product::join('categories','categories.category_id','=','products.category_id')
        ->join('brands','brands.brand_id','=','products.brand_id')->paginate(3);

    }
    public function getCategories()
    {
        return CategoryProduct::orderBy('category_id','desc')->get();

    }
    public function getBrands()
    {
        return Brand::orderBy('brand_id','desc')->get(); 

    }
    public function getProductswithCategories($category_id)
    {
        return Product::join('categories','products.category_id','=','categories.category_id')
        ->where('categories.category_id',$category_id)->get();

    }
}
?>