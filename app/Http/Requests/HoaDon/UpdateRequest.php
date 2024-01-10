<?php

namespace App\Http\Requests\HoaDon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
            'ma_hd'         =>  'bail|nullable|regex:/^[\w_]{1,30}/',
            'tong_tien'           => 'bail|required|numeric',
            'dia_chi_nhan'        => 'bail|required|max:191',
            'tinh_trang'     =>'bail|required|max:191'
           
            
            
        ];
    }

    public function messages() {
        return [
            'ma_hd.required'        => 'Vui lòng nhập mã sản phẩm',
            'tong_tien.required'   => 'Vui lòng nhập tổng tiền',
            'dia_chi_nhan.required'    => 'Vui lòng nhập địa chỉ nhận',
           
        ];
    }
}
