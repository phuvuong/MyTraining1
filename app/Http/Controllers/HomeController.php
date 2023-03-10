<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\ProductService;

class HomeController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $brandService;

    public function __construct(CategoryService $categoryService, BrandService $brandService, ProductService $productService)
    {
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $cateProduct = $this->categoryService->getActiveCategories();
        $brandProduct = $this->brandService->getActiveBrands();
        $product = $this->productService->getProducts();
        $query = $request->input('search');

        return view('pages.home')
            ->with(['query' => $query,
                'allProduct' => $product,
                'cateProduct' => $cateProduct,
                'brandProduct' => $brandProduct]);
    }

}
