<?php

namespace App\Http\Requests\NhanVien;

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
    public function rules($id)
    {
        return [
            'ten_tai_khoan' => 'bail|nullable|regex:/^[\w_]{1,30}/',
            'ten'           => 'bail|nullable|regex:/^[\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,50}$/',
            'sdt'           => 'bail|nullable|regex:/^0{0,1}[35789]{1}\d{8}$/',
            'vai_tro_id'    => 'bail|nullable|integer',
            'email'         => "bail|nullable|unique:quan_tri_vien,email,{$id}|regex:/^[\w\.]{1,32}@[a-z\d]{2,}(\.[a-z\d]{2,4}){1,2}$/",
        ];
    }

    public function messages() {
        return [
            'ten_tai_khoan.regex'   => 'Tên tài khoản không đúng định dạng',
            'ten.regex'             => 'Tên không đúng định dạng',
            'sdt.regex'             => 'Số điện thoại không đúng định dạng',
            'chuc_vu_id.integer'    => 'Chức vụ không đúng định dạng',
            'email.unique'          => 'Email đã tồn tại',
            'email.regex'           => 'Email không đúng định dạng',
        ];
    }
}
