<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class DangNhapDangKyController extends Controller
{
    //
    public function index(){
        if(Auth::check()) {
            alert()->error('Lỗi!','Bạn đã đăng nhập vào Website!');
            return redirect()->route('trangchu');
        } else {
            return view('user.dangnhapdangky');
        }
        
    }
    public function __construct()
    {
    }

    public function dangky(Request $request) {

        $validator = Validator::make($request->all(), [
            'emaildk'=>'unique:khach_hang,email',
        ],
        [
            'emaildk.unique'=>'Email đăng ký đã tồn tại!',
        ]);
        if($validator->fails()) {
            return back()->with('toast_error',$validator->messages()->all()[0])->withInput();
        }


        $user = new User;
        $user->ten = $request->tendk;
        $user->email = $request->emaildk;
        $user->sdt = $request->sdtdk;
        $user->password = Hash::make($request->passworddk);
        $user->vai_tro_id = 1;
        $user->save();
        alert()->success('Đăng ký thành công!');
        return back();
    }


    public function kiemTraDangNhap(Request $request){

        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20',
        ],
        [
            'email.required'=>'Vui lòng nhập Email',
            'email.email'=>'Email không đúng định dạng!',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự!',
            'password.max'=>'Mật khẩu không quá 20 ký tự!'
        ]);
        
        if($validator->fails()) {
            return back()->with('toast_error',$validator->messages()->all()[0])->withInput();
        }
        
        
        $credentials = [
            'email'         => $request->email,
            'password'      => $request->password
        ];

        if(Auth::attempt($credentials)) {
            alert()->success('Đăng nhập thành công!');
            return redirect()->route('trangchu');
        } else{
            alert()->error('Email hoặc Pasword chưa chính xác!');
            return back();
        }
    }

    public function dangxuat() {
        Auth::logout();
        alert()->success('Đăng xuất thành công!');
        return back();
    }

    public function login_google(){
        return Socialite::driver('google')->redirect();
        }

    public function callback_google(){

        try {
  
            $user = Socialite::driver('google')->user();
   
            $finduser = User::where('google_id', $user->id)->first();
   
            if($finduser){
   
                Auth::login($finduser);
                alert()->success('Đăng nhập thành công!');
                return redirect('trangchu');
   
            }else{
                $newUser                = new User;
                $newUser->email             = $user->email;
                $newUser->vai_tro_id        = 1;
                $newUser->google_id         = $user->id;
                $newUser->ten               = $user->name;
                $newUser->hinh_dai_dien     = $user->avatar;
                $newUser->save();
    
                Auth::login($newUser);
                alert()->success('Đăng nhập thành công!');
                return redirect('trangchu');
            }
  
        } catch (Exception $e) {
            return redirect('login-google');
        }
    
    }

    public function login_facebook() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook() {
        try {
  
            $user = Socialite::driver('facebook')->user();
   
            $finduser = User::where('provider_id', $user->id)->first();
   
            if($finduser){
   
                Auth::login($finduser);
                alert()->success('Đăng nhập thành công!');
                return redirect('trangchu');
   
            }else{
                $newUser                    = new User;
                $newUser->email             = $user->email;
                $newUser->vai_tro_id        = 1;
                $newUser->provider          = 'facebook';
                $newUser->provider_id       = $user->id;
                $newUser->ten               = $user->name;
                $newUser->save();
    
                Auth::login($newUser);
                alert()->success('Đăng nhập thành công!');
                return redirect('trangchu');
            }
  
        } catch (Exception $e) {
            return redirect('login-google');
        }
    }

    
  
}
