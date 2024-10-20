@extends('layouts.app')
@section('title','Giỏ hàng')
@section('content')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">

@if(Cart::count() >0)
<div class="container px-4 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <table class="cart-product-item-table">
            <thead id="tableheader">
            <tr>
                <td id="header-shopping-cart" class="tablesheet-col1"> {{Cart::count()}} sản phẩm </td>
                <td class="tablesheet-col2"></td>
                <td class="tablesheet-col3">Số Lượng</td>
                <td class="tablesheet-col4"></td>
            </tr>
            </thead>
        </table>
    </div>
    <div id="cart-content">
        @include('frontend.component.shopping_cart_component')
    </div>
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