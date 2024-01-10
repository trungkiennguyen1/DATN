@extends('admin.layout')
@section('main-content')
<form action="{{ route('detail.do-change', ['id' => Auth::id()]) }}" method="POST">
    @csrf
    <div class="card m-b-30">
        <div class="card-body">
            <div class="row">
                <div class="col-4 form-group">
                    <label>Mật khẩu cũ <span style="color: red">*</span></label>
                    <span toggle="#old_pass" class="fa fa-eye old_pass eyes"></span>
                    <input type="password" name="old_pass" id="old_pass" class="form-control" required minlength="6" maxlength="20" placeholder="Nhập mật khẩu cũ"/>
                </div>
                <div class="col-4 form-group">
                    <label>Mật khẩu mới <span style="color: red">*</span></label>
                    <span toggle="#password" class="fa fa-eye new_pass eyes"></span>
                    <input type="password" name="password" id="password" class="form-control" required minlength="6" maxlength="20"
                    required minlength="6" maxlength="20" placeholder="Nhập mật khẩu mới"/>
                </div>
                <div class="col-4 form-group">
                    <label>Xác nhận mật khẩu mới <span style="color: red">*</span></label>
                    <span toggle="#password_confirmation" class="fa fa-eye confirm_pass eyes"></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="6" maxlength="20" placeholder="Nhập xác nhận mật khẩu mới"/>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-2" style="margin-left: auto">
                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-block btn-save">
                        Lưu
                    </button>
                </div>
                <div class="col-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary waves-effect waves-light btn-block">Hủy</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page-css')
<style>
    .eyes {
        position: absolute;
        bottom: 10px;
        right: 25px;
        display: flex;
        margin-top: 0;
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

        $(".old_pass").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
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

        $('#password_confirmation').keyup(function() {
            if ($('#password').val() == $('#password_confirmation').val()) {
                $('#password_confirmation').css('border-color', '#69d069');
                $('#password_confirmation')[0].setCustomValidity('');
            } else {
                $('#password_confirmation')[0].setCustomValidity("Password Don't Match");
                $('#password_confirmation').css('border-color', '#f58787');
            }
        });
    });
</script>
@endsection
