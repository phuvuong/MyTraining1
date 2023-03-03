<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\CategoryProduct;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Services\HomeService;
use Illuminate\Pagination\Paginator;

class ApiProductController extends Controller
{
    protected $productService;
    protected $homeService;
     public function __construct(ProductService $productService,HomeService $homeService)
    {
        $this->productService  = $productService ;
        $this->homeService = $homeService;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->homeService->getProducts();
        return response()->json([
            'product' => $product
        ],200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $this->productService->createProduct($data);
        return response()->json([
            'message' => 'Product created successfully!',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = $this->productService->showProduct($product_id);
        return response()->json([
            'product' => $product
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product_id)
    {
        $data = $request->all();
        $this->productService->updateProduct($data, $product_id);
        return response()->json([
            'message' => 'Product updated successfully!',
            'data' => $data
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$product_id)
    {
        
        $this->productService->deleteProduct($product_id);
        $currentPage = $request->query('page', 1);
        $perPage = 3;
        $paginator = Product::paginate($perPage);
        $lastPage = $paginator->lastPage();
        $remainingProducts = $paginator->total() - ($currentPage - 1) * $perPage;
        if ($remainingProducts == 0 && $currentPage > 1) {
            $redirectPage = $lastPage;
        }
        elseif ($currentPage < $lastPage && $remainingProducts > 0) {
            $redirectPage = $currentPage + 1;
        }
        else {
            $redirectPage = $currentPage;
        }
        return response()->json([
            'message' => 'Product deleted successfully!',
            'redirectPage' => $redirectPage
        ], 201);
    }
}
