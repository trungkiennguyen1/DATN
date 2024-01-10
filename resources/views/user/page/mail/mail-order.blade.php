<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="background: #d6f0ff;font-size: 16px; border-radius: 12px; padding: 15px;">
        <div class="col-md-12">
            <p style="text-align: center; color: #000;">*Đây là mail tự động. Quý khách vui lòng không trả lời email này.</p>
            <div class="row" style="background: cadeblue; padding: 15px">

                <div class="col-md-6" style="text-align: center; color: #000; font-weight: bold; font-size: 30px">
                    <h4 style="margin:0">Shop Balo, túi xách Smarket.vn</h4>
                    <h6 style="margin:0">DỊCH VỤ BÁN HÀNG - VẬN CHUYỂN - NHẬP KHẨU CHUYÊN NGHIỆP</h6>
                </div>
                <div class="col-md-6 logo" style="color: #000">
                    <p>Chào bạn: <strong style="color:#000; text-decoration: underline">{{$shipping_array['ten']}}</strong></p>
                </div>
                <div class="col-md-12">
                    <p style="color: #000;font-size: 17px;">Bạn đã đăng ký mua hàng tại shop với thông tin như sau: </p>
                    <h4 style="color: #000; text-transform: uppercase">Thông tin đơn hàng</h4>
                    <p style="color: #000;">- Mã đơn hàng: <strong style="text-transform: uppercase; color: #000;">{{$shipping_array['id']}}</strong></p>
                    <h4 style="color:#000; text-transform: uppercase;">Thông tin người nhận</h4>
                    <p style="color:#000;">- Email: 
                        <span style="color:#000">{{$shipping_array['email']}}</span>
                    </p>
                    <p style="color:#000;">- Họ và tên người gửi: 
                        <span style="color:#000">{{$shipping_array['ten']}}</span>
                    </p>
                    <p style="color:#000;">- Số điện thoại: 
                        <span style="color:#000">{{$shipping_array['sdt']}}</span>
                    </p>
                    <p style="color:#000;">- Địa chỉ nhận hàng: 
                        <span style="color:#000">{{$shipping_array['dia_chi']}}</span>
                    </p>
                    <p style="color:#000;">- Ghi chú đơn hàng: 
                        <span style="color:#000">{{$shipping_array['ghi_chu']}}</span>
                    </p>
                    <p style="color:#000;">- Hình thức thanh toán: 
                        <span style="color:#000">{{$shipping_array['paymentMethod']}}</span>
                    </p>

                    <h4 style="color: #000; text-transform: uppercase">Sản phẩm đã đặt: </h4>
                    <table class="table table-striped" style="border: 1px">
                        <thead>
                            <tr style="color:#000;">
                                <th>Sản phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng đặt</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sub_total = 0 ;
                            $total = 0;
                            @endphp
                            
                            @foreach($cart_array as $cart)
                            @php
                            $sub_total = $cart['gia'];
                            $total = Session::get('cart')->tongTien;
                            @endphp

                            <tr style="color:#000;">
                                <td>{{$cart['ten_sp']}}</td>
                                <td>{{number_format(($cart['gia']/$cart['so_luong']),0,",",".")}} đ </td> 
                                <td align="center">{{$cart['so_luong']}} </td>
                                <td>{{number_format($sub_total,0,",",".")}} đ </td></td>
                            </tr>
                            @endforeach

                            <tr>
                                <td style="color:#000; font-weight: bold" colspan="4" align="right">Tổng tiền phải thanh toán: {{number_format($total,0,",",".")}} đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p style="color: #000; font-weight: bold">Mọi chi tiết liên hệ website tại: <a href="http://127.0.0.1:8000/">SMARKET.VN</a>, hoặc liên hệ qua số hotline: 0973349676. Xin cảm ơn quý khách đã mua hàng shop chúng tôi.</p>
            </div>
        </div>
    </div>
</body>
</html>