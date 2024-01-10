<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChiTietSP;
use App\Models\NhaSanXuat;

class NhaSanXuatController extends Controller
{
    private $viewFolder = 'nha-san-xuat';
    private $page = 'Nhà sản xuất';

    public function index(Request $req) {
        $pageInfo = [
            'page'  => $this->page
        ];

        $keyword = (empty($req->keyword)) ? null : $req->keyword;

        $manufactures = NhaSanXuat::sortable();

        if (!empty($keyword)) {
            $manufactures->where('ten', 'like', "%{$keyword}%");
        }

        $manufactures = $manufactures->orderBy('ten')
                                     ->paginate($this->limit);

        return view("admin.{$this->viewFolder}.list", compact('pageInfo', 'manufactures', 'keyword'));
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
            'ten'   => 'required|unique:nha_san_xuat,ten|regex:/^[\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,50}$/',
        ], [
            'ten.required'  => 'Vui lòng nhập tên',
            'ten.unique'    => 'Tên đã tồn tại',
            'ten.regex'     => 'Tên không đúng định dạng'
        ]);

        $manufacture = NhaSanXuat::create($valid);

        if (!empty($manufacture)) {
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

        $manufacture = NhaSanXuat::find($id);

        if (!empty($manufacture)) {
            return view("admin.{$this->viewFolder}.store-edit", compact('pageInfo', 'manufacture'));
        }

        $status = 'error';
        $message = $this->msgNotFound;

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function update(Request $req, $id) {
        $status = 'error';
        $message = $this->msgUpdateErr;

        $manufacture = NhaSanXuat::find($id);

        if (!empty($manufacture)) {
            $valid = $this->validate($req, [
                'ten'   => "required|unique:nha_san_xuat,ten,{$manufacture->id}|regex:/^[\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,50}$/",
            ], [
                'ten.required'  => 'Vui lòng nhập tên',
                'ten.unique'    => 'Tên đã tồn tại',
                'ten.regex'     => 'Tên không đúng định dạng'
            ]);

            $manufacture->update($valid);

            $status = 'success';
            $message = $this->msgUpdateSuc;
        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function destroy(Request $req) {
        $id = $req->id;

        $manufacture = NhaSanXuat::find($id);

        if (!empty($manufacture)) {
            $detail_product = ChiTietSP::where('nha_sx_id', $manufacture->id)
                                       ->first();
            if (empty($detail_product)) {
                $manufacture->delete();

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
