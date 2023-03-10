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
        $productId = $this->route('productId');
        // được sử dụng để lấy ID của sản phẩm từ các tham số đường dẫn
        return [
            'name' => [
                'required', 'min:5', 'max:255',
                Rule::unique('products')->ignore($productId, 'id')
            ],
            'price' => 'required|numeric|gt:0|max:1000000000|min:10000',
            'image' => 'required|mimes:jpeg,jpg,png,gif|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:10000',
            'content' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => " :attribute bắt buộc phải nhập",
            'max' => " :attribute không được lớn hơn :max",
            'name.min' => " :attribute phải nhiều hơn :min ký tự ",
            'min' => " :attribute nhiều hơn :min ",
            'unique' => ":attribute đã tồn tại",
            'numeric' => ":attribute phải là số",
            'mimes' => " :attribute không phù hợp",
            'gt' => " :attribute phải lớn hơn 0",
        ];
    }

    public function attributes()
    {
        return [
            'name' => "Tên sản phẩm",
            'price' => "Giá sản phẩm",
            'image' => "Hình ảnh sản phẩm",
            'content' => "Nội dung sản phẩm "
        ];
    }
}
