@extends('layouts.app')
@section('title','Đăng kí tài khoản')
@section('content')

<style>
    .register{
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
    .register .signup-form .form-button input{
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="returning_customer">
        <div class="register">
            <div class="signup-form">
                <h4 class="form-title">Đăng ký tài khoản</h4>
                <form action="{{asset('account/register-customer')}}" method="POST" class="register-form" id="register-form">                
                @include('errors.note')  
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" required name="name" id="name" placeholder="Họ và Tên" value="{{old('name')}}" />
                    </div>
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" required name="number_phone" id="number_phone" placeholder="Số điện thoại..." value="{{old('number-phone')}}" />
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" required name="email" id="email" placeholder="Email của bạn" value="{{old('email')}}"/>
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" required name="pass" id="password" placeholder="Mật khẩu" />
                        <div class="check">
                        <input id="check" type="checkbox">
						<p id="checkdisplay">Hiện mật khẩu</p>
                        </div>
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