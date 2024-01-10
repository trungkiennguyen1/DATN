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
                            <a itemprop="url" href="#"><span>Tra cứu đơn hàng</span></a>
                            <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                        </li>
                        <br />

                        @if(count($order)>0)
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col"># Mã Đơn</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Tình trạng</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $orders)
                              <tr>
                                <th scope="row"><a href="{{ route('chi-tiet-donhang',$orders->id) }}"> {{ $orders->ma_hd }} </a></th>
                                <th scope="row">{{ $orders->khachdathang->ten }}</th>
                                <td>{{ $orders->dia_chi_nhan }}</td>
                                <td>{{ number_format($orders->tong_tien),2 }} VND</td>
                                <td>{{ $orders->tinh_trang }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          @else
                          <h3 style="text-align: center">Bạn chưa có đơn hàng</h3>
                          @endif
                        <li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
