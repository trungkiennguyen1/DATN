<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\ChiTietSP;
class TrangChuController extends Controller
{
    public function index() {
        $slide = Slide::all();




        $sanpham = ChiTietSP::where('tinh_trang',0)->get();

        $sanphammoi = ChiTietSP::where('new',0)->where('tinh_trang','0')->get();
        $sanphamsale = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang',0)->get();
        
        return view('user.page.trang-chu.trangchu',compact('slide','sanpham','sanphamsale','sanphammoi'));
    }

    public function search(Request $req) {


        $sanpham = ChiTietSP::where('ten_sp','like','%'.$req->key.'%')
                                ->orWhere('gia',$req->key)
                                ->get();

        if(isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'tang-dan') {
                $sanpham = ChiTietSP::where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($sort_by == 'giam-dan') {
                $sanpham = ChiTietSP::where('tinh_trang','0')->orderby('gia','DESC')->get();
            }
            elseif($sort_by == 'moi-cu') {
                $sanpham = ChiTietSP::where('tinh_trang','0')->orderby('created_at','DESC')->get();
            }
            elseif($sort_by == 'cu-moi') {
                $sanpham = ChiTietSP::where('tinh_trang','0')->orderby('created_at','ASC')->get();
            }
            elseif($sort_by == 'A-Z') {
                $sanpham = ChiTietSP::where('tinh_trang','0')->orderby('ten_sp','ASC')->get();
            }
            elseif($sort_by == 'Z-A') {
                $sanpham = ChiTietSP::where('tinh_trang','0')->orderby('ten_sp','DESC')->get();
            }

        }

        if(isset($_GET['price'])) {
            $price = $_GET['price'];

            if($price=='1') {
                $sanpham = ChiTietSP::where('gia','<',300000)->where('tinh_trang','0')->orderby('gia','ASC')->get();
                $sanpham = ChiTietSP::where('ten_sp','like','%'.$req->key.'%')
                                ->orWhere('gia',$req->key)
                                ->get();
            }
            elseif($price=='2') {
                $sanpham = ChiTietSP::whereBetween('gia',[300000, 500000])->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='3') {
                $sanpham = ChiTietSP::whereBetween('gia',[500000, 700000])->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='4') {
                $sanpham = ChiTietSP::whereBetween('gia',[700000, 1000000])->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='5') {
                $sanpham = ChiTietSP::whereBetween('gia',[1000000, 1200000])->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='6') {
                $sanpham = ChiTietSP::whereBetween('gia',[1200000, 1500000])->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='7') {
                $sanpham = ChiTietSP::whereBetween('gia',[1500000, 2000000])->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='8') {
                $sanpham = ChiTietSP::where('gia','>',2000000)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }

        }
        return view('user.page.trang-chu.search',compact('sanpham'));
    }

    public function chinhsachthanhtoan(){
        return view('user.page.chinh-sach.chinhsachthanhtoan');
    }
    public function chinhsachdoitrabaohanh(){
        return view('user.page.chinh-sach.chinhsachdoitrabaohanh');
    }
    public function chinhsachfreeship(){
        return view('user.page.chinh-sach.chinhsachfreeship');
    }
    public function chinhsachhanghieu(){
        return view('user.page.chinh-sach.chinhsachhanghieu');
    }
}
