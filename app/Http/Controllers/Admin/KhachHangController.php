<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    private $viewFolder = 'khach-hang';
    private $page = 'Khách hàng';

    public function index(Request $req) {
        $pageInfo = [
            'page'  => $this->page
        ];

        $inputSearch = [
            'ten'       => $req->ten,
            'email'     => $req->email,
            'sdt'       => $req->sdt,
            'bi_khoa'   => $req->bi_khoa
        ];

        $isSearch = false;
        foreach($inputSearch as $key => $value) {
            if (!empty($value)) {
                $isSearch = true;
                break;
            }
        }

        $customers = KhachHang::sortable();

        if (!empty($req->ten)) {
            $customers->where('ten', 'like', "%{$req->ten}%");
        }

        if (!empty($req->email)) {
            $customers->where('email', 'like', "%{$req->email}%");
        }

        if (!empty($req->sdt)) {
            $customers->where('sdt', $req->sdt);
        }

        if (isset($req->bi_khoa)) {
            $customers->where('bi_khoa', $req->bi_khoa);
        }

        $customers = $customers->orderBy('ten')
                               ->paginate($this->limit);
                            //    echo "<pre>";
                            //    print_r($customers);
                            //    exit;
        return view("admin.{$this->viewFolder}.list", compact('pageInfo', 'customers', 'inputSearch', 'isSearch'));
    }

    public function destroy(Request $req) {
        $id = $req->id;

        $customer = KhachHang::find($id);

        if (!empty($customer)) {
            $customer->delete();

            return response()->json([
                'title'     => 'Xóa khách hàng',
                'status'    => 'success',
                'msg'       => $this->msgDeleteSuc
            ]);
        }

        return response()->json([
            'title'     => 'Xóa khách hàng',
            'status'    => 'error',
            'msg'       => $this->msgDeleteErr
        ]);
    }

    public function changePass(Request $req) {
        $status = 'error';

        $customer = KhachHang::find($req->id);

        if (!empty($customer)) {
            $status = 'success';

            $customer->update([
                'password'  => Hash::make($req->new_pass)
            ]);

            return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $this->msgChangePassSuc);
        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $this->msgChangePassErr);
    }

    public function lockOrUnlockUser(Request $req) {
        $customer = KhachHang::find($req->id);

        if (!empty($customer)) {
            $customer->update(['bi_khoa' => !$customer->bi_khoa]);
            $title = ($customer->bi_khoa == 1) ? 'Khóa' : 'Mở khóa';
            return response()->json([
                'title'     => "{$title} khách hàng",
                'status'    => 'success',
                'msg'       => 'Thành công'
            ]);
        }

        return response()->json([
            'title'     => "{$title} khách hàng",
            'status'    => 'error',
            'msg'       => 'Có lỗi trong khi thực hiện'
        ]);
    }
}
