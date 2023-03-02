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
       
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cate_product = $this->homeService->getActiveCategories();
        $brand_product = $this->homeService->getActiveBrands();
        $query = $request->input('search');
        return view('products.add')
                ->with(['query' => $query,
                'cate_product' => $cate_product,
                'brand_product' => $brand_product]);

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
        Session::put('message','Thêm sản phẩm thành công');
        return redirect()->route('home');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$product_id)
    {
        $cate_product = $this->homeService->getActiveCategories();
        $brand_product = $this->homeService->getActiveBrands();
        $product = $this->productService->showProduct($product_id);
        $query = $request->input('search');
        return view('products.show')
        ->with(['query' => $query,
        'cate_product' => $cate_product,
        'brand_product' => $brand_product,
        'product'=>$product]);

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
        Session::put('message','Cập nhật sản phẩm thành công');
        return redirect()->route('home');

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
        return Redirect::route('home', ['page' => $redirectPage]);
            
    }
}
?>
