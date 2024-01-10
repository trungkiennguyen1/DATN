@extends('user.master')
@section('content')
    <section class="bread-crumb clearfix">
        <span class="crumb-border"></span>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 a-left">
                    <ul class="breadcrumb">
                        <li class="home">
                            <a itemprop="url" href="trangchu"><span>Trang chủ</span></a>
                            <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                        </li>

                        <li>
                            <a itemprop="url" href="#"><span>Đơn hàng của bạn</span></a>
                            <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                        </li>
                        <br />

                        <br/>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#STT</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá </th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                              </tr>
                            </thead>
                            <tbody>
            
                                @foreach($order as $data)
                              <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td>{{ $data->ten_sp }}</td>
                                <td>{{ number_format($data->don_gia),2 }}VNĐ</td>
                                <td>{{ $data->so_luong }}</td>
                                <td>{{ number_format($data->thanh_tien),2 }}VNĐ</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        
                        <li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
