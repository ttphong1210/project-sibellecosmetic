<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login SE.BELLE Cosmetic</title>
	<meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Đăng nhập tài khoản Authentication
				</span>
				<form method="POST" action="{{asset('login-auth')}}" class="login100-form validate-form p-b-33 p-t-5">
					@include('errors.note')
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" required name="email" placeholder="E-mail hoặc tên người dùng" value="{{old('email')}}">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input id="pass" class="input100" type="password" required name="password" placeholder="Mật khẩu">
						<input id="check" type="checkbox">
						<p id="checkdisplay">Hiện mật khẩu</p>
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Đăng nhập
						</button>
					</div>
					<div class="form">
                        <div class="container-register form-custom">
                            <a href="{{asset('register-auth')}}" class="register-form">
                                Đăng ký tài khoản
                            </a>
                        </div>
                        <div class="container-login-auth form-custom">
                            <a href="{{asset('login-auth')}}" class="login-auth-form">
                                Đăng nhập tài khoản Authen
                            </a>
                        </div>
                    </div>
					
                    {{csrf_field()}}
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script>
		check.onclick = togglePassword;
		
		function togglePassword(){
			var text = document.getElementById('checkdisplay');

		if(check.checked){ 
			pass.type = 'text';
			text.innerHTML = "Ẩn mật khẩu";
		}
			else {
				pass.type = 'password';
				text.innerHTML = "Hiện mật khẩu";
			}
		}
	</script>

</body>
</html>