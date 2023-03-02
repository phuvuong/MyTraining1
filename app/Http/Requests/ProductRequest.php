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
        $product_id = $this->route('product_id');
        // được sử dụng để lấy ID của sản phẩm từ các tham số đường dẫn
        return [
            // 'product_name' => 'required|unique:products,product_name,'.$product_id,
            'product_name' => [
                'required','min:5','max:255',
                Rule::unique('products')->where(function ($query) use ($product_id) {
                    return $query->where('product_id', '<>', $product_id);
                })
            ],
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
