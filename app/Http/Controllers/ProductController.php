<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\CategoryProduct;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Services\HomeService;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
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
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cateProduct = $this->homeService->getActiveCategories();
        $brandProduct = $this->homeService->getActiveBrands();
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
        if (empty($data['product_content'])) {
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
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $productId)
    {
        $cateProduct = $this->homeService->getActiveCategories();
        $brandProduct = $this->homeService->getActiveBrands();
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
        if (empty($data['product_content'])) {
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

}

