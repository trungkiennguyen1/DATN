@extends('admin.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <form id="search" action="{{ route('nhan-vien.list') }}" method="GET">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 form-group">
                                    <label>Tên</label>
                                    <input type="text" id="ten" name="ten" class="form-control" @if (!empty($inputSearch['ten'])) value="{{ $inputSearch['ten'] }}" @endif maxlength="50">
                                </div>
                                <div class="col-3 form-group">
                                    <label>Email</label>
                                    <input type="text" id="email" name="email" class="form-control" @if (!empty($inputSearch['email'])) value="{{ $inputSearch['email'] }}" @endif maxlength="30">
                                </div>
                                <div class="col-2 form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" id="sdt" name="sdt" class="form-control" @if (!empty($inputSearch['sdt'])) value="{{ $inputSearch['sdt'] }}" @endif maxlength="10">
                                </div>
                                <div class="col-2 form-group">
                                    <label>Tình trạng</label>
                                    <select class="form-control" id="bi_khoa" name="bi_khoa">
                                        <option selected disabled>Chọn tình trạng</option>
                                        <option @if ($inputSearch['bi_khoa'] == '0') selected @endif value="0">Không khóa</option>
                                        <option @if ($inputSearch['bi_khoa'] == 1) selected @endif value="1">Bị khóa</option>
                                    </select>
                                </div>
                                <div class="col-2 form-group">
                                    <label>Chức vụ</label>
                                    <select class="form-control" id="vai_tro_id" name="vai_tro_id">
                                        <option selected disabled>Chọn chức vụ</option>
                                        @if (isset($vai_tro))
                                            @foreach($vai_tro as $vt)
                                                <option @if (!empty($inputSearch['vai_tro_id']) && $vt->id == $inputSearch['vai_tro_id']) selected @endif value="{{ $vt->id }}"> {{ $vt->ten }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('nhan-vien.list') }}" class="mr-1 btn btn-secondary waves-effect waves-light"><i class="fas fa-redo-alt"></i> Làm mới</a>
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
                        <a href="{{ route('nhan-vien.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus-square"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-default">
                            <tr>
                                <th scope="col">@sortablelink('ten_tai_khoan', 'Tên Tài Khoản', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('ten', 'Tên', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('email', 'Email', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('sdt', 'Số điện thoại', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('vai_tro.ten', 'Vai trò', '', ['style' => 'color: black'])</th>
                                <th scope="col">@sortablelink('bi_khoa', 'Tình trạng', '', ['style' => 'color: black'])</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($admins) > 0)
                                @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->ten_tai_khoan }}</td>
                                    <td>{{ $admin->ten }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->sdt }}</td>
                                    <td>{{ $admin->vai_tro->ten }}</td>
                                    <td>
                                        @if ($admin->bi_khoa == 1)
                                            <span class="badge badge-danger font-12">Bị khóa</span>
                                        @else
                                            <span class="badge badge-success font-12">Không khóa</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript:void(0);" data-lock="{{$admin->bi_khoa}}" data-id="{{ $admin->id }}" data-title="{{ $admin->ten_tai_khoan }}" data-toggle="tooltip" data-placement="top"
                                            @if ($admin->bi_khoa == 1)
                                                class="btn btn-success btn-sm waves-effect waves-light btn-lock" title="Mở khóa"><i class="fas fa-lock-open"></i>
                                            @else
                                                class="btn btn-danger btn-sm waves-effect waves-light btn-lock" title="Khóa"><i class="fas fa-lock"></i>
                                            @endif </a>
                                            <a href="{{ route('nhan-vien.edit', ['id' => $admin->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-info btn-sm waves-effect waves-light btn-change" data-toggle="tooltip" data-placement="top" title="Đổi mật khẩu" data-id="{{ $admin->id }}"><i class="fas fa-key"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $admin->id }}" data-title="{{ $admin->ten_tai_khoan }}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                @if ($isSearch)
                                    @include('admin.partials.no-data-search')
                                @else
                                    @include('admin.partials.no-data')
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (isset($admins))
                <div class="d-flex justify-content-between mt-3">
                    <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                        Hiển thị @if ($admins->firstItem())
                            {{ $admins->firstItem() }}
                        @else
                            0
                        @endif tới @if ($admins->lastItem())
                            {{ $admins->lastItem() }}
                        @else
                            0
                        @endif trong {{ $admins->total() }} mục
                    </div>
                    <div>
                        {{ $admins->onEachSide(1)->withQueryString()->links() }}
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
                                <form action="{{ route('nhan-vien.change-pass') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <input type="hidden" name="id" id="admin-id">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="new_pass" class="control-label">Mật khẩu mới <span style="color: red">*</span></label>
                                                        <input type="password" class="form-control" id="new_pass" name="new_pass" minlength="6" maxlength="20" required placeholder="Nhập mật khẩu mới">
                                                        <span toggle="#new_pass" class="fa fa-eye new_pass eyes"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="confirm_pass" class="control-label">Xác nhận mật khẩu <span style="color: red">*</span></label>
                                                        <input type="password" class="form-control" id="confirm_pass" required minlength="6" maxlength="20" placeholder="Nhập xác nhận mật khẩu">
                                                        <span toggle="#confirm_pass" class="fa fa-eye confirm_pass eyes"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12" style="margin-left: auto;">
                                                    <div class="row">
                                                        <div class="col-6 pr-0">
                                                            <a href="javascript:void(0);" class="btn btn-secondary waves-effect waves-light btn-block" data-dismiss="modal">Hủy</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="submit" class="btn btn-success waves-effect waves-light btn-block">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

        $('#ten').focus();

        $('.btn-change').click(function() {
            var mId = $(this).data('id');
            $("#change-pass").modal('show');
            $('#admin-id').val(mId);
        });

        $(".new_pass").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".confirm_pass").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $('#confirm_pass').keyup(function() {
            if ($('#new_pass').val() == $('#confirm_pass').val()) {
                $('#confirm_pass').css('border-color', '#69d069');
                $('#confirm_pass')[0].setCustomValidity('');
            } else {
                $('#confirm_pass')[0].setCustomValidity("Password Don't Match");
                $('#confirm_pass').css('border-color', '#f58787');
            }
        });

        $('.btn-lock').click(function() {
            var mId = $(this).data("id");
            var mTitle = $(this).data("title");
            var _isLock = $(this).data("lock");
            var str = (_isLock == 1) ? "mở khóa" : "khóa";

            Swal.fire({
                title: `Bạn có chắc ${str} tài khoản "${mTitle}" ?`,
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
                            url : "{!! route('nhan-vien.lock') !!}",
                            type: "POST",
                            data: { id : mId }
                        }).done(function (res) {
                            Swal.fire(
                                `${res.title}`,
                                `${res.msg}`,
                                `${res.status}`,
                            ).then(() => {
                                location.reload();
                            });
                        })
                    })
                }
            });
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
                            url : "{!! route('nhan-vien.delete') !!}",
                            type: "DELETE",
                            data: { id : mId }
                        }).done(function (res) {
                            Swal.fire(
                                `${res.title}`,
                                `${res.msg}`,
                                `${res.status}`,
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
