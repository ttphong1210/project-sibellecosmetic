@extends('layouts.app')
@section('title','Đăng kí tài khoản')
@section('content')

<style>
.register {
    width: 400px;
    margin: 0 auto;
}

.returning_customer {
    text-align: center;
    margin: 3rem;
}

.register .signup-form .form-group input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #eee;
    padding: 10px 0;
    outline: none;
    padding-left: 5px;
}

.register .signup-form .form-button input {
    cursor: pointer;
}

/* Định dạng chung cho form-group */
.form-group {
    position: relative;
    margin-bottom: 25px;
}

.form-group label {
    display: inline-block;
    margin-bottom: 10px;
    color: #333;
    font-size: 16px;
}

.form-group input[type="password"] {
    width: 100%;
    padding: 10px 20px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #66afe9;
    border-bottom-color: #66afe9 !important;
    outline: none;
    box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
}

/* Định dạng cho checkbox và label */
.checkbox-wrapper {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.checkbox-wrapper input[type="checkbox"] {
    width: 10% !important;
    cursor: pointer;
}

.checkbox-wrapper label {
    color: #555;
    font-size: 14px;
    cursor: pointer;
}
#checkdisplay{
    margin: 8px 30px !important;
}
/* Định dạng cho span focus-input100 */
.focus-input100 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #66afe9;
    visibility: hidden;
    transition: all 0.4s;
}

.form-group input[type="password"]:focus+.focus-input100 {
    visibility: visible;
    height: 100%;
}

.zmdi {
    font-size: 18px;
    margin-right: 10px;
}
</style>

<div class="container">
    <div class="returning_customer">
        <div class="register">
            <div class="signup-form">
                <h4 class="form-title">Đăng ký tài khoản</h4>
                <form action="{{asset('account/register-customer')}}" method="POST" class="register-form"
                    id="register-form">
                    @include('errors.note')
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" required name="name" id="name" placeholder="Họ và Tên"
                            value="{{old('name')}}" />
                    </div>
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" required name="number_phone" id="number_phone" placeholder="Số điện thoại..."
                            value="{{old('number-phone')}}" pattern="^0[0-9]{9,10}$" title="Số điện thoại phải có độ dài từ 10 đến 11 số và chỉ chứa số"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" required name="email" id="email" placeholder="Email của bạn"
                            value="{{old('email')}}" title="Vui lòng nhập đúng định dạng email"/>
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" required name="pass" id="pass" placeholder="Mật khẩu" />
                        <div class="checkbox-wrapper">
                            <input id="check" type="checkbox">
                            <p id="checkdisplay">Hiện mật khẩu</p>
                        </div>
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Đăng ký" />
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection