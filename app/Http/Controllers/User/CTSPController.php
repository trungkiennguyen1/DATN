<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChiTietSP;
use App\Models\LoaiSP;
use App\Models\DanhGia;
use App\Models\SanPham;

class CTSPController extends Controller
{
    public function index(Request $req,$type) {
        $url = $req->url();
        $chitietsanpham = ChiTietSP::where('id',$req->id)->first();
          
        $loai_sp = LoaiSP::where('id',$type)->first();

        $sanphamsale = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang',0)->paginate(6);

        $sanphamtuongtu = ChiTietSP::where('loai_sp_id',$chitietsanpham->loai_sp_id)->where('tinh_trang',0)->paginate(6);

        $rating = DanhGia::where('chi_tiet_sp_id',$chitietsanpham->id)->avg('diem');
        $rating = round($rating);

        return view('user.page.san-pham.chitietsanpham',compact('chitietsanpham','sanphamtuongtu','loai_sp','sanphamsale','rating','url'));
    }

    public function insert_rating(Request $req) {
        $data = $req->all();
        $rating = new DanhGia();
        $rating->chi_tiet_sp_id = $data['chi_tiet_sp_id'];
        $rating->diem = $data['index'];
        $rating->save();
        echo 'done';
    }
}
