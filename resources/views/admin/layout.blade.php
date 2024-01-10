<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Quản lý</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/bootstrap-toggle/css/bootstrap-toggle.min.css') }}" rel="stylesheet" type="text/css">
        <style>
            .pointer {
                cursor: pointer;
            }
            tr th {
                color: black;
            }
        </style>
        @yield('page-css')
    </head>

    <body>

        <div id="wrapper">

            @include('admin.includes.topbar')

            @include('admin.includes.left-sidebar')

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        @include('admin.includes.page-title')

                        @yield('main-content')

                    </div>

                </div>

                <footer class="footer">
                    © 2023 Quản lý bán balo, túi xách <span class="d-none d-sm-inline-block">
                </footer>

            </div>

        </div>

        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/waves.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.en-CA.js') }}" charset="UTF-8"></script>
        <script src="{{ asset('plugins/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        @yield('page-js')

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script>
            $('.datepicker').datepicker({
                language: 'en-CA'
            });
        </script>
        @yield('page-custom-js')
    </body>

</html>
