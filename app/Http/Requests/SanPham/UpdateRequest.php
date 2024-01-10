<?php

namespace App\Http\Requests\SanPham;

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
    public function rules($product_id, $product_detail_id)
    {
        return [
            'ma_sp'         => "bail|required|unique:san_pham,ma_sp,{$product_id}|regex:/^[\w]{6,10}$/",
            'loai_sp_id'    => 'bail|required|integer',
            'nha_sx_id'     => 'bail|required|integer',
            'ten_sp'        => "bail|required|unique:chi_tiet_sp,ten_sp,{$product_detail_id}",
            'gia'           => 'bail|required|numeric',
            'mo_ta'         => 'bail|required|max:191',
            'mau_sac'       => 'bail|required|max:50',
            'so_luong'      => 'bail|required|integer',
            'giam_gia'      => 'bail|nullable|numeric',
            'hinh_anh.*'    => 'bail|nullable|mimes:jpg,jpeg,png',
            'chat_lieu'     => 'bail|required',
            'so_ngan'       => 'bail|required',
            'khoi_luong'    => 'bail|required',
            'kich_thuoc'    => 'bail|required',
            'tai_trong'     => 'bail|required',
            'ngan_lap'      => 'bail|required',
            'tinh_trang'    => 'bail|required|boolean'
        ];
    }

    public function messages() {
        return [
            'ma_sp.required'        => 'Vui lòng nhập mã sản phẩm',
            'loai_sp_id.required'   => 'Vui lòng chọn loại sản phẩm',
            'nha_sx_id.required'    => 'Vui lòng chọn nhà sản xuất',
            'ten_sp.required'       => 'Vui lòng nhập tên sản phẩm',
            'gia.required'          => 'Vui lòng nhập giá',
            'mo_ta.required'        => 'Vui lòng nhập mô tả',
            'mau_sac.required'      => 'Vui lòng nhập màu sắc',
            'so_luong.required'     => 'Vui lòng nhập số lượng',
            'ma_sp.unique'          => 'Mã sản phẩm đã tồn tại',
            'loai_sp_id.integer'    => 'Loại sản phẩm không đúng định dạng',
            'ten_sp.unique'         => 'Tên sản phẩm đã tồn tại',
            'gia.numeric'           => 'Giá không đúng định dạng',
            'mo_ta.max'             => 'Mô tả không quá 191 ký tự',
            'mau_sac.max'           => 'Màu sắc không quá 50 ký tự',
            'so_luong.integer'      => 'Số lượng không đúng định dạng',
            'giam_gia.numeric'      => 'Giảm giá không đúng định dạng',
            'hinh_anh.*.mimes'      => 'Hình ảnh phải là jpg, jpeg, png',
            'chat_lieu.required'    => 'Vui lòng nhập chất liệu',
            'so_ngan.required'      => 'Vui lòng nhập số ngăn',
            'khoi_luong.required'   => 'Vui lòng nhập khối lượng',
            'kich_thuoc.required'   => 'Vui lòng nhập kích thước',
            'tai_trong.required'    => 'Vui lòng nhập tải trọng',
            'ngan_lap.required'     => 'Vui lòng nhập ngăn laptop',
            'tinh_trang.required'   => 'Vui lòng chọn tình trạng',
            'tinh_trang.boolean'    => 'Tình trạng không đúng định dạng'
        ];
    }
}
