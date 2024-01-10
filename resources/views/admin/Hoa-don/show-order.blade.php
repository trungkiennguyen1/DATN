@extends('admin.layout')
@section('main-content')

<div class="table-responsive">
    <table class="table">
        <thead class="thead-default">

            <tr>
                <!-- <th scope="col">@sortablelink('ten_tai_khoan', 'Tên Tài Khoản', '', ['style' => 'color: black'])</th> -->
                <th scope="col">@sortablelink('ma_hd', 'Id', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('tong_tien', 'Tên sản phẩm', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('ngay_dat', 'Đơn giá', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('dia_chi_nhan', 'Số lượng', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('tinh_trang', 'Thành tiền', '', ['style' => 'color: black'])</th>
                
            </tr>
        </thead>
        <tbody>
            {{-- @php $i = $order->firstItem(); @endphp --}}
            @foreach($order as $orders)
            <tr>
                <td>{{ $orders->id }}</td>
                <td>{{ $orders->ten_sp }}</td>
                <td>{{ number_format($orders->don_gia),2 }}VNĐ</td>
                <td>{{ $orders->so_luong }}</td>
                <td>{{ number_format($orders->thanh_tien),2 }}VNĐ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection