@extends('admin.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <form id="search" action="{{ route('Hoa-don.list') }}" method="GET">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 form-group">
                                    <label>Mã hóa đơn</label>
                                    <input type="text" id="ma_hd" name="ma_hd" class="form-control" @if (!empty($inputSearch['ma_hd'])) value="{{ $inputSearch['ma_hd'] }}" @endif maxlength="50">
                                </div>
                                <div class="col-3 form-group">
                                    <label>tổng tiền</label>
                                    <input type="text" id="tong_tien" name="tong_tien" class="form-control" @if (!empty($inputSearch['tong_tien'])) value="{{ $inputSearch['tong_tien'] }}" @endif maxlength="30">
                                </div>
                               
                               
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end">
                                       
                                        <a href="{{ route('Hoa-don.list') }}" class="mr-1 btn btn-secondary waves-effect waves-light"><i class="fas fa-redo-alt"></i> Làm mới</a>
                                        <button type="submit" class="btn btn-info waves-effect waves-light">
                                            <i class="fas fa-search"></i> Tìm kiếm
                                        </button>
                                        
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        
                        <a href="{{ route('Hoa-don.statistic') }}" class="btn btn-info waves-effect waves-light mb-4"><i class="fas fa-file"></i> Thống kê</a>
                    </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-default">

                            <tr>
                                <!-- <th scope="col">@sortablelink('ten_tai_khoan', 'Tên Tài Khoản', '', ['style' => 'color: black'])</th> -->
                                <th scope="col">@sortablelink('ma_hd', 'Mã hóa đơn', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('tong_tien', 'Tổng tiền', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('ngay_dat', 'Ngày đặt', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('dia_chi_nhan', 'Địa chỉ nhận', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('tinh_trang', 'Tình trạng', '', ['style' => 'color: black'])</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                                @foreach ($hoadon as $hoadons)
                                <tr>
                                    <!-- <td>{{$hoadons->ma_hd }}</td> -->
                                    <td>{{ $hoadons->ma_hd }}</td>
                                    <td>{{ $hoadons->tong_tien }}</td>
                                    <td>{{ $hoadons->ngay_dat }}</td>
                                    <td>{{ $hoadons->dia_chi_nhan }}</td>
                                    <td>{{ $hoadons->tinh_trang }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('Hoa-don.edit', ['id' => $hoadons->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            
                                            <a href="{{route('Hoa-don.inhoadon', ['id' => $hoadons->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="In hóa đơn"><i class="fas fa-print"></i></a>
                                            {{-- <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $hoadons->id }}" data-title="{{ $hoadons->ma_hd }}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a> --}}

                                            <a href="{{ route('Hoa-don.show.order',$hoadons->id) }}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Xem" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                            @if($hoadons->tinh_trang=='Đã duyệt')
                                          
                                            @elseif($hoadons->tinh_trang=='Đã hủy')

                                            @else
                                            <a href="javascript:void(0);" data-id="{{ $hoadons->id }}" data-title="{{ $hoadons->ma_hd }}" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                      
                                @if ($isSearch)
                                    @include('admin.partials.no-data-search')
                                @else
                                    @include('admin.partials.no-data')
                                @endif
                           
                        </tbody>
                    </table>
                </div>
                @if (isset($hoadon))
                <div class="d-flex justify-content-between mt-3">
                    <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                        Hiển thị @if ($hoadon->firstItem())
                            {{ $hoadon->firstItem() }}
                        @else
                            0
                        @endif tới @if ($hoadon->lastItem())
                            {{ $hoadon->lastItem() }}
                        @else
                            0
                        @endif trong {{ $hoadon->total() }} mục
                    </div>
                    <div>
                        {{ $hoadon->onEachSide(1)->withQueryString()->links() }}
                    </div>
                </div>
                @endif
                <div id="change-pass" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered dialogExport">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title mt-0">Đổi mật khẩu</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-css')
<style>
    .eyes {
        float: right;
        margin-top: -24px;
        padding-right: 8px;
        opacity: 0.8;
    }
</style>
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
