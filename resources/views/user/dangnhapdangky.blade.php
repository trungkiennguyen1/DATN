 
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

<title>Đăng Nhập Và Đăng Ký</title>
<!-- Meta-Tags -->

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->

<link href="{{asset('assetsUser/css/popuo-box.css')}}" rel="stylesheet" type="text/css" media="all">

<!-- Style --><link href="{{asset('assetsUser/css/styleLog.css')}}" rel="stylesheet" type="text/css" media="all">

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>

	<h1>ĐĂNG NHẬP TÀI KHOẢN</h1>
 	@if(count($errors)>0)
 		<div class= "alert alert-danger">
			 <ul>
				 @foreach ($errors->all() as $error)
				 <li> {{$error}} </li>
				 @endforeach
			</ul>
		</div>
	@endif
	<div class="w3layoutscontaineragileits">
	<h2></h2>
		<form action="{{ route('dangnhap') }}" method="POST">

			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="results">
				<br>
			</div>
				<span class="text-danger"></span>
				<input type="email" name="email" placeholder="EMAIL" value="{{ old ('email')}}" required=""> <br>
				<span class="text-danger"></span>
				<input type="password" name="password" placeholder="MẬT KHẨU" required="">
				<!-- <ul class="agileinfotickwthree">
					<li>
						<input type="checkbox" name="remember_me" value="remember_me">
						<label for="remember_me"><span></span>Nhớ Mật Khẩu</label>
						<a href="#">Quên Mật Khẩu?</a>
					</li>
				</ul> -->
				
				<div class="aitssendbuttonw3ls">
					<input type="submit" value="ĐĂNG NHẬP" style="font-size: 20px">
					<p>Hoặc đăng nhập bằng</p>
					<ul>
						<li>
							<br>
							<a href="login-google"><img width="10%" alt = "Đăng nhập bằng tài khoản Google" src="{{asset('assetsUser/images/gg.png')}}"></a>
							<a href="login-facebook"><img width="10%" alt = "Đăng nhập bằng tài khoản Facebook" src="{{asset('assetsUser/images/fb.png')}}"></a>
						</li>
					</ul>
					<p> Đăng Ký Tài Khoản Mới <span>→</span> <a class="w3_play_icon1" href="#small-dialog1"> Click Vào Đây</a></p>
					<div class="clear"></div>
				</div>
		</form>
	</div>
	
	<!-- for register popup -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
				<h3>ĐĂNG KÝ</h3>
				<form id="form">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="form-sub-w3ls">
							<span class="text-danger"></span>
							<input placeholder="Họ Tên"  type="text"  name="tendk" id="ten" required="">
							<div class="icon-agile">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<span class="text-danger"></span>
							<input placeholder="Email" class="mail" type="email"  name="emaildk" id="email" required="">
							<div class="icon-agile">
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<span class="text-danger"></span>
							<input placeholder="Số điện thoại" class="number" type="text"  name="sdtdk" id="sdt" maxlength="10" >
							<div class="icon-agile">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<span class="text-danger"></span>
							<input placeholder="Mật Khẩu"  type="password" name="passworddk" id="password" maxlength="20" required="">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<span class="text-danger"></span>
							<input placeholder="Nhập Lại Mật Khẩu"  type="password" name="repassworddk" id="repassword" required="">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>
					<!-- <div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked="">
							Tôi chấp nhận các Điều khoản & Điều kiện</label>
					</div> -->
					<div >
						<button style="background: #fff; color: #537b35;" onclick="dangKy()"><span style="font-size: 30px">Đăng Ký</span></button>
					</div>
				</form>
			</div>
		</div>	
	</div>
	<!-- //for register popup -->
	
	
	<script type="text/javascript" src="{{asset('assetsUser/js/jquery-2.1.4.min.js')}}"></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- pop-up-box-js-file -->  
		<script src="{{asset('assetsUser/js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
	<!--//pop-up-box-js-file -->
 	
	<!-- <script>
		$( "#form-dang-ky" ).submit(function( event ) {
  			alert( "Handler for .submit() called." );
			  	$.ajax({
				type: "POST",
				url: {{ route('dangky') }},
				data: $( this ).serializeArray(),
				success: function(response) {
					console.log("response: ", response);
				}
				});
  		event.preventDefault();
		});
	</script> -->

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		$(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
																		
		});

	</script>
	
		
	<script>
		function dangKy(){

			var ten = $('#ten').val();
			var email = $('#email').val();
			var sdt = $('#sdt').val();
			var password = $('#password').val();
			var repassword = $('#repassword').val();
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if (ten.length < 1) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Chưa nhập nhập Họ tên!',
				})
				return false;
			} else if (email.length < 1) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Chưa nhập nhập Email !',
				})
				return false;
			} else if (!filter.test(email)) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Email nhập không hợp lệ !',
				})
				return false;
			} else if (sdt.length < 1) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Chưa nhập nhập Số điện thoại !',
				})
				return false;
			} else if (sdt.length !== 10) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Số điện thoại không đúng định dạng !',
				})
				return false;
			} else if (password.length < 1) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Chưa nhập nhập Mật khẩu !',
				})
				return false;
			} else if (password.length < 6) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Mật khẩu ít nhất 6 kí tự !',
				})
				return false;
			} else if (repassword.length < 1) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Chưa nhập nhập Nhập lại mật khẩu !',
				})
				return false;
			} else if (password !== repassword) {
				Swal.fire({
				icon: 'error',
				title: 'Lỗi!!!',
				text: 'Mật khẩu không trùng khớp!',
				})
				return false;
			}

				$.ajax({
				url: "/dangky",
				method: "POST", 
				data: {
					tendk: ten,
					emaildk: email,
					sdtdk: sdt,
					passworddk: password,
					_token: $("input[name='_token']").val(),
				}
						
				});
			
		}
	</script>
@include('sweetalert::alert')
</body>
<!-- //Body -->
</html>