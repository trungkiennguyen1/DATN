@extends('user.master')
@section('content')

    <section class="bread-crumb clearfix">
<span class="crumb-border"></span>
<div class="container">
    <div class="row">
        <div class="col-xs-12 a-left">
            <ul class="breadcrumb">					
                <li class="home">
                    <a itemprop="url" href="trangchu" ><span >Trang chủ</span></a>						
                    <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                </li>
                
                <li><strong ><span >Giỏ hàng</span></strong></li>
                
            </ul>
        </div>
    </div>
</div>
</section> 
<div class="container bg_white">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="page_title page__  margin-top-20 margin-bottom-20">
                <h1 class="title_page_h1"><span>Giỏ hàng</span></h1>
            </div>
        </div>
    </div>
</div>

  
    <section class="main-cart-page main-container col1-layout">
        <div class="main container hidden-xs hidden-sm bg_white">
        
            <div class="col-main cart_desktop_page cart-page">
                <div class="cart page_cart hidden-xs">
                @if(Session::has('cart'))  
                    @if(count($cart->items)>0)
                            <div class="bg-scroll">
                                <div class="cart-thead">
                                    <div style="width: 45%" class="a-left">Sản phẩm</div>
                                    <div style="width: 25%" class="a-center">
                                        <span class="nobr">Giá</span>
                                    </div>

                                    <div style="width: 14%" class="a-center">Số lượng</div>
                                    <div style="width: 16%" class="a-right">Thành tiền</div>
                            </div>

                            <div class="cart-tbody">

                                    <!-- Ảnh và màu sắc -->
                                    @foreach($product_cart as $product)
                                        
                                            <div class="item-cart">
                                                <div style="width: 10%" class="image">
                                                    <a class="product-image" title="{{$product['item']['ten_sp']}}" href="{{route('chitietsanpham',$product['item']['id'])}}">
                                                        <img width="75" height="auto" alt="{{$product['item']['ten_sp']}}" src="anh_sp/{{$product['hinh_anh']}}"></a>
                                                </div>
                                                <div style="width: 35%" class="a-left">
                                                    <h3 class="product-name"> 
                                                        <a class="text2line" href="{{route('chitietsanpham',$product['item']['id'])}}">{{$product['item']['ten_sp']}}</a> 
                                                    </h3>
                                                    <span class="variant-title">Màu: {{$product['item']['mau_sac']}}</span>
                                                    
                                                    <a class="remove-itemx remove-item-cart" title="Xóa SP"  href="{{route('cart-del',$product['item']['id'])}}">
                                                        <span>
                                                            <i class="fa fa-times"></i> Xoá SP
                                                        </span>
                                                    </a>
                                                </div>


                                                <!-- Giá -->
                                                <div style="width: 26%" class="a-center">
                                                    @if($product['item']['giam_gia']>0)
                                                        
                                                            <span class="price product-price-old">{{number_format($product['item']['gia'],0,",",".")}} đ</span>
                                                        
                                                        
                                                            <span class="price product-price" style="color: #000ed0;font-size:20px;font-weight:bold;">{{number_format($product['item']['gia']*((100-$product['item']['giam_gia'])/100),0,",",".")}} đ</span>
                                                        
                                                    @else
                                                        
                                                            <span class="price product-price" style="color: #000ed0;font-size:20px;font-weight:bold;">{{number_format($product['item']['gia'],0,",",".")}} đ</span>
                                                        
                                                    @endif
                                                </div>

                                        
                                                <!-- Số lượng -->
                                                <div style="width: 14%" class="a-center">
                                                    
                                                    <form action="{{route('update-cart-qty',$product['item']['id'])}}" method="GET">
                                                        
                                                        <input style="text-align: center;font-weight:bold;font-size: 16px;border: 1px solid #000000;border-radius: 10px;" class="cart_quantity_input" type="number" name="quantity" value="{{$product['so_luong']}}" required="" max="{{$product['item']['so_luong']}}" min="1">
                                                        <input style="color:blue;font-weight:bold;font-size: 16px; border: 2px solid #15b21f; margin-top: 5px;border-radius: 25px;" type="submit" value="Cập nhập" name="update_qty" class="btn btn-default btn-sm">
                                                    </form>
                                                </div>

                                                <!-- Tổng tiền -->
                                                @if($product['item']['giam_gia']>0)
                                                    <div style="width: 15%; font-size:19px; font-weight:bold;color:#000000" class="a-right">
                                                        <span class="cart-price"> 
                                                            <span style="font-size:20px; font-weight:bold;color:#000ed0" class="price">
                                                                {{number_format($product['so_luong']*$product['item']['gia']*((100-$product['item']['giam_gia'])/100),0,",",".")}} đ
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div style="width: 5%" class="a-center"></div>
                                                @else
                                                    <div style="width: 15%; font-size:19px; font-weight:bold;color:#000000" class="a-right">
                                                        <span class="cart-price"> 
                                                            <span style="font-size:20px; font-weight:bold;color:#000ed0" class="price">
                                                                {{number_format($product['so_luong']*$product['item']['gia'],0,",",".")}} đ
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div style="width: 5%" class="a-center"></div>
                                                @endif
                                            </div>
                                        
                                    @endforeach
                                  
                            </div>
                            <div style="font-size: 20px; color: black; margin-left: 790px; font-weight: bold; ">Tổng tiền phải thanh toán: 
                                <span class="cart-price"> 
                                    <span style="font-size:20px; font-weight:bold;color:#000ed0" class="price">
                                        {{number_format(Session('cart')->tongTien,0,",",".")}} đ
                                    </span>
                                </span>
                            </div>

                            
                                        <button onclick="xoahet()" title="Xóa hết sản phẩm" style="background-color: red; border-radius:10px; display: block; margin-top: 0em; margin-block-end: 1em;">
                                            <span style="font-size: 16px; font-weight: bold;  color: white; ">Xóa hết</span>
                                        </button>
                            


                            
                            <button class="btn btn-primary button btn-proceed-checkout f-right" title="Tiến hành đặt hàng" type="button" onclick="window.location.href='dathang'"> 
                                <span>Tiến hành đặt hàng</span>
                            </button>
                    @else

                        <h3> Không có sản phẩm nào trong giỏ hàng </h3>

                    @endif
                    
                @endif
                        <button class="btn btn-white f-right" title="Tiếp tục mua hàng" type="button" onclick="window.location.href='sanpham'">
                            <span>Tiếp tục mua hàng</span>
                        </button>
                </div>
            </div>
        </div>

    </section>



