@extends('layouts.app')
@section('title','Hoàn thành')
@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-sm-12 col-sm-offset-3">
            <br><br>
            <h2 style="color:#0fad00">Success</h2>
            <!-- <img src="http://osmhotels.com//assets/check-true.jpg"> -->
            <h3>Thân gửi bạn !</h3>
            <p style="font-size:20px;color:#5C5C5C;">Cảm ơn bạn đã cung cấp thông tin của mình 
            Chúng tôi đã gửi cho bạn một email đến địa chỉ email bạn cung cấp với thông tin chi tiết đơn hàng của bạn.
             Vui lòng truy cập email của bạn ngay bây giờ và kiểm tra đơn hàng nhé !</p>
            <a href="{{asset('product')}}" class="btn btn-success"> Tiêp tục mua sắm </a>
            <br><br>
        </div>

    </div>
</div>
@endsection