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

    public function __construct(ProductService $productService, HomeService $homeService)
    {
        $this->productService = $productService;
        $this->homeService = $homeService;
    }

    public function index(Request $request)
    {
        $cateProduct = $this->homeService->getActiveCategories();
        $brandProduct = $this->homeService->getActiveBrands();
        $product = $this->productService->getProducts();
        $query = $request->input('search');

        return view('pages.home')
            ->with(['query' => $query,
                'allProduct' => $product,
                'cateProduct' => $cateProduct,
                'brandProduct' => $brandProduct]);

    }

    public function getProductsWithCategories(Request $request, $categoryId)
    {
        $allProduct = $this->productService->getProducts();
        $cateProduct = $this->homeService->getActiveCategories();
        $brandProduct = $this->homeService->getActiveBrands();
        $categoryById = $this->productService->getProductsWithCategories($categoryId);
        $query = $request->input('search');
        return view('pages.get-product-category')
            ->with(['cateProduct' => $cateProduct,
                'brandProduct' => $brandProduct,
                'allProduct' => $allProduct,
                'categoryById' => $categoryById,
                'query' => $query]);

    }

    public function searchProduct(Request $request)
    {
        $cateProduct = $this->homeService->getActiveCategories();
        $brandProduct = $this->homeService->getActiveBrands();
        $query = $request->input('search');
        $products = $this->productService->searchProduct($query);

        return view('pages.get-product-by-search')
            ->with(['products' => $products,
                'query' => $query,
                'cateProduct' => $cateProduct,
                'brandProduct' => $brandProduct]);

    }
}
