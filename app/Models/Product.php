<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Product extends Model
{
 
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'product_name', 
        'category_id',
        'brand_id',
        'product_price',
        'product_content',
        'product_image',
        'product_status'
    ];
 	protected $table = 'products';
    public function getKeyName()
    {
         return 'product_id';
    }
    public function setProductName($name) 
    {
        $this->product_name = $name;
        
    }
    public function getProductName() 
    {
        return $this->product_name;

    }

    public function setProductPrice($price) 
    {
        $this->product_price = $price;

    }
    public function getProductPrice() 
    {
        return $this->product_price;

    }
    public function setProductContent($content) 
    {
        $this->product_content = $content;

    }
    public function getProductContent() 
    {
        return $this->product_content;

    }
    public function setProductImage($image) 
    {
        if($image){
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/backend/product', $new_image);
            $this->product_image = $new_image;
        }

    }
    public function getProductImage() 
    {
        return $this->product_image;

    }
    
    public function setProductStatus($status) 
    {
        $this->product_status = $status;

    }
    public function getProductStatus() 
    {
        return $this->product_status;

    }
  
    public function setCategoryID($productCate) 
    {
        $this->category_id = $productCate;

    }
    public function getCategoryID() 
    {
        return $this->category_id;

    }

    public function setBrandID($productBrand)
    {
        $this->brand_id = $productBrand;

    }
    public function getBrandID() 
    {
        return $this->brand_id;

    }
    
}
