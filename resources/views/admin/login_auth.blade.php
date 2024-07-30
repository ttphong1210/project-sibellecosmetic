@extends('admin.login_layout')
@section('title', 'Đăng nhập')
@section('content')
    <div class="limiter">
        <div class="container-login100" style="background-image: url('img/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Đăng nhập tài khoản Authentication
                </span>
                <form method="POST" action="{{asset('login-auth')}}" class="login100-form validate-form p-b-33 p-t-5">
                    @include('errors.note')
                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="text" required name="email"
                            placeholder="E-mail hoặc tên người dùng" value="{{old('email')}}">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input id="pass" class="input100" type="password" required name="password"
                            placeholder="Mật khẩu">
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
                            <a href="{{asset('forgot-password-auth')}}" class="forgot-auth-form">Quên mật khẩu</a>
                            <!-- <a href="{{asset('login-auth')}}" class="login-auth-form">
                                Đăng nhập tài khoản Authen
                            </a> -->
                        </div>
                    </div>

                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
@endsection

    