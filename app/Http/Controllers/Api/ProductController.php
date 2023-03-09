<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;
    protected $homeService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $product = $this->productService->getProducts();
        return response()->json([
            'product' => $product
        ], 200);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        if (empty($data['product_content'])) {
            return response()->json([
                'message' => 'Product not created successfully!',
            ], 201);
        } else {
            $this->productService->createProduct($data);
            return response()->json([
                'message' => 'Product created successfully!',
                'data' => $data
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($productId)
    {
        $product = $this->productService->showProduct($productId);
        return response()->json([
            'product' => $product
        ], 200);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, $productId)
    {
        $data = $request->all();
        if (empty($data['product_content'])) {
            return response()->json([
                'message' => 'Product not updated successfully!',
            ], 201);
        } else {
            $this->productService->updateProduct($data, $productId);
            return response()->json([
                'message' => 'Product updated successfully!',
                'data' => $data
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
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
        return response()->json([
            'message' => 'Product deleted successfully!',
            'redirectPage' => $redirectPage
        ], 201);
    }

}
