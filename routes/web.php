<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest', 'prefix' => 'admin/login', 'namespace' => 'admin\Login_Logout'], function() {
    Route::get('', 'LoginController@login')->name('login');
    Route::post('', 'LoginController@doLogin')->name('do-login');
});

Route::group(['middleware' => 'auth:admin'], function() {
    Route::group(['namespace' => 'admin\Login_Logout'], function() {
        Route::get('logout', 'LogoutController@logout')->name('logout');
    });

    Route::group(['namespace' => 'admin'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/order-today','DashboardController@getOrderToDay')->name('search.order.today');
        Route::get('/order-onWeek','DashboardController@getOrderOnWeek')->name('search.order.onweek');

        Route::prefix('chi-tiet-nhan-vien/{id}')->group(function() {
            Route::name('detail.')->group(function() {
                Route::get('', 'QuanTriVienController@show')->name('show');
                Route::post('', 'QuanTriVienController@updateDetail')->name('update');
                Route::get('doi-mat-khau', 'QuanTriVienController@viewChangePassDetail')->name('view-change');
                Route::post('doi-mat-khau', 'QuanTriVienController@changePassDetail')->name('do-change');
            });
        });

        Route::prefix('admin/nhan-vien')->group(function() {
            Route::name('nhan-vien.')->group(function() {
                Route::get('', 'QuanTriVienController@index')->name('list');
                Route::get('them-moi', 'QuanTriVienController@create')->name('create');
                Route::post('them-moi', 'QuanTriVienController@store')->name('store');
                Route::delete('xoa', 'QuanTriVienController@destroy')->name('delete');
                Route::get('cap-nhat/{id}', 'QuanTriVienController@edit')->name('edit');
                Route::post('cap-nhat/{id}', 'QuanTriVienController@update')->name('update');
                Route::post('doi-mat-khau', 'QuanTriVienController@changePass')->name('change-pass');
                Route::post('khoa-hoac-mo-khoa', 'QuanTriVienController@lockOrUnlockUser')->name('lock');
            });
        });

        Route::prefix('admin/khach-hang')->group(function() {
            Route::name('khach-hang.')->group(function() {
                Route::get('', 'KhachHangController@index')->name('list');
                Route::delete('xoa', 'KhachHangController@destroy')->name('delete');
                Route::post('doi-mat-khau', 'KhachHangController@changePass')->name('change-pass');
                Route::post('khoa-hoac-mo-khoa', 'KhachHangController@lockOrUnlockUser')->name('lock');
            });
        });

        Route::prefix('admin/vai-tro')->group(function() {
            Route::name('vai-tro.')->group(function() {
                Route::get('', 'VaiTroController@index')->name('list');
            });
        });

        Route::prefix('admin/nha-san-xuat')->group(function() {
            Route::name('nha-san-xuat.')->group(function() {
                Route::get('', 'NhaSanXuatController@index')->name('list');
                Route::get('them-moi', 'NhaSanXuatController@create')->name('create');
                Route::post('them-moi', 'NhaSanXuatController@store')->name('store');
                Route::delete('xoa', 'NhaSanXuatController@destroy')->name('delete');
                Route::get('cap-nhat/{id}', 'NhaSanXuatController@edit')->name('edit');
                Route::post('cap-nhat/{id}', 'NhaSanXuatController@update')->name('update');
            });
        });

        Route::prefix('admin/loai-san-pham')->group(function() {
            Route::name('loai-san-pham.')->group(function() {
                Route::get('', 'LoaiSPController@index')->name('list');
                Route::get('them-moi', 'LoaiSPController@create')->name('create');
                Route::post('them-moi', 'LoaiSPController@store')->name('store');
                Route::delete('xoa', 'LoaiSPController@destroy')->name('delete');
                Route::get('cap-nhat/{id}', 'LoaiSPController@edit')->name('edit');
                Route::post('cap-nhat/{id}', 'LoaiSPController@update')->name('update');
            });
        });

        Route::prefix('admin/san-pham')->group(function() {
            Route::name('san-pham.')->group(function() {
                Route::get('', 'SanPhamController@index')->name('list');
                Route::get('them-moi', 'SanPhamController@create')->name('create');
                Route::post('them-moi', 'SanPhamController@store')->name('store');
                Route::delete('xoa', 'SanPhamController@destroy')->name('delete');
                Route::get('cap-nhat/{id}', 'SanPhamController@edit')->name('edit');
                Route::post('cap-nhat/{id}', 'SanPhamController@update')->name('update');
                Route::get('chi-tiet-san-pham/{id}', 'SanPhamController@show')->name('detail');
                Route::get('thong-ke', 'SanPhamController@statistic')->name('statistic');
                Route::get('xuat-excel', 'SanPhamController@excel')->name('excel');
            });
        });


        Route::prefix('admin/Hoa-don')->group(function() {
            Route::name('Hoa-don.')->group(function() {
                Route::get('', 'HoadonController@index')->name('list');
                Route::get('cap-nhat/{id}', 'HoadonController@edit')->name('edit');
                Route::post('cap-nhat/{id}', 'HoadonController@update')->name('update');
                Route::get('inhoadon/{id}', 'HoadonController@inhoadon')->name('inhoadon'); 
                Route::delete('xoa', 'HoadonController@destroy')->name('delete');           
                Route::get('thong-ke', 'HoadonController@statistic')->name('statistic');
                Route::get('xuat-excel', 'HoadonController@excel')->name('excel');

                Route::get('/caneOrder','HoadonController@caneOrder')->name('cane.orders');
                Route::get('/showOrder/{id}','HoadonController@showOrder')->name('show.order');
                Route::get('thongke','HoadonController@searchOrder')->name('search.order');
                //Route::resource('HoaDon','HoaDonController');
                //Route::post('/xoa-don-hang/{id}','Admin\HoadonController@destroy')->name('hoa_don_delete');
            });
        });

        //oder code
        
       
    });
});