@endsection

<script>
    function xoahet(){
        Swal.fire({
        title: 'Bạn có chắc xóa hết sản phẩm trong giỏ hàng ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tôi đồng ý!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/xoa-het",
                method: "GET", 
                type: "DELETE"
            });
            location.reload();
        }
        })
    }
</script>
    <script type='text/javascript'>
        function loadCSS(e, t, n) { "use strict"; var i = window.document.createElement("link"); var o = t || window.document.getElementsByTagName("footer")[0]; i.rel = "stylesheet"; i.href = e; i.media = "only x"; o.parentNode.insertBefore(i, o); setTimeout(function () { i.media = n || "all" }) }loadCSS("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
        function loadCSS(e, t, n) { "use strict"; var i = window.document.createElement("link"); var o = t || window.document.getElementsByTagName("footer")[0]; i.rel = "stylesheet"; i.href = e; i.media = "only x"; o.parentNode.insertBefore(i, o); setTimeout(function () { i.media = n || "all" }) }loadCSS("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css");
        function loadCSS(e, t, n) { "use strict"; var i = window.document.createElement("link"); var o = t || window.document.getElementsByTagName("footer")[0]; i.rel = "stylesheet"; i.href = e; i.media = "only x"; o.parentNode.insertBefore(i, o); setTimeout(function () { i.media = n || "all" }) }loadCSS("https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css");
    </script>
</body>
</html>