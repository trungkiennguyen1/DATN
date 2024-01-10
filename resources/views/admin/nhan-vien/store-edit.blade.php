@extends('admin.layout')
@section('main-content')
<form
    @if (isset($admin))
        action="{{ route('nhan-vien.update', ['id' => $admin->id]) }}"
    @else
        action="{{ route('nhan-vien.store') }}"
    @endif method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 form-group">
                            <label>Tên Tài Khoản @if (!isset($admin)) <span style="color: red">*</span> @endif </label>
                            <input type="text" name="ten_tai_khoan" id="ten_tai_khoan" class="form-control" required maxlength="30" placeholder="Nhập tên" @isset($admin) value="{{ $admin->ten_tai_khoan }}" readonly @endisset/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Tên</label>
                            <input type="text" name="ten" id="ten" class="form-control" required maxlength="50" placeholder="Nhập tên" @isset($admin) value="{{ $admin->ten }}" @endisset/>
                        </div>

                        <div class="col-2 form-group">
                            <label>Số Điện Thoại</label>
                            <input type="text" name="sdt" id="sdt" class="form-control" maxlength="10" placeholder="Nhập số điện thoại" @isset($admin) value="{{ $admin->sdt }}" @endisset/>
                        </div>

                        <div class="col-3 form-group">
                            <label>Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Nhập email" @isset($admin) value="{{ $admin->email }}" @endisset>
                        </div>

                        <div class="col-2 form-group">
                            <label>Vai trò</label>
                            <select class="form-control" id="vai_tro_id" name="vai_tro_id" required>
                                <option selected disabled>Chọn vai trò</option>
                                @if (isset($vai_tro))
                                    @foreach ($vai_tro as $vt)
                                        <option @if (isset($admin) && $vt->id == $admin->vai_tro_id || $vt->ten == 'Nhân viên') selected @endif value="{{ $vt->id }}"> {{ $vt->ten }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2" style="margin-left: auto">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Lưu</button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('nhan-vien.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Hủy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page-css')
<style>

</style>
@endsection

@section('page-js')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();

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

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: "{!! $error  !!}"
                });
            @endforeach
        @endif
    });
</script>
@endsection
