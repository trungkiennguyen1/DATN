<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChiTietSP;
use App\Models\LoaiSP;

class LoaiSPController extends Controller
{
    private $viewFolder = 'loai-san-pham';
    private $page = 'Loại sản phẩm';

    public function index(Request $req) {
        $pageInfo = [
            'page'  => $this->page
        ];

        $keyword = (empty($req->ten)) ? null : $req->ten;

        $product_types = LoaiSP::sortable();

        if (!empty($keyword)) {
            $product_types->where('ten', 'like', "%{$keyword}%");
        }

        $product_types = $product_types->orderBy('ten')
                                       ->paginate($this->limit);

        return view("admin.{$this->viewFolder}.list", compact('pageInfo', 'product_types', 'keyword'));
    }

    public function create() {
        $pageInfo = [
            'subtitle'  => $this->add,
            'page'      => $this->page,
            'route'     => $this->viewFolder
        ];

        return view("admin.{$this->viewFolder}.store-edit", compact('pageInfo'));
    }

    public function store(Request $req) {
        $status = "error";
        $message = $this->msgStoreErr;

        $valid = $this->validate($req, [
            'ten'   => 'required|unique:loai_sp,ten|regex:/^[\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,50}$/',
        ], [
            'ten.required'  => 'Vui lòng nhập tên',
            'ten.unique'    => 'Tên đã tồn tại',
            'ten.regex'     => 'Tên không đúng định dạng'
        ]);

        $product_type = LoaiSP::create($valid);

        if (!empty($product_type)) {
            $status = "success";
            $message = $this->msgStoreSuc;
        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function edit($id) {
        $pageInfo = [
            'subtitle'  => $this->edit,
            'page'      => $this->page,
            'route'     => $this->viewFolder
        ];

        $product_type = LoaiSP::find($id);

        if (!empty($product_type)) {
            return view("admin.{$this->viewFolder}.store-edit", compact('pageInfo', 'product_type'));
        }

        $status = 'error';
        $message = $this->msgNotFound;

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function update(Request $req, $id) {
        $status = 'error';
        $message = $this->msgUpdateErr;

        $product_type = LoaiSP::find($id);

        if (!empty($product_type)) {
            $valid = $this->validate($req, [
                'ten'   => "required|unique:loai_sp,ten,{$product_type->id}|regex:/^[\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,50}$/",
            ], [
                'ten.required'  => 'Vui lòng nhập tên',
                'ten.unique'    => 'Tên đã tồn tại',
                'ten.regex'     => 'Tên không đúng định dạng'
            ]);

            $product_type->update($valid);

            $status = 'success';
            $message = $this->msgUpdateSuc;
        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function destroy(Request $req) {
        $id = $req->id;

        $product_type = LoaiSP::find($id);

        if (!empty($product_type)) {
            $detail_product = ChiTietSP::where('nha_sx_id', $product_type->id)
                                       ->first();
            if (empty($detail_product)) {
                $product_type->delete();

                return response()->json([
                    'title'     => 'Xóa nhà sản xuất',
                    'status'    => 'success',
                    'msg'       => $this->msgDeleteSuc
                ]);
            }

            return response()->json([
                'title'     => 'Xóa nhà sản xuất',
                'status'    => 'error',
                'msg'       => $this->msgDeleteCant
            ]);
        }

        return response()->json([
            'title'     => 'Xóa nhà sản xuất',
            'status'    => 'error',
            'msg'       => $this->msgDeleteErr
        ]);
    }
}
