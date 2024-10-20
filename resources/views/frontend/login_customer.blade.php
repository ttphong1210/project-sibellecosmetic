@extends('layouts.app')
@section('title','Đăng nhập tài khoản của bạn')
@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var check = document.getElementById('check');
        var password = document.getElementById('password');
        var text = document.getElementById('checkdisplay');

        check.onclick = function(){
            togglePassword();
        }

        function togglePassword() {
            if(check.checked){
                password.type = 'text';
                text.innerHTML = "Ẩn mật khẩu";
            }else{
                password.type = 'password';
                text.innerHTML = "Hiện mật khẩu";
            }
        }
    })
</script>
<div class="container">
    <div class="returning_customer" style="margin: 5rem 0 ;">
        <!-- <div class="check_title">
            <h2>
                Returning Customer?
                <a href="#">Click here to login</a>
            </h2>
        </div> -->
        <p>
            Nếu bạn đã mua sắm với chúng tôi trước đây, vui lòng nhập thông tin chi tiết của bạn vào ô bên dưới. Nếu
            bạn là khách hàng mới, vui lòng Đăng ký tài khoản và chuyển đến phần Thanh toán & Giao hàng.
        </p>
        <div class="row contact_form" novalidate="novalidate">
            <div class="col-md-6 login flex-item">
                <div class="wrap">
                    <form action="{{asset('account/login-customer')}}" method="POST">
                        {{csrf_field()}}
                        @include('errors.note')
                        <div class="col-md-12 form-group p_star">
                            <span class="placeholder" data-placeholder="Username or Email"></span>
                            <input type="email" required class="form-control" id="name" name="email" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <span class="placeholder" data-placeholder="Password"></span>
                            <input type="password" required class="form-control" id="password" name="password" />
                            <div class="creat_account">
                                <input type="checkbox" id="check" name="selector" />
                                <label for="f-option" id="checkdisplay">Hiện mật khẩu</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="btn submit_btn">
                                Đăng nhập
                            </button>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option" name="selector" />
                                <label for="f-option">Ghi nhớ đăng nhập</label>
                            </div>
                            <a class="lost_pass" href="{{asset('account/forgot-password')}}">Quên mật khẩu?</a>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-6 notification-register  flex-item">
                <div class="wrap">
                    <h5>Khách hàng mới ?</h5>
                    <p style="font-family: 'FontAwesome' ;">Đăng ký trang web này cho phép bạn truy cập trạng thái và lịch sử đơn hàng của mình. Chúng tôi sẽ nhanh chóng thiết lập một tài khoản mới cho bạn. Vì điều này sẽ chỉ yêu cầu bạn cung cấp thông tin cần thiết để làm cho quá trình mua hàng nhanh hơn và dễ dàng hơn</p>
                    <button class="btn"><a href="{{asset('account/register-customer')}}" style="color:white ;" class="btn">Tạo tài khoản</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection