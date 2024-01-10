<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonHangController extends Controller
{
    public function index()
    {
        $order=HoaDon::where('khach_hang_id',Auth::user()->id)->get();
        //dd($order);
        return view('user.page.don-hang.index')->with('order',$order);
    }

    public function viewOrder(Request $request,$id)
    {
        $order=\DB::table('chi_tiet_hoa_don')
        ->join('hoa_don','chi_tiet_hoa_don.hoa_don_id','=','hoa_don.id')
        ->join('chi_tiet_sp','chi_tiet_sp.id','=','chi_tiet_hoa_don.san_pham_id')
        ->select('chi_tiet_hoa_don.*','chi_tiet_sp.ten_sp')
        ->where('chi_tiet_hoa_don.hoa_don_id','=',$id)->get();
        //dd($order);
        return view('user.page.don-hang.chi-tiet-don',compact('order'));
    }
}
