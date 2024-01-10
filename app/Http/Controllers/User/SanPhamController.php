<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChiTietSP;
use App\Models\SanPham;
use App\Models\GioHang;

class SanPhamController extends Controller
{
    public function index() {
        // $sanpham = ChiTietSP::All();
        $sanpham = ChiTietSP::where('tinh_trang','0')->get();

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

        return view('user.page.san-pham.sanpham',compact('sanpham'));
    }
    public function new() {
        $sanpham = ChiTietSP::where('new',0)->where('tinh_trang','0')->get();     

        if(isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if($sort_by=='tang-dan') {
                $sanpham = ChiTietSP::where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($sort_by=='giam-dan') {
                $sanpham = ChiTietSP::where('new',0)->where('tinh_trang','0')->orderby('gia','DESC')->get();
            }
            elseif($sort_by=='moi-cu') {
                $sanpham = ChiTietSP::where('new',0)->where('tinh_trang','0')->orderby('created_at','DESC')->get();
            }
            elseif($sort_by=='cu-moi') {
                $sanpham = ChiTietSP::where('new',0)->where('tinh_trang','0')->orderby('created_at','ASC')->get();
            }
            elseif($sort_by=='A-Z') {
                $sanpham = ChiTietSP::where('new',0)->where('tinh_trang','0')->orderby('ten_sp','ASC')->get();
            }
            elseif($sort_by=='Z-A') {
                $sanpham = ChiTietSP::where('new',0)->where('tinh_trang','0')->orderby('ten_sp','DESC')->get();
            }

        }

        if(isset($_GET['price'])) {
            $price = $_GET['price'];

            if($price=='1') {
                $sanpham = ChiTietSP::where('gia','<',300000)->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='2') {
                $sanpham = ChiTietSP::whereBetween('gia',[300000, 500000])->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='3') {
                $sanpham = ChiTietSP::whereBetween('gia',[500000, 700000])->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='4') {
                $sanpham = ChiTietSP::whereBetween('gia',[700000, 1000000])->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='5') {
                $sanpham = ChiTietSP::whereBetween('gia',[1000000, 1200000])->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='6') {
                $sanpham = ChiTietSP::whereBetween('gia',[1200000, 1500000])->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='7') {
                $sanpham = ChiTietSP::whereBetween('gia',[1500000, 2000000])->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($price=='8') {
                $sanpham = ChiTietSP::where('gia','>',2000000)->where('new',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }

        }
  
        return view('user.page.san-pham.sanpham',compact('sanpham'));
    }

    public function sale() {
        $sanpham = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang','0')->get();

        if(isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if($sort_by=='tang-dan') {
                $sanpham = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang','0')->orderby('gia','ASC')->get();
            }
            elseif($sort_by=='giam-dan') {
                $sanpham = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang','0')->orderby('gia','DESC')->get();
            }
            elseif($sort_by=='moi-cu') {
                $sanpham = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang','0')->orderby('created_at','DESC')->get();
            }
            elseif($sort_by=='cu-moi') {
                $sanpham = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang','0')->orderby('created_at','ASC')->get();
            }
            elseif($sort_by=='A-Z') {
                $sanpham = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang','0')->orderby('ten_sp','ASC')->get();
            }
            elseif($sort_by=='Z-A') {
                $sanpham = ChiTietSP::where('giam_gia','<>',0)->where('tinh_trang','0')->orderby('ten_sp','DESC')->get();
            }

        }

        if(isset($_GET['price'])) {
            $price = $_GET['price'];
            
            if($price=='1') {
                $sanpham = ChiTietSP::where('gia','<',300000)->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }
            elseif($price=='2') {
                $sanpham = ChiTietSP::whereBetween('gia',[300000, 500000])->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }
            elseif($price=='3') {
                $sanpham = ChiTietSP::whereBetween('gia',[500000, 700000])->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }
            elseif($price=='4') {
                $sanpham = ChiTietSP::whereBetween('gia',[700000, 1000000])->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }
            elseif($price=='5') {
                $sanpham = ChiTietSP::whereBetween('gia',[1000000, 1200000])->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }
            elseif($price=='6') {
                $sanpham = ChiTietSP::whereBetween('gia',[1200000, 1500000])->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }
            elseif($price=='7') {
                $sanpham = ChiTietSP::whereBetween('gia',[1500000, 2000000])->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }
            elseif($price=='8') {
                $sanpham = ChiTietSP::where('gia','>',2000000)->where('giam_gia','<>',0)->where('tinh_trang','0')->get();
            }

        }

        return view('user.page.san-pham.sanpham',compact('sanpham'));

    }


    public function quickview(Request $req) {
        $product_id = $req->product_id;
        $product = ChiTietSP::find($product_id);
        $output['product_name'] = $product->ten_sp;
        $output['product_id'] = $product->id;

        if($product->giam_gia > 0) {
            $output['product_gia'] = number_format($product->gia,0,",","."). 'đ';
            $output['product_giamgia'] = number_format($product->gia*((100-$product->giam_gia)/100),0,",","."). 'đ';
        }
        else
        {
            $output['product_gia'] = number_format($product->gia,0,",","."). 'đ';
            $output['product_giamgia'] ='';
        }

        if($product->so_luong > 0) {
            $output['product_tinhtrang'] = '<span style="color:Green;">
            <span style="font-size: 17px; font-weight: bold;">
                
                Còn hàng
                
            </span>
            </span>';

            $output['product_buttonGH'] = '<form action="/cart-add/'.$product->id.'" method="GET">                     
                <div class="form-group form_button_details ">							
                    <span style = "font-size: 18px">Số lượng: <input style="text-align: center;font-weight:bold;font-size: 18px; width:80px; height: 30px;border: 2px solid #15b21f;border-radius: 10px;" class="cart_quantity_input" type="number" name="quantity" value="1" required="" maxlength="2" min="1" max="'.$product->so_luong.'"></input></span>
                    <span style="margin-left:20px; font-size: 17px; font-weight: bold;">'.$product->so_luong.' sản phẩm có sẵn</span>
                    <br><br>          
                    <button type="submit" class="btn btn-lg  btn-cart button_cart_buy_enable" title="Cho vào giỏ hàng">
                        <i class="fa fa-shopping-basket hidden" ></i>
                        <span style="font-size: 16px; font-weight: bold;"  >THÊM VÀO GIỎ HÀNG</span>
                    </button>
                    <br><br>
                </div>
             </form>';
        }
        else {
            $output['product_tinhtrang'] = '<span style="color:red;">
            <span style="font-size: 17px; font-weight: bold;">
                
                Hết hàng
                
            </span>
            </span>';

            $output['product_buttonGH'] ='';
        }


        $output['product_thuonghieu'] = $product->nha_san_xuat->ten;
        $output['product_hinhanh'] = '<div class="row">
                                        <div class="col_large_default large-image">
                                            <a href="anh_sp/'.$product->san_pham->hinh_anh.'" class="large_image_url checkurl"  data-rel="prettyPhoto[product-gallery]" >
                                                    
                                                <img style="width: 250px; height: 250px;"class="img-responsive" alt="'.$product->ten_sp.'" src="anh_sp/'.$product->san_pham->hinh_anh.'" data-zoom-image="anh_sp/'.$product->san_pham->hinh_anh.'"/>
                                            </a>
                                        </div>
                                        <div id="gallery_02" class="col-sm-12 col-xs-12 col-lg-5 col-md-5 owl_width no-padding owl-carousel owl-theme thumbnail-product thumb_product_details not-dqowl" data-loop="false" data-lg-item="3" data-md-items="3" data-sm-items="3" data-xs-items="3" data-margin="10">

                                        </div>
                                    </div>';
        $output['product_motachitiet'] = '<p>
        - Chất Liệu: &nbsp;'.$product->chat_lieu.'<br />
        - Số Ngăn: &nbsp;'.$product->so_ngan.'<br />
        - Màu: &nbsp;'.$product->mau_sac.'<br />
        - Khối Lượng: &nbsp;'.$product->khoi_luong.' Kg<br />
        - Kích Thước (DàixRộngxCao): &nbsp;'.$product->kich_thuoc.' cm<br />
        - Tải Trọng: &nbsp;'.$product->tai_trong.' Kg<br>
        - Ngăn laptop: &nbsp;'.$product->ngan_lap.' inch</p>';                   
        echo json_encode($output);

    }
}
