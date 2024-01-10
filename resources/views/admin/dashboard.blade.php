@extends('admin.layout')
@section('main-content')
<p>Xin chào {{ Auth::user()->ten }}</p>

<section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Đơn hàng hôm nay</span>
                        <span class="info-box-number">{{\App\Models\HoaDon::countOrderTime()}}<small><a href="{{ route('search.order.today') }}">(Chi tiết)</a></small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
              <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Đơn hàng tuần này</span>
                  <span class="info-box-number">{{\App\Models\HoaDon::countOrderWeek()}}<small><a href="{{ route('search.order.onweek') }}">(Chi tiết)</a></small></span>
              </div>
              <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
      </div>
  
</section>

@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{  asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{  asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{  asset('admin/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{  asset('admin/dist/css/skins/_all-skins.min.css') }}">
        <!-- Pace style -->
        <link rel="stylesheet" href="{{  asset('admin/plugins/pace/pace.min.css') }}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <link rel="icon" sizes="32x32" type="image/png" href="{{ asset('ico.png') }}" />
        <link rel="stylesheet" href="{{  asset('admin/bower_components/select2/dist/css/select2.min.css') }}">
        <!-- Google Font -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
    });
</script>
@endsection
