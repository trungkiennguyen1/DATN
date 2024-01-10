<?php

namespace App\Http\Controllers\Admin\Login_Logout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('admin.login');
    }

    public function doLogin(Request $req) {
        $credentials = [
            'ten_tai_khoan' => $req->username,
            'password'      => $req->password
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('status', 'error')->with('message', 'Tên tài khoản hoặc mật khẩu không đúng');
    }
}
