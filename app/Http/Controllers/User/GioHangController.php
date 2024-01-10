<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChiTietSP;
use App\Models\GioHang;
use App\Models\SanPham;
use Illuminate\Support\Facades\Session;



class GioHangController extends Controller
{
    public function cartAdd(Request $req, $id) {
        
        $sanpham = ChiTietSP::find($id);
        $hinhanh = SanPham::find($id);

        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new GioHang($oldCart);
        $quantity = $req->quantity;
        $cart->add($sanpham,$hinhanh,$quantity, $id);
        $req->session()->put('cart',$cart);

        toast('Thêm sản phẩm vào giỏ hàng thành công!','success');
        return redirect('giohang');
    }

    public function cartDel(Request $req, $id) {
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new GioHang($oldCart);
        $cart->removeItem($id);
        Session::put('cart',$cart);
        toast('Xóa sản phẩm thành công!','success');
        return redirect('giohang');
    }

    public function xoaHet() {
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new GioHang($oldCart);
        $cart->xoaHet();
        Session::forget('cart');
        toast('Xóa giỏ hàng thành công!','success');
    }

    public function index(Request $req)
    {
        $chitietsanpham = ChiTietSP::where('id',$req->id)->first();
        
        return view('user.page.gio-hang.giohang',compact('chitietsanpham'));
    }

    public function updateCartQty(Request $req, $id) {
        $sanpham = ChiTietSP::find($id);
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new GioHang($oldCart);
        $quantity = $req->quantity;
        $cart->updateQty($sanpham,$quantity,$id);
        $req->session()->put('cart',$cart);
        toast('Cập nhập số lượng thành công!','success');
        return redirect()->back();
    }
}
