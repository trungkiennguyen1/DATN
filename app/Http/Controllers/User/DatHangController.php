<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\ChiTietSP;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

class DatHangController extends Controller
{
    public function index(){
        if(Session::get('cart')==null)
        {   
            alert()->error('Lỗi!','Hãy thêm sản phẩm vào giỏ hàng trước!');
            return redirect()->route('trangchu');
        } else {
            return view('user.page.dat-hang.dathang');
        }
    }

    public function datHang(Request $req) {

        //Lấy giỏ hàng
        $giohang = Session::get('cart');

        //Đặt hàng khi đã đăng nhập
        if (Auth::check()) {     
            $hoadon = new HoaDon;
            $mahd = now();
            $hoadon->ma_hd = 'HD'.$mahd.'';
            $hoadon->khach_hang_id = Auth::user()->id;
            $hoadon->ngay_dat = now();
            $hoadon->tong_tien = $giohang->tongTien;
            $hoadon->dia_chi_nhan = $req->diachi;
            $hoadon->hinh_thuc_thanh_toan = $req->paymentMethod;
            $hoadon->ghi_chu = $req->ghichu;
            $hoadon->tinh_trang = 'Đang duyệt';
            $hoadon->save();
            foreach($giohang->items as $key => $value) {

                //Update số lượng khi đặt hàng
                $updateSL = ChiTietSP::find($key);
                $updateSL->so_luong -= $value['so_luong'];
                $updateSL->save();

                $chitiethoadon = new ChiTietHoaDon;
                $chitiethoadon->hoa_don_id = $hoadon->id;
                $chitiethoadon->san_pham_id = $key;
                $chitiethoadon->so_luong = $value['so_luong'];
                $chitiethoadon->don_gia = ($value['gia']/$value['so_luong']);
                $chitiethoadon->thanh_tien = ($value['gia']/$value['so_luong'])*$value['so_luong'];
                $chitiethoadon->save();
            }

            $now = date('Y-m-d');
            $title_email = "Đơn hàng xác nhận ngày".' '.$now;
            if(Auth::check()) {
                $khachhang = User::find(Auth::user()->id);
            }
            $emailKH = $khachhang->email;

            if(Session::get('cart')==true) {
                foreach($giohang->items as $key => $value) {
                    $cart_array[] = array(
                        'ten_sp' =>$value['item']['ten_sp'],
                        'gia' => $value['gia'],
                        'so_luong' => $value['so_luong']
                    );
                }
            }

            $shipping_array = array(
                'id'            =>$hoadon->id,
                'ten'           => $req->hoten,
                'email'         => $req->$emailKH,
                'sdt'           => $req->sdt,
                'dia_chi'       => $req->diachi,
                'paymentMethod' => $req->paymentMethod,
                'ghi_chu'       => $req->ghichu
            );

            Mail::send('user.page.mail.mail-order',['cart_array' => $cart_array, 'shipping_array' => $shipping_array]
            , function($message) use ($title_email,$emailKH) {
                $message->to($emailKH)->subject($title_email);
                $message->from($emailKH,$title_email);
            });
            Session::forget('cart');
            return redirect()->route('trangchu');
            
        }

        //Đặt hàng khi chưa đăng nhập
        else
        {
            $User = new User;
            $User->vai_tro_id = 1;
            $User->email = $req->email;
            $User->ten = $req->hoten;
            $User->sdt = $req->sdt;
            $User->gioi_tinh = $req->gioitinh;
            $User->save();

            $hoadon = new HoaDon;
            $mahd = now();
            $hoadon->ma_hd = 'HD'.$mahd.'';
            $hoadon->khach_hang_id = $User->id;
            $hoadon->ngay_dat = now();
            $hoadon->tong_tien = $giohang->tongTien;
            $hoadon->dia_chi_nhan = $req->diachi;
            $hoadon->hinh_thuc_thanh_toan = $req->paymentMethod;
            $hoadon->ghi_chu = $req->ghichu;
            $hoadon->tinh_trang = 'Đang duyệt';
            $hoadon->save();

            foreach($giohang->items as $key => $value) {
                //Update số lượng khi đặt hàng
                $updateSL = ChiTietSP::find($key);
                $updateSL->so_luong -= $value['so_luong'];
                $updateSL->save();

                $chitiethoadon = new ChiTietHoaDon;
                $chitiethoadon->hoa_don_id = $hoadon->id;
                $chitiethoadon->san_pham_id = $key;
                $chitiethoadon->so_luong = $value['so_luong'];
                $chitiethoadon->don_gia = ($value['gia']/$value['so_luong']);
                $chitiethoadon->thanh_tien = ($value['gia']/$value['so_luong'])*$value['so_luong'];
                $chitiethoadon->save();      
            }

        }


    }

