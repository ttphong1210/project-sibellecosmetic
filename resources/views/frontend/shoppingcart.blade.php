@extends('layouts.app')
@section('title','Giỏ hàng')
@section('content')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">

@if(Cart::count() >0)
<div class="container px-4 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-5">
            <h5 class="heading">Giỏ hàng({{Cart::count()}} sản phẩm)</h5>
        </div>
        <div class="col-7">
            <div class="row text-right">
                <div class="col-4">
                    <h6 class="mt-2">Số Lượng</h6>
                </div>
                <div class="col-4">
                    <h6 class="mt-2">Đơn giá</h6>
                </div>
                <div class="col-4">
                    <h6 class="mt-2">Thành tiền</h6>
                </div>
            </div>
        </div>
    </div>
    <div id="cart-content">
    @include('frontend.component.shopping_cart_component')
    </div>

    @else
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12 col-sm-offset-3">
                <br><br>
                <p> Chưa có sản phẩm trong giỏ hàng !</p>

                <a href="{{asset('product')}}" style="border-radius:20px ; width:20%;" class="btn btn-success"> Quay lại
                    mua
                    sắm </a>
                <br><br>
            </div>

        </div>
    </div>
    @endif
    @endsection