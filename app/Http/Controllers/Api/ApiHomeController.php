<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HomeService;
use App\Services\ProductService;

class ApiHomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate_product = $this->homeService->getActiveCategories();
        $brand_product = $this->homeService->getActiveBrands();

        return response()->json([
            'cate_product' => $cate_product,
            'brand_product' => $brand_product
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsWithCategories(Request $request,$category_id)
    {
        $category_by_id = $this->homeService->getProductsWithCategories($category_id);
        if($category_by_id->isEmpty()){
            return response()->json([
                'message' => 'Không có sản phẩm nào',
            ], 200);
        }
        else{
            return response()->json([
                'category_by_id' => $category_by_id,
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(Request $request)
    {
        $query = $request->input('');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
