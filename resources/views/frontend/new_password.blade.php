@extends('layouts.app')
@section('title',' Đặt mật khẩu mới')
@section('content')
<style>
    .contact_form{
        height: fit-content;
        width: 700px;
    }
    .submit_btn_newpass:hover{
        color: white;
    }
</style>
<div class="container">
    <div class="returning_customer" style="margin: 5rem 0 ;">       
        <div class="contact_form" novalidate="novalidate">
            <div class="login flex-item">
                <div class="wrap">
                <form action="{{asset('account/update-new-password')}}" method="POST">
                {{csrf_field()}}
                @include('errors.note')
                <?php
                    $token = $_GET['token'];
                    $email = $_GET['email'];
                ?>
                <div class="col-md-12 form-group">
                    <span>Vui lòng nhập mật khẩu mới.</span>
                </div>
                    <div class="col-md-12 form-group p_star">
                        <input type="hidden" class="form-control" id="token" name="token" value="{{$token}}" />
                        <input type="hidden" class="form-control" id="email" name="email" value="{{$email}}"/>
                        <span class="placeholder" data-placeholder="Nhập mật khẩu mới của bạn"></span>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="btn submit_btn submit_btn_newpass">
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