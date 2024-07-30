@extends('admin.login_layout')
@section('title', 'Đăng ký')
@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('img/images/bg-01.jpg');">
        <div class="wrap-login100 p-t-30 p-b-50">
            <span class="login100-form-title p-b-41">
                Đăng ký tài khoản
            </span>
            <form method="POST" action="{{asset('register-auth')}}" class="login100-form validate-form p-b-33 p-t-5">
                {{csrf_field()}}
                @include('errors.note')
                <div class="wrap-input100 validate-input" data-validate="username">
                    <input class="input100" type="text" required name="name" placeholder="Họ và tên..." value="{{old('name')}}">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Email username">
                    <input class="input100" type="text" required name="email" placeholder="E-mail hoặc tên người dùng" value="{{old('email')}}">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="password">
                    <input id="pass" class="input100" type="password" required name="password" placeholder="Mật khẩu">
                    <input id="check" type="checkbox">
                    <p id="checkdisplay">Hiện mật khẩu</p>
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn">
                        Đăng ký
                    </button>
                </div>
                <a class="btn-back-to-login" href="{{asset('login-auth')}}"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Trở về</a>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<script>
    check.onclick = togglePassword;

    function togglePassword() {
        var text = document.getElementById('checkdisplay');

        if (check.checked) {
            pass.type = 'text';
            text.innerHTML = "Ẩn mật khẩu";
        } else {
            pass.type = 'password';
            text.innerHTML = "Hiện mật khẩu";
        }
    }
</script>
@endsection