    public function datHangPayPal(Request $req) {
        //Lấy giỏ hàng
        $giohang = Session::get('cart');

        //Đặt hàng khi đã đăng nhập
        if (Auth::check()) {     
            $hoadon = new HoaDon;
            $mahd = now();
            $hoadon->ma_hd = 'HD'.$mahd.'';
            $hoadon->khach_hang_id = Auth::user()->id;
            $hoadon->ngay_dat = now();
            $hoadon->tong_tien = $giohang->tongTien;
            $hoadon->dia_chi_nhan = $req->diachi;
            $hoadon->hinh_thuc_thanh_toan = "PayPal";
            $hoadon->ghi_chu = $req->ghichu;
            $hoadon->tinh_trang = 'Đang duyệt';
            $hoadon->save();

            foreach($giohang->items as $key => $value) {

                //Update số lượng khi đặt hàng
                $updateSL = ChiTietSP::find($key);
                $updateSL->so_luong -= $value['so_luong'];
                $updateSL->save();

                $chitiethoadon = new ChiTietHoaDon;
                $chitiethoadon->hoa_don_id = $hoadon->id;
                $chitiethoadon->san_pham_id = $key;
                $chitiethoadon->so_luong = $value['so_luong'];
                $chitiethoadon->don_gia = ($value['gia']/$value['so_luong']);
                $chitiethoadon->thanh_tien = ($value['gia']/$value['so_luong'])*$value['so_luong'];
                $chitiethoadon->save();
            }

            $now = date('Y-m-d');
            $title_email = "Đơn hàng xác nhận ngày".' '.$now;
            if(Auth::check()) {
                $khachhang = User::find(Auth::user()->id);
            }
            $emailKH = $khachhang->email;

            if(Session::get('cart')==true) {
                foreach($giohang->items as $key => $value) {
                    $cart_array[] = array(
                        'ten_sp' =>$value['item']['ten_sp'],
                        'gia' => $value['gia'],
                        'so_luong' => $value['so_luong']
                    );
                }
            }

            $shipping_array = array(
                'id'            =>$hoadon->id,
                'ten'           => $req->hoten,
                'email'         => $req->email2,
                'sdt'           => $req->sdt,
                'dia_chi'       => $req->diachi,
                'paymentMethod' => $req->paymentMethod,
                'ghi_chu'       => $req->ghichu
            );

            Mail::send('user.page.mail.mail-order',['cart_array' => $cart_array, 'shipping_array' => $shipping_array]
            , function($message) use ($title_email,$emailKH) {
                $message->to($emailKH)->subject($title_email);
                $message->from($emailKH,$title_email);
            });
            
        }

        //Đặt hàng khi chưa đăng nhập
        else
        {
            $User = new User;
            $User->vai_tro_id = 1;
            // $User->email = $req->email;
            $User->ten = $req->hoten;
            $User->sdt = $req->sdt;
            $User->gioi_tinh = $req->gioitinh;
            $User->save();

            $hoadon = new HoaDon;
            $mahd = now();
            $hoadon->ma_hd = 'HD'.$mahd.'';
            $hoadon->khach_hang_id = $User->id;
            $hoadon->ngay_dat = now();
            $hoadon->tong_tien = $giohang->tongTien;
            $hoadon->dia_chi_nhan = $req->diachi;
            $hoadon->hinh_thuc_thanh_toan = 'PayPal';
            $hoadon->ghi_chu = $req->ghichu;
            $hoadon->tinh_trang = 'Đang duyệt';
            $hoadon->save();

            foreach($giohang->items as $key => $value) {
                //Update số lượng khi đặt hàng
                $updateSL = ChiTietSP::find($key);
                $updateSL->so_luong -= $value['so_luong'];
                $updateSL->save();

                $chitiethoadon = new ChiTietHoaDon;
                $chitiethoadon->hoa_don_id = $hoadon->id;
                $chitiethoadon->san_pham_id = $key;
                $chitiethoadon->so_luong = $value['so_luong'];
                $chitiethoadon->don_gia = ($value['gia']/$value['so_luong']);
                $chitiethoadon->thanh_tien = ($value['gia']/$value['so_luong'])*$value['so_luong'];
                $chitiethoadon->save();      
            }
            
        }

        

    }

    public function datHangThanhCong() {
        Session::forget('cart');
        alert()->success('Đặt hàng thành công!','Cảm ơn quý khách đã mua sản phẩm của chúng tôi ♥');
        return redirect()->route('trangchu');
    }
}
