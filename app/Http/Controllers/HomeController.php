<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Services\HomeService;
use App\Services\ProductService;

class HomeController extends Controller
{
    protected $productService;
    protected $homeService;

    public function __construct(ProductService $productService,HomeService $homeService)
    {
        $this->productService = $productService ;
        $this->homeService = $homeService;
    }
    public function index(Request $request){
        $cate_product = $this->homeService->getActiveCategories();
        $brand_product = $this->homeService->getActiveBrands();
        $product = $this->homeService->getProducts();
        $query = $request->input('search');
        
        return view('pages.home')
        ->with(['query' => $query,
        'all_product' => $product ,
        'cate_product' => $cate_product,
        'brand_product' => $brand_product]);
        
    }
    public function getProductsWithCategories(Request $request,$category_id) {
        $all_product = $this->homeService->getProducts();
        $cate_product = $this->homeService->getActiveCategories();
        $brand_product = $this->homeService->getActiveBrands();
        $category_by_id = $this->homeService->getProductsWithCategories($category_id);
        $query = $request->input('search');
        return view('pages.get-product-category')
                ->with(['cate_product' => $cate_product, 
                'brand_product' => $brand_product, 
                'all_product' => $all_product, 
                'category_by_id' => $category_by_id, 
                'query' => $query]);
                
    }
    public function searchProduct(Request $request){
        $cate_product = $this->homeService->getActiveCategories();
        $brand_product = $this->homeService->getActiveBrands();
        $query = $request->input('search');
        $products = $this->productService->searchProduct($query);

        return view('pages.get-product-by-search')
                ->with(['products'=>$products,
                'query'=> $query,
                'cate_product'=>$cate_product,
                'brand_product'=>$brand_product]);

    }
}
