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
                    
                    <li >
                        <a itemprop="url" href="gioithieu"><span >Chính sách FreeShip</span></a>	
                        <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                    </li>

                    <div class="static-contain">
                        <h2 style="text-align: center;"><strong>GIAO HÀNG TOÀN QUỐC MIỄN PHÍ</strong></h2>
                        <p><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;">Shop <strong>SMAKET</strong> của chúng tôi đảm bảo miễn phí vận chuyển cho mọi đơn hàng với các Tỉnh, Thành Phố theo như dưới hình ảnh</span></span></p>
                        <img class="img-responsive" style="width:600px; height: 900px" src="{{asset('assetsUser/images/phan-phoi-phu-kien-tu-bep.jpg')}}"><br>
                        <img class="img-responsive" width="1140px" src="{{asset('assetsUser/images/jewelry-banner.jpg')}}">
                        
				    </div>
                </ul>
            </div>
        </div>
    </div>
</section>
</body>
</html>
@endsection	