@extends('layouts.app')
@section('title','Đăng kí tài khoản')
@section('content')

<style>
    .returning_customer{
        text-align: center;
        margin: 3rem;
    }
    .register .signup-form .form-group input{
    width: 60%;
    border: none;
    border-bottom: 1px solid #eee;
    padding: 10px 0;
}
</style>

<div class="container">
    <div class="returning_customer">
        <div class="register">
            <div class="signup-form">
                <h4 class="form-title">Đăng ký tài khoản</h4>
                <form action="{{asset('account/register')}}" method="POST" class="register-form" id="register-form">
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" required name="name" id="name" placeholder="Họ và Tên" />
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" required name="email" id="email" placeholder="Email của bạn" />
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" required name="pass" id="pass" placeholder="Mật khẩu" />
                    </div>
                    <!-- <div class="form-group">
                        <label>Bạn là: </label>
                        <select  class="form-control" name="level" style="width: 100%;">
                            <option value="2">Khách hàng mới</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                         Khách hàng mới: <input type="radio" style="width: auto;" name="level" value="2">
                          <!-- Không: <input type="radio" checked name="featured" value="0">  -->
                    </div>
                    <!-- <div class="form-group">
                        <label for="phone"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="phone" name="phone" id="phone" placeholder="Số điện thoại" />
                    </div> -->
                    <!-- <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" /> 
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>Tôi đồng ý với tất cả quy định <a href="#" class="term-service">Terms of service</a></label>
                        </div> -->
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