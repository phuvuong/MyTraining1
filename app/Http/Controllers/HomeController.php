<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Repositories\HomeRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;

class HomeController extends Controller
{
    protected $productService;
    protected $productRepository;
    protected $homeRepository;

    public function __construct(ProductService $productService,HomeRepository $homeRepository, ProductRepository $productRepository)
    {
        $this->productService  = $productService ;
        $this->homeRepository = $homeRepository;
        $this->productRepository = $productRepository;
    }
    public function index(Request $request){

        $cate_product = $this->homeRepository->getActiveCategories();
       
        $brand_product = $this->homeRepository->getActiveBrands();

        $product = $this->homeRepository->getProducts();
        $query = $request->input('search');
        
        return view('pages.home')
        ->with('query',$query)
        ->with('all_product',$product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
    }
    public function getProductsWithCategories(Request $request,$category_id) {
        $all_product = $this->homeRepository->getProducts();
        $cate_product = $this->homeRepository->getActiveCategories();
        $brand_product = $this->homeRepository->getActiveBrands();
        $category_by_id = $this->homeRepository->getProductsWithCategories($category_id);
        $query = $request->input('search');
        return view('pages.get-product-category')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
            ->with('all_product',$all_product)->with('category_by_id',$category_by_id)->with('query',$query);
    }
    public function searchProduct(Request $request){
        $cate_product = $this->homeRepository->getActiveCategories();
       
        $brand_product = $this->homeRepository->getActiveBrands();


        $query = $request->input('search');
        $products = $this->productService->searchProduct($query);

        return view('pages.get-product-by-search')
        ->with('products',$products)
        ->with('query',$query)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);

    }
}
