<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\ChiTietHoaDon;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Support\Facades\DB;


use App\Http\Requests\HoaDon\UpdateRequest;
use App\Helpers\UploadFile as Upload;

use App\Exports\HoaDonExport;

class HoadonController extends Controller
{
    private $viewFolder = 'Hoa-don';
    private $page = 'Hóa đơn';

    public function index(Request $req) {
        $pageInfo = [
            'page'  => $this->page
        ];

        $inputSearch = [
            'ma_hd'   => $req-> ma_hd,
            'tong_tien'       => $req->tong_tien,
           
        ];

        $isSearch = false;
        foreach($inputSearch as $key => $value) {
            if (!empty($value)) {
                $isSearch = true;
                break;
            }
        }

        $hoadon = HoaDon::sortable();

        if (!empty($req->ma_hd)) {
            $hoadon->where('ma_hd', 'like', "%{$req->ma_hd}%");
        }

        if (!empty($req->tong_tien)) {
            $hoadon->where('tong_tien', 'like', "%{$req->tong_tien}%");
        }

        if (!empty($req->ngay_dat)) {
            $hoadon->where('ngay_dat', $req->ngay_dat);
        }

        if (!empty($req->dia_chi_nhan)) {
            $hoadon->where('dia_chi_nhan', $req->dia_chi_nhan);
        }

        $hoadon = $hoadon->orderBy('ma_hd') ->paginate($this->limit);
        // echo "<pre>";
        // print_r($hoadon);
        // exit;

        return view("admin.{$this->viewFolder}.list", compact('pageInfo', 'hoadon', 'inputSearch', 'isSearch'));
    }

    public function edit($id) {
        $pageInfo = [
            'subtitle'  => $this->edit,
            'page'      => $this->page,
            'route'     => $this->viewFolder
        ];

        $hoadon = HoaDon::find($id);

        
        if (!empty($hoadon)) {
            
        
            return view("admin.{$this->viewFolder}.store-edit", compact('pageInfo', 'hoadon'));
        }

        $status = 'error';
        $message = $this->msgNotFound;

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

    public function update(Request $req, $id) {
        $status = 'error';
        $message = $this->msgUpdateErr;
        
        $hoadon = HoaDon::find($id);

        if (!empty($hoadon)) {
            
            $valid = $this->validate($req, (new UpdateRequest)->rules($hoadon->id), (new UpdateRequest)->messages());
               
                $hoadon->update([
                    'ma_hd' => $valid['ma_hd'],
                    'tong_tien'        => $valid['tong_tien'],
                    'dia_chi_nhan'     => $valid['dia_chi_nhan'],
                    'tinh_trang' =>$valid['tinh_trang']
                    
                ]);

            
                
                $status = 'success';
                $message = $this->msgUpdateSuc;
            }
        

        return redirect()->route("{$this->viewFolder}.list")->with('status', $status)->with('message', $message);
    }

  

    public function destroy(Request $req) {
        $id = $req->id;

        $hoadon = HoaDon::find($id);

        if (!empty($hoadon)) {
            //$hoadon->delete();

            return response()->json([
                'title'     => 'Xóa hóa đơn',
                'status'    => 'success',
                'msg'       => $this->msgDeleteSuc
            ]);
        }

        return response()->json([
            'title'     => 'Xóa hóa đơn',
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

        $hoadon = HoaDon::getProductByDate($req)
                           ->paginate($this->limit);
        // $hoadon=HoaDon::whereMonth('ngay_dat',$req->ngay_bd)->whereMonth('ngay_dat',$req->ngay_kt)
        // ->get();

        //dd($hoadon);

        return view("admin.{$this->viewFolder}.statistic", compact('pageInfo', 'hoadon', 'search'));
    }

    public function searchOrder(Request $req)
    {
        $pageInfo = [
            'page'  => 'Thống kê sản phẩm'
        ];

        $order = HoaDon::getProductByDate($req)
                           ->get();
                           //dd($hoadon);
        return view('admin.Hoa-don.order-search',compact('order','pageInfo'));
    }

    public function excel(Request $req) {
        $hoadon = HoaDon::getProductByDate($req)
                           ->get();
        foreach($hoadon as $hd) {
            $hd->ngay_dat = date('d-m-Y', strtotime($hd->ngay_dat));
            
        }
        //  echo "<pre>";
        //  print_r($hoadon);
        //  exit;
       
       
        return new HoaDonExport($hoadon);
    }

	public function inhoadon(Request $req)
    {
    	$hoadon = HoaDon::where('id',$req->id)->first();
        $chitiethoadon= ChiTietHoaDon::where('hoa_don_id',$req->id)->get();
        //$chitiethoadon=DB::table('chi_tiet_hoa_don')->where('hoa_don_id','=',$req->id)->first();
        //dd($chitiethoadon);
    	$pdf = PDF::loadView("admin.{$this->viewFolder}.invoice",  compact('hoadon','chitiethoadon'));
    		return $pdf->stream('invoice.pdf');
    }

    public function caneOrder(Request $request)
    {
        $id=$request->id;
        $orders=HoaDon::find($id);
        if($orders){
            $orders->tinh_trang='Đã hủy';
            $orders->save();
        }
        return response()->json([
            'title'     => 'Xóa hóa đơn',
            'status'    => 'success',
            'msg'       => $this->msgDeleteSuc
        ]);
    }

    public function showOrder($id)
    {
        $pageInfo = [
            'page'  => 'Chi tiết đơn hàng'
        ];

        $order=\DB::table('chi_tiet_hoa_don')
        ->join('hoa_don','chi_tiet_hoa_don.hoa_don_id','=','hoa_don.id')
        ->join('chi_tiet_sp','chi_tiet_sp.id','=','chi_tiet_hoa_don.san_pham_id')
        ->select('chi_tiet_hoa_don.*','chi_tiet_sp.ten_sp')
        ->where('chi_tiet_hoa_don.hoa_don_id','=',$id)->get();
        //dd($order);
        return view('admin.Hoa-don.show-order',compact('order','pageInfo'));
    }
}
