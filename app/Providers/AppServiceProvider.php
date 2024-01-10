<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\LoaiSP;
use App\Models\GioHang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Sheet;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('user.layout.header',function($view){
            $loai_sp = LoaiSP::all();
            $view->with('loai_sp',$loai_sp);
        });

        view()->composer(['user.page.gio-hang.giohang','user.page.dat-hang.dathang'],function($view){
            if(Session('cart')) {
                $oldCart = Session::get('cart');
                $cart = new GioHang($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'tongTien'=>$cart->tongTien,'tongSL'=>$cart->tongSL]);
            }
        });

     
        Paginator::useBootstrap();

        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });

        Sheet::macro('setCellValue', function (Sheet $sheet, string $cellRange, string $data, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->getValue($data);
        });

        Sheet::macro('setWidth', function (Sheet $sheet, string $cellRange, int $width) {
            $sheet->getDelegate()->getColumnDimension($cellRange)->setWidth($width);
        });

        Sheet::macro('numberFormat', function (Sheet $sheet, string $cellRange) {
            $sheet->getDelegate()->getStyle($cellRange)->getNumberFormat()->setFormatCode('0,000');
        });

        Sheet::macro('dateFormat', function (Sheet $sheet, string $cellRange) {
            $sheet->getDelegate()->getStyle($cellRange)->getNumberFormat()->setFormatCode('DD-MM-YYYY');
        });
        
        Sheet::macro('wrapText', function (Sheet $sheet, string $cellRange) {
            $sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
        });
    }
}
