<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Đăng nhập</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

        <style>
            .eyes {
                float: right;
                margin-top: -24px;
                padding-right: 8px;
                opacity: 0.6;
            }
        </style>
    </head>

    <body>

        <!-- Begin page -->
        <div class="accountbg">
            <div class="text-left font-20 text-white pl-5 pt-4">
                <p>Website quản lý bán balo, túi xách</p>
            </div>
        </div>
        <div class="wrapper-page">
            <div class="card card-pages shadow-none">
                <div class="card-body">
                    <h5 class="font-18 text-center">Trang đăng nhập quản trị viên</h5>
                    <div>

                    </div>
                    <form class="form-horizontal m-t-30" action="{{ route('do-login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="col-12">
                                <label>Tên tài khoản</label>
                                <input class="form-control" type="text" name="username" id="username" required placeholder="Tên tài khoản">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label>Mật khẩu</label>
                                <input class="form-control" type="password" name="password" id="password" required placeholder="Mật khẩu">
                                <span toggle="#password" class="fa fa-eye password eyes"></span>
                            </div>
                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/waves.min.js') }}"></script>
        <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
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

                $('#username').focus();

                $(".password").click(function() {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            });
        </script>

    </body>

</html>
