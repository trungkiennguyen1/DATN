@extends('admin.layout')
@section('main-content')

<div class="table-responsive">
    <table class="table">
        <thead class="thead-default">

            <tr>
                <!-- <th scope="col">@sortablelink('ten_tai_khoan', 'Tên Tài Khoản', '', ['style' => 'color: black'])</th> -->
                <th scope="col">@sortablelink('ma_hd', 'Id', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('tong_tien', 'Mã hóa đơn', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('tong_tien', 'Tổng tiền', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('dia_chi_nhan', 'Ngày đặt', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('tinh_trang', 'Địa chỉ nhận', '', ['style' => 'color: black'])</th>
                <th scope="col">@sortablelink('tinh_trang','Tình Trạng', ['style' => 'color: black'])</th>
                <th scope="col">Hành động</th>
                
            </tr>
        </thead>
        <tbody>
            {{-- @php $i = $order->firstItem(); @endphp --}}
            @foreach($order as $orders)
            <tr>
                <td>{{ $orders->id }}</td>
                <td>{{ $orders->ma_hd }}</td>
                <td>{{ number_format($orders->tong_tien),2 }}VNĐ</td>
                <td>{{ $orders->ngay_dat }}</td>
                <td>{{ $orders->dia_chi_nhan}}</td>
                <td>{{ $orders->tinh_trang }}</td>
                <td>
                    <div>
                        <a href="{{ route('Hoa-don.edit', ['id' => $orders->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                        
                        <a href="{{route('Hoa-don.inhoadon', ['id' => $orders->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="In hóa đơn"><i class="fas fa-print"></i></a>
                        {{-- <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $hoadons->id }}" data-title="{{ $hoadons->ma_hd }}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a> --}}

                        <a href="{{ route('Hoa-don.show.order',$orders->id) }}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Xem" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        @if($orders->tinh_trang=='Đã duyệt')
                      
                        @elseif($orders->tinh_trang=='Đã hủy')

                        @else
                        <a href="javascript:void(0);" data-id="{{ $orders->id }}" data-title="{{ $orders->ma_hd }}" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('page-js')
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
     

    

        
        $('.btn-delete').click(function() {
            var mId = $(this).data("id");
            var mTitle = $(this).data("title");
            Swal.fire({
                title: `Bạn có chắc xóa "${mTitle}" ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true,
                confirmButtonColor: "#02c58d",
                cancelButtonColor: "#fc3b3b",
                preConfirm: () => {
                    return new Promise(function (resolve) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url : "{!! route('Hoa-don.cane.orders') !!}",
                            type: "GET",
                            data: { id : mId }
                        }).done(function (response) {
                            Swal.fire(
                                `${response.title}`,
                                `${response.msg}`,
                                `${response.status}`,
                            ).then(() => {
                                location.reload();
                            });
                        })
                    })
                }
            });
        });
    });
</script>
@endsection
