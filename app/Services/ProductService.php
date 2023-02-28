<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class ProductService
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function createProduct(ProductRequest $request,array $data)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(),$request->rules(),$request->messages(),$request->attributes());
        if ($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
        }
        else{
            $product = new Product();
            $product->setProductName($data['product_name']);
            $product->setProductPrice($data['product_price']);
            $product->setProductContent($data['product_content']);
            $product->setCategoryID($data['product_cate']);
            $product->setBrandID($data['product_brand']);
            $product->setProductStatus($data['product_status']);
            $image = $data['product_image'];
            $product->setProductImage($image);
            $image = $product->getProductImage();
            return $this->productRepository->createProduct($product);
        }
        return back()->withErrors($validator);
    }   
    public function updateProduct(ProductRequest $request, array $data , $product_id)
    {

        $data = $request->all();
        $validator = Validator::make($request->all(),$request->rules(),$request->messages(),$request->attributes());
        if ($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
        }
        else{
            $product = $this->productRepository->findProductById($product_id);
            $product->setProductName($data['product_name']);
            $product->setProductPrice($data['product_price']);
            $product->setProductContent($data['product_content']);
            $product->setCategoryID($data['product_cate']);
            $product->setBrandID($data['product_brand']);
            $product->setProductStatus($data['product_status']);
            $image = $data['product_image'];
            $product->setProductImage($image);
            $image = $product->getProductImage();
            $product->save();
        }
        return back()->withErrors($validator);
        



    }
    public function getAllProducts($perPage = 3)
    {
        $product = $this->productRepository->getAllProducts($perPage);
        $pagination = $product->links();
        $data = $product->items();

        return [
            'data' => $data,
            'pagination' => ['links' => $pagination]
        ];
    }
    public function deleteProduct($product_id) {
        $this->productRepository->deleteProduct($product_id);
    }
    public function searchProduct($query){
        return $this->productRepository->searchProduct($query);
    }
    // public function paginateProduct(Request  $request){
    //     $perPage = $request->query('perPage', 3);
    //     $currentPage = $request->query('page', 1);
    //     $totalProducts = Product::count();
    //     $lastPage = ceil($totalProducts / $perPage);
    //     $remainingProducts = $totalProducts - ($currentPage - 1) * $perPage;

    //     if ($remainingProducts == 0 && $currentPage > 1) {
    //         return redirect()->route('home', ['page' => $lastPage]); 
    //     }
    //     elseif ($currentPage < $lastPage && $remainingProducts > 0) {
    //         return redirect()->route('home', ['page' => $currentPage + 1]); 
    //     }
    //     return redirect()->route('home', ['page' => $currentPage]);
    // }
} 
 

?>