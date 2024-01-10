@extends('admin.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('san-pham.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus-square"></i> Thêm mới</a>
                        <a href="{{ route('san-pham.statistic') }}" class="btn btn-info waves-effect waves-light mb-4"><i class="fas fa-file"></i> Thống kê</a>
                    </div>
                    <div class="col-4 form-search">
                        <form action="{{ route('san-pham.list') }}" method="GET" id="formSearch" class="app-search mt-0">
                            <div class="form-group mb-0">
                                <input type="text" name="keyword" id="keyword" class="input-search form-control mr-0" placeholder="Tìm kiếm..." style="position: absolute; right: 0;" @if (isset($keyword)) value="{{ $keyword }}" @endif>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-default">
                            <tr>
                                <th scope="col">@sortablelink('ma_sp', 'Mã sản phẩm', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('ten_sp', 'Tên sản phẩm', '', ['style' => 'color: black'])</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->ma_sp }}</td>
                                    <td>{{ $product->chi_tiet_sp->ten_sp }}</td>
                                    <td>
                                        <img src="{{ $product->anh_sp }}">
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('san-pham.edit', ['id' => $product->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-info btn-sm waves-effect waves-light btn-detail" data-id="{{ $product->id }}" data-toggle="tooltip" data-placement="top" title="Chi tiết"><i class="fas fa-eye"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $product->id }}" data-title="{{ $product->ma_sp }}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                @if (!empty($keyword))
                                    @include('admin.partials.no-data-search')
                                @else
                                    @include('admin.partials.no-data')
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (isset($products))
                <div class="d-flex justify-content-between mt-3">
                    <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                        Hiển thị @if ($products->firstItem())
                            {{ $products->firstItem() }}
                        @else
                            0
                        @endif tới @if ($products->lastItem())
                            {{ $products->lastItem() }}
                        @else
                            0
                        @endif trong {{ $products->total() }} mục
                    </div>
                    <div>
                        {{ $products->onEachSide(1)->withQueryString()->links() }}
                    </div>
                </div>
                @endif
                <div id="detail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title mt-0">Chi tiết sản phẩm</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="popupBody">
                                
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
    .form-search .close {
        display: none;
        position: absolute;
        top: 0;
        right: 0;
        font-size: 18px;
        padding: 0.45rem 0.8rem;
        color: inherit;
    }
</style>
@endsection

@section('page-js')
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        const Toast = Swal.mixin({
            toast: true,
            width: "20rem",
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if (session('status'))
            @if (session('status') == 'success')
                Toast.fire({
                    icon: 'success',
                    title: "{!! session('message') !!}"
                });
            @else
                Toast.fire({
                    icon: 'error',
                    title: "{!! session('message') !!}"
                });
            @endif
        @endif

        $('.btn-detail').click(function() {
            var mId = $(this).data('id');
            $.ajax({
                url: `san-pham/chi-tiet-san-pham/${mId}`,
                type: 'get'
            }).done(function(res) {
                console.log(res);
                $('#popupBody').html(modalBody(res));
                $("#detail").modal('show');
            });
        });

        var modalBody = function(data) {
            var img = [];
            for (i = 0; i < data.data.anh_chi_tiet_sp.length; i++) {
                img.push(`<img src="${data.data.anh_chi_tiet_sp[i]}" >`);
            }

            return `<dl class="row mb-0">
                <dt class="col-sm-4 font-15">Chất liệu</dt>
                <dd class="col-sm-8">${data.data.chat_lieu}</dd>

                <dt class="col-sm-4 font-15">Giá</dt>
                <dd class="col-sm-8">${data.data.gia.toLocaleString('vi')} VND</dd>

                <dt class="col-sm-4 font-15">Giảm giá</dt>
                <dd class="col-sm-8">${data.data.giam_gia * 100}%</dd>

                <dt class="col-sm-4 font-15">Khối lượng</dt>
                <dd class="col-sm-8">${data.data.khoi_luong} kg</dd>

                <dt class="col-sm-4 font-15">Kích thước</dt>
                <dd class="col-sm-8">${data.data.kich_thuoc} cm</dd>

                <dt class="col-sm-4 font-15">Loại sản phẩm</dt>
                <dd class="col-sm-8">${data.data.loai_sp.ten}</dd>

                <dt class="col-sm-4 font-15">Màu sắc</dt>
                <dd class="col-sm-8">${data.data.mau_sac}</dd>

                <dt class="col-sm-4 font-15">Ngăn laptop</dt>
                <dd class="col-sm-8">${data.data.ngan_lap} inch</dd>

                <dt class="col-sm-4 font-15">Nhà sản xuất</dt>
                <dd class="col-sm-8">${data.data.nha_san_xuat.ten}</dd>

                <dt class="col-sm-4 font-15">Số lượng</dt>
                <dd class="col-sm-8">${data.data.so_luong}</dd>

                <dt class="col-sm-4 font-15">Số ngăn</dt>
                <dd class="col-sm-8">${data.data.so_ngan}</dd>

                <dt class="col-sm-4 font-15">Tải trọng</dt>
                <dd class="col-sm-8">${data.data.tai_trong}</dd>

                <dt class="col-sm-4 font-15">Tình trạng</dt>
                <dd class="col-sm-8">${(data.data.tinh_trang == 0) ? 'Còn hàng' : 'Hết hàng'}</dd>

                <dt class="col-sm-4 font-15 text-truncate">Mô tả</dt>
                <dd class="col-sm-8">${data.data.mo_ta}</dd>

                <dt class="col-sm-4 font-15">Hình ảnh</dt>
                <dd class="col-sm-8">
                    ${img}
                </dd>
            </dl>`;
        }

        var inputSearch = $('.input-search');
        var btnClose = $('.close');

        if (inputSearch.val()) {
            btnClose.show();
            inputSearch.blur();
        } else {
            inputSearch.focus();
        }

        inputSearch.keydown(function() {
            btnClose.show();
        });

        btnClose.click(function() {
            inputSearch.val('');
            $(this).hide();
            document.forms['formSearch'].submit();
        });

        var timeout;
        var delay = 1000;

        inputSearch.keyup(function() {
            if (timeout) {
                clearTimeout(timeout);
            }

            timeout = setTimeout(function() {
                document.forms['formSearch'].submit();
            }, delay);
        });

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
                            url : "{!! route('san-pham.delete') !!}",
                            type: "DELETE",
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
