<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Services\HomeService;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cateProduct = $this->categoryService->getActiveCategories();
        $brandProduct = $this->brandService->getActiveBrands();
        $query = $request->input('search');
        return view('products.add')
            ->with(['query' => $query,
                'cateProduct' => $cateProduct,
                'brandProduct' => $brandProduct]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        if (empty($data['content'])) {
            Session::put('message', 'Thêm sản không phẩm thành công');
            return redirect()->back();
        } else {
            $this->productService->createProduct($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return redirect()->route('home');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, $productId)
    {
        $cateProduct = $this->categoryService->getActiveCategories();
        $brandProduct = $this->brandService->getActiveBrands();
        $product = $this->productService->showProduct($productId);
        $query = $request->input('search');
        return view('products.show')
            ->with(['query' => $query,
                'cateProduct' => $cateProduct,
                'brandProduct' => $brandProduct,
                'product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $productId)
    {
        $data = $request->all();
        if (empty($data['content'])) {
            Session::put('message', ' Cập nhật sản không phẩm thành công');
            return redirect()->back();
        } else {
            $this->productService->updateProduct($data, $productId);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $productId)
    {
        $this->productService->deleteProduct($productId);
        $currentPage = $request->query('page', 1);
        $perPage = 3;
        $paginator = Product::paginate($perPage);
        $lastPage = $paginator->lastPage();
        $remainingProducts = $paginator->total() - ($currentPage - 1) * $perPage;
        if ($remainingProducts == 0 && $currentPage > 1) {
            $redirectPage = $lastPage;
        } elseif ($currentPage < $lastPage && $remainingProducts > 0) {
            $redirectPage = $currentPage + 1;
        } else {
            $redirectPage = $currentPage;
        }
        return Redirect::route('home', ['page' => $redirectPage]);
    }

    public function getProductsWithCategories(Request $request, $categoryId)
    {
        $allProduct = $this->productService->getProducts();
        $cateProduct = $this->categoryService->getActiveCategories();
        $brandProduct = $this->brandService->getActiveBrands();
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
        $cateProduct = $this->categoryService->getActiveCategories();
        $brandProduct = $this->brandService->getActiveBrands();
        $query = $request->input('search');
        $products = $this->productService->searchProduct($query);

        return view('pages.get-product-by-search')
            ->with(['products' => $products,
                'query' => $query,
                'cateProduct' => $cateProduct,
                'brandProduct' => $brandProduct]);
    }
}

