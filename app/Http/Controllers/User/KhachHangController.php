<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Classes\Helper;
use Session;
class KhachHangController extends Controller
{
    public function nguoidung($id) {
        if(Auth::check()) {
            $user = User::findOrFail($id);
            return view('user.page.nguoi-dung.nguoidung',compact('user'));
        }
        else {
            return view('user.dangnhapdangky');
        }
    }

    public function doipassword($id,request $request) {
        $user = User::find($id);
        $pass = $request->Password;
        if(Hash::check($pass,$user->password))
            { 
                if($request->Repassword == $request->Newpassword && $request->Password != $request->Newpassword)
                {
                    $user->password = Hash::make($request->Newpassword);
                    $user->save();
                    alert()->success('Đổi mật khẩu thành công!');
                }
                elseif($request->Password == $request->Newpassword)
                {
                    alert()->error('Mật khẩu mới phải khác với mật khẩu cũ!');
                }
                else
                alert()->error('Nhập lại không trùng khớp');
           }
        else
            alert()->error('Mật khẩu không chính xác!');
        return back();
         
    }
    public function getedit_khachhang($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function edit_hinhanh($id,Request $request){
        $user = User::findOrFail($id);
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('assetsUser/images'), $imageName);
                $user->hinh_dai_dien=$imageName;
            }
        }
        if($user->save())
            alert()->success('Cập nhập hình ảnh thành công!');
        else
            alert()->error('Cập nhập hình ảnh thất bại!');
        return back(); 
            
    }


    public function edit_khachhang(request $request){
        $user = User::find( $request->id);
        $user->ten=$request->name;
        $user->sdt=$request->phone;
        $user->dia_chi=$request->lat;
        $user->gioi_tinh= $request->type;
        if( $user->save())
        alert()->success('Đổi thông tin thành công!');
        return back();
    }
}
