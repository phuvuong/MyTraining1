<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $productId = $this->input('product_id');
        $productName = $this->input('product_name');
        $uniqueRule = Rule::unique('products')->ignore($productId);

        return [
            'product_name'=>'required|min:5|max:255',
            $uniqueRule->where(function ($query) use ($productName) {
                return $query->where('product_name', $productName);
            }),
            'product_price'=>'required|numeric|gt:0|max:1000000000|min:10000',
            'product_image'=>'required|mimes:jpeg,jpg,png,gif|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:10000',
            'product_content'=>'required|max:255',
           

           
        ];
    }
    public function messages()
    {
        return [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max",
            'product_name.min'=>" :attribute phải nhiều hơn :min ký tự ",
            'min'=>" :attribute nhiều hơn :min ",
            'unique'=>":attribute đã tồn tại",
            'numeric'=>":attribute phải là số",
            'mimes'=>" :attribute không phù hợp",
            'gt'=>" :attribute phải lớn hơn 0",
        ];
    }
    public function attributes()
    {
        return [
            'product_name'=>"Tên sản phẩm",
            'product_price'=>"Giá sản phẩm",
            'product_image'=>"Hình ảnh sản phẩm",
            'product_content'=>"Nội dung sản phẩm "
        ];
    }
}
