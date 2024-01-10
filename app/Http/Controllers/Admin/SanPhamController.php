<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\ChiTietSP;
use App\Models\LoaiSP;
use App\Models\NhaSanXuat;
use App\Http\Requests\SanPham\StoreRequest;
use App\Http\Requests\SanPham\UpdateRequest;
use App\Helpers\UploadFile as Upload;
use App\Exports\ProductExport;

class SanPhamController extends Controller
{
    private $viewFolder = 'san-pham';
    private $page = 'Sản phẩm';

    public function index(Request $req) {
        $pageInfo = [
            'page'  => $this->page
        ];

        $keyword = (empty($req->keyword)) ? null : $req->keyword;

        $products = SanPham::sortable();

        if (!empty($keyword)) {
            $products->where('ma_sp', 'like', "%{$keyword}%");
        }

        $products = $products->with('chi_tiet_sp')
                             ->orderBy('ma_sp')
                             ->paginate($this->limit);

        return view("admin.{$this->viewFolder}.list", compact('pageInfo', 'products', 'keyword'));
    }

    public function show($id) {
        $product = SanPham::find($id);

        if (!empty($product)) {
            $product_detail = ChiTietSP::where('san_pham_id', $product->id)
                                       ->with(['loai_sp', 'nha_san_xuat'])
                                       ->first();
            return response()->json([
                'title'     => 'Chi tiết sản phẩm',
                'status'    => 'success',
                'data'      => $product_detail
            ]);
        }

        return response()->json([
            'title'     => 'Chi tiết sản phẩm',
            'status'    => 'error',
            'msg'       => $this->msgNotFound
        ]);
    }

    public function create() {
        $pageInfo = [
            'subtitle'  => $this->add,
            'page'      => $this->page,
            'route'     => $this->viewFolder
        ];

        $product_types = LoaiSP::all();
        $manufactures = NhaSanXuat::all();

        return view("admin.{$this->viewFolder}.store-edit", compact('pageInfo', 'product_types', 'manufactures'));
    }

    public function store(StoreRequest $req) {
        $status = "error";
        $message = $this->msgStoreErr;

        $product = SanPham::create(['ma_sp' => $req->ma_sp]);

        $product_detail = ChiTietSP::create([
            'san_pham_id'   => $product->id,
            'ten_sp'        => $req->ten_sp,
            'loai_sp_id'    => $req->loai_sp_id,
            'nha_sx_id'     => $req->nha_sx_id,
            'gia'           => $req->gia,
            'so_luong'      => $req->so_luong,
            'giam_gia'      => $req->giam_gia,
            'mau_sac'       => $req->mau_sac,
            'mo_ta'         => $req->mo_ta,
            'chat_lieu'     => $req->chat_lieu,
            'so_ngan'       => $req->so_ngan,
            'khoi_luong'    => $req->khoi_luong,
            'kich_thuoc'    => $req->kich_thuoc,
            'tai_trong'     => $req->tai_trong,
            'ngan_lap'      => $req->ngan_lap,
            'tinh_trang'    => $req->tinh_trang
        ]);

        if (!empty($product) && !empty($product_detail)) {
            if($files = $req->file('hinh_anh')) {
                $images = [];
                foreach ($files as $file) {
                    $fileName = Upload::store($file, "anh_ctsp");
                    $images[] = $fileName;
                }
                $product->update(['hinh_anh' => Upload::store($files[0], "anh_sp")]);
                $product_detail->update(['hinh_anh' => $images]);
            }

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

        $product_types = LoaiSP::all();
        $manufactures = NhaSanXuat::all();

        $product = SanPham::find($id);

        if (!empty($product)) {
            $product_detail = ChiTietSP::where('san_pham_id', $product->id)
                                       ->first();
            return view("admin.{$this->viewFolder}.store-edit", compact('pageInfo', 'product', 'product_detail', 'product_types', 'manufactures'));
        }

        $status = 'error';
        $message = $this->msgNotFound;

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function update(Request $req, $id) {
        $status = 'error';
        $message = $this->msgUpdateErr;

        $product = SanPham::find($id);

        if (!empty($product)) {
            $product_detail = ChiTietSP::where('san_pham_id', $product->id)
                                       ->first();
            if (!empty($product_detail)) {
                $valid = $this->validate($req, (new UpdateRequest)->rules($product->id, $product_detail->id), (new UpdateRequest)->messages());

                $product->update(['ma_sp' => $valid['ma_sp']]);
                $product_detail->update([
                    'ten_sp'        => $valid['ten_sp'],
                    'loai_sp_id'    => $valid['loai_sp_id'],
                    'nha_sx_id'     => $valid['nha_sx_id'],
                    'gia'           => $valid['gia'],
                    'so_luong'      => $valid['so_luong'],
                    'giam_gia'      => $valid['giam_gia'],
                    'mau_sac'       => $valid['mau_sac'],
                    'mo_ta'         => $valid['mo_ta'],
                    'chat_lieu'     => $valid['chat_lieu'],
                    'so_ngan'       => $valid['so_ngan'],
                    'khoi_luong'    => $valid['khoi_luong'],
                    'kich_thuoc'    => $valid['kich_thuoc'],
                    'tai_trong'     => $valid['tai_trong'],
                    'ngan_lap'      => $valid['ngan_lap'],
                    'tinh_trang'    => $valid['tinh_trang']
                ]);

                if ($req->is_remove == 'removed') {
                    Upload::delete($product->hinh_anh, 'anh_sp');
                    foreach ($product_detail->hinh_anh as $img) {
                        Upload::delete($img, 'anh_ctsp');
                    }

                    $product->update(['hinh_anh' => null]);
                    $product_detail->update(['hinh_anh' => null]);
                }

                if($files = $req->file('hinh_anh')) {
                    if (!empty($product_detail->hinh_anh)) {
                        foreach ($product_detail->hinh_anh as $img) {
                            Upload::delete($img, 'anh_ctsp');
                        }
                    }
                    if (!empty($product->hinh_anh)) {
                        Upload::delete($product->hinh_anh, 'anh_sp');
                    }

                    $images = [];
                    foreach ($files as $file) {
                        $fileName = Upload::store($file, "anh_ctsp");
                        $images[] = $fileName;
                    }
                    $product->update(['hinh_anh' => Upload::store($files[0], "anh_sp")]);
                    $product_detail->update(['hinh_anh' => $images]);
                }

                $status = 'success';
                $message = $this->msgUpdateSuc;
            }
        }

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function destroy(Request $req) {
        $id = $req->id;

        $product = SanPham::find($id);

        if (!empty($product)) {
            $product_detail = ChiTietSP::where('san_pham_id', $product->id)
                                       ->first();
            $product_detail->delete();
            $product->delete();

            return response()->json([
                'title'     => 'Xóa sản phẩm',
                'status'    => 'success',
                'msg'       => $this->msgDeleteSuc
            ]);
        }

        return response()->json([
            'title'     => 'Xóa sản phẩm',
            'status'    => 'error',
            'msg'       => $this->msgDeleteErr
        ]);
    }

    public function statistic(Request $req) {
        $pageInfo = [
            'page'  => 'Thống kê sản phẩm'
        ];

        $search = [
            'from'  => $req->fromDate,
            'to'    => $req->toDate
        ];

        $products = SanPham::getProductByDate($req)
                           ->paginate($this->limit);

        return view("admin.{$this->viewFolder}.statistic", compact('pageInfo', 'products', 'search'));
    }

    public function excel(Request $req) {
        $products = SanPham::getProductByDate($req)
                           ->get();

        return new ProductExport($products);
    }
}
