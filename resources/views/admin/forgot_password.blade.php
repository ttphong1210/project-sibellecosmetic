@extends('admin.login_layout')
@section('title', 'Khôi phục mật khẩu')
@section('content')
<style>
    .form-group {
        margin: 10px 15px;
        font-size: 14px;
        font-family: "Roboto", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-weight: normal;
        color: #797979;
        line-height: 20px;
    }
</style>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('img/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Khôi phục mật khẩu
                </span>
                <form method="POST" action="{{asset('forgot-password-auth')}}" class="login100-form validate-form p-b-33 p-t-5">
                    {{csrf_field()}}
                    @include('errors.note')
                    <div class="col-md-12 form-group">
                        <span>Vui lòng nhập email của bạn để yêu cầu mật khẩu mới, hệ thống sẽ gửi link xác thực mật khẩu vào email điền bên dưới.</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Email username">
                        <input class="input100" type="text" required name="email" placeholder="Nhập Email của bạn " value="{{old('email')}}">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn">
                            Gửi
                        </button>
                    </div>
                    <a class="btn-back-to-login" href="{{asset('login-auth')}}"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Trở về</a>
                </form>
            </div>
        </div>
    </div>
    <div id="dropDownSelect1"></div>
@endsection