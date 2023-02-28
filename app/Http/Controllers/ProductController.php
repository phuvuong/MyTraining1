<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Repositories\ProductRepository;
use App\Repositories\HomeRepository;
use App\Models\CategoryProduct;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
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
        $cate_product = $this->homeRepository->getActiveCategories();
       
        $brand_product = $this->homeRepository->getActiveBrands();

        $query = $request->input('search');

        return view('products.add')->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product) ->with('query',$query);
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
        $this->productService->createProduct($request, $data);
        Session::put('message','Thêm sản phẩm thành công');
         return redirect()->route('add.product');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$product_id)
    {
        $cate_product = $this->homeRepository->getActiveCategories();
       
        $brand_product = $this->homeRepository->getActiveBrands();

        $product = $this->productRepository->show_product($product_id);

        $query = $request->input('search');
        return view('products.show')->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product)->with('product',$product) ->with('query',$query);
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
        $product = $this->productService->updateProduct($request,$data, $product_id);
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
      
   
        $perPage = $request->query('perPage', 3);
        $currentPage = $request->query('page', 1);
        $totalProducts = Product::count();
        $lastPage = ceil($totalProducts / $perPage);
        $remainingProducts = $totalProducts - ($currentPage - 1) * $perPage;

       
        if ($remainingProducts == 0 && $currentPage > 1) {
            return redirect()->route('home', ['page' => $lastPage]); 
        }
        elseif ($currentPage < $lastPage && $remainingProducts > 0) {
            return redirect()->route('home', ['page' => $currentPage + 1]); 
        }
        return redirect()->route('home', ['page' => $currentPage]);
            
    }
}