//Gr User
Route::group(['namespace' => 'User'], function() {
    //Đăng nhập đăng ký đăng xuất
    Route::get('/dangnhapdangky', 'DangNhapDangKyController@index')->name('dangnhapdangky');
    Route::post('/dangnhap','DangNhapDangKyController@kiemTraDangNhap')->name('dangnhap');
    Route::get('/dangxuat','DangNhapDangKyController@dangxuat')->name('dangxuat');
    Route::post('/dangky','DangNhapDangKyController@Dangky')->name('dangky');

    //Đăng nhập bằng gg
    Route::get('/login-google','DangNhapDangKyController@login_google')->name('login_google');
    Route::get('/google/callback','DangNhapDangKyController@callback_google')->name('callback_google');

    //Đăng nhập bằng FB
    Route::get('/login-facebook','DangNhapDangKyController@login_facebook')->name('login_facebook');
    Route::get('/facebook/callback','DangNhapDangKyController@callback_facebook')->name('callback_facebook');
   
   //người dùng
    Route::get('/nguoidung/{id}','khachhangController@nguoidung')->name('nguoidung');
    Route::post('/doipassword/{id}','khachhangController@doipassword')->name('doipassword');
    Route::get('/edits_khachhang/{id}','khachhangController@getedit_khachhang');
    Route::put('/edit_khachhang','khachhangController@edit_khachhang')->name('update_nguoidung');
    Route::post('/edit_Image/{id}','khachhangController@edit_hinhanh')->name('update_image');
    
    //page
    Route::get('/', 'TrangChuController@index')->name('trangchu');
    Route::get('/trangchu', 'TrangChuController@index')->name('trangchu');

    //sản phẩm
    Route::get('/sanpham', 'SanPhamController@index')->name('sanpham');
    Route::get('/sanpham/new', 'SanPhamController@new')->name('sanphamnew');
    Route::get('/sanpham/sale', 'SanPhamController@sale')->name('sanphamsale');
    Route::post('/quickview','SanPhamController@quickview')->name('quickview');
   
    //Chi tiết sản phẩm
    Route::get('/chitietsanpham/{id}', 'CTSPController@index')->name('chitietsanpham');

    Route::get('/gioithieu', 'GioiThieuController@index')->name('gioithieu');

    Route::get('/lienhe', 'LienHeController@index')->name('lienhe');

    Route::get('/loai_sp/{type}', 'LoaiSPController@index')->name('loai_sp');

    //Giỏ hàng
    Route::get('/giohang', 'GioHangController@index')->name('giohang');
    Route::get('/cart-add/{id}','GioHangController@cartAdd')->name('cart-add');
    Route::get('/cart-del/{id}','GioHangController@cartDel')->name('cart-del');
    Route::get('/xoa-het','GioHangController@xoaHet')->name('xoa-het');
    Route::get('/update-cart-qty/{id}','GioHangController@updateCartQty')->name('update-cart-qty');
    
    //Đặt hàng
    Route::get('/dathang', 'DatHangController@index')->name('dathang');
    Route::post('/dat-hang','DatHangController@datHang')->name('dat-hang');
    Route::post('/dat-hang-paypal','DatHangController@datHangPayPal')->name('dat-hang-pay');
    Route::get('/dathangpaythanhcong', 'DatHangController@datHangThanhCong')->name('dathangpaythanhcong');

    //Tìm kiếm
    Route::get('/search', 'TrangChuController@search')->name('search');

    //Chính sách
    Route::get('/chinhsachthanhtoan', 'TrangChuController@chinhsachthanhtoan')->name('chinhsachthanhtoan');
    Route::get('/chinhsachdoitrabaohanh', 'TrangChuController@chinhsachdoitrabaohanh')->name('chinhsachdoitrabaohanh');
    Route::get('/chinhsachfreeship', 'TrangChuController@chinhsachfreeship')->name('chinhsachfreeship');
    Route::get('/chinhsachhanghieu', 'TrangChuController@chinhsachhanghieu')->name('chinhsachhanghieu');

    Route::post('/vacancies/searchcat', 'SanPhamController@searchcat');

    Route::post('insert-rating','CTSPController@insert_rating')->name('insert_rating');



    Route::get('/don-hang','DonHangController@index')->name('donhang.index');
    Route::get('/chi-tiet-donhang/{id}','DonHangController@viewOrder')->name('chi-tiet-donhang');
    
});
