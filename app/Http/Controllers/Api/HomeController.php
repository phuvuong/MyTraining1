<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $cateProduct = $this->homeService->getActiveCategories();
        $brandProduct = $this->homeService->getActiveBrands();

        return response()->json([
            'cateProduct' => $cateProduct,
            'brandProduct' => $brandProduct
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsWithCategories(Request $request, $categoryId)
    {
        $categoryById = $this->productService->getProductsWithCategories($categoryId);
        if ($categoryById->isEmpty()) {
            return response()->json([
                'message' => 'Không có sản phẩm nào',
            ], 200);
        } else {
            return response()->json([
                'categoryById' => $categoryById,
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProduct(Request $request)
    {
        $query = $request->input('search');
        if (!$query) {
            return response()->json(['message' => 'Vui lòng nhập từ khóa để tìm kiếm sản phẩm'], 400);
        }
        $products = $this->productService->searchProduct($query);
        if ($products->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm nào'], 404);
        }
        return response()->json(['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
