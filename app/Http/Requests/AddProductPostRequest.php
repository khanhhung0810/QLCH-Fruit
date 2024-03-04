<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'MaSP' => 'required|unique:product,MaSP|max:255', 
            'TenSP' => 'required|max:255',
            // 'Gia' => 'required|numeric|min:0',
            // 'SoLuong' => 'required|numeric|min:0',
            'AnhSP.*' => 'required|image|mimes:png,jpg,jpeg,webp', 
            
        ];
    }

    public function messages(): array
    {
        return [
            'MaSP.required' => 'Yêu cầu điền Mã Sản Phẩm',
            'TenSP.required' => 'Yêu cầu điền Tên Sản Phẩm',
            'MaSP.unique' => 'Không được nhập trùng',
            'AnhSP.required' => 'Yêu cầu thêm ảnh sản phẩm',
        ];
    }
}
