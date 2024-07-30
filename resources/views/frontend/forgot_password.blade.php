@extends('layouts.app')
@section('title','Đăng nhập tài khoản của bạn')
@section('content')
<style>
    .contact_form {
        height: fit-content;
        width: 700px;
    }

    .submit_btn_forgotpass:hover {
        color: white;
    }
</style>
<div class="container">
    <div class="returning_customer" style="margin: 5rem 0 ;">
        <div class="contact_form" novalidate="novalidate">
            <div class="login flex-item">
                <div class="wrap">
                    <form action="{{asset('account/reset-password')}}" method="POST">
                        {{csrf_field()}}
                        @include('errors.note')
                        <div class="col-md-12 form-group">
                            <span>Vui lòng nhập email của bạn để yêu cầu mật khẩu mới, hệ thống sẽ gửi link xác thực mật khẩu vào email điền bên dưới.</span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <span class="placeholder" data-placeholder="Nhập email của bạn"></span>
                            <input type="text" class="form-control" id="email" name="email" />
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="btn submit_btn submit_btn_forgotpass">
                                Gửi
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection