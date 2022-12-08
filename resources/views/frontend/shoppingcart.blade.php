@extends('layouts.app')
@section('title','Giỏ hàng')
@section('content')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
<script>
    function updateCart(qty,rowId){
        $.get(
            '{{asset('cart/update')}}',
            {qty:qty,rowId:rowId},
            function(){
               location.reload();
            // window.location.href = '{{asset('cart/show')}}'
            }
        )    
    }
</script>

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
        @foreach($items as $item)
        <div class="row d-flex justify-content-center border-top">
            <div class="col-5">
                <div class="row d-flex">
                    <div class="book">
                        <img src="{{asset('storage/avatar/'.$item->options->img)}}" class="book-img">
                    </div>
                    <div class="my-auto flex-column d-flex pad-left">
                        <h6 class="mob-text">{{$item->name}}</h6>

                    </div>
                </div>
            </div>
            <div class="my-auto col-7">
                <div class="row text-right">
                    <div class="col-4">
                        <div class="row d-flex justify-content-end px-3">
                            <input type="number" id="number-quantity" class="cart-quantity" name="cart-qty-changeQty[{{$item->rowId}}]" min="1" max="100"  value="{{$item->qty}}" onchange="updateCart(this.value,'{{$item->rowId}}')">
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="mob-text">{{number_format($item->price,0,',','.')}} VND</p>
                    </div>

                    <div class="col-4">
                        <h6 class="mob-text">{{number_format($item->price*$item->qty,0,',','.')}} VND</h6>
                    </div>
                </div>
            </div>
            <div class="btn-delete">
                <span><a class="delete-item-cart" href="{{asset('cart/delete/'.$item->rowId)}}"> Xoá </a></span>
            </div>
        
        </div>
        @endforeach
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-8">
                           
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="row d-flex justify-content-between px-4">
                                <p class="mb-1 text-left">Tạm tính: </p>
                                <h6 class="mb-1 text-right">{{$total}}đ</h6>
                            </div>
                            
                            <div class="row d-flex justify-content-between px-4" id="tax">
                                <p class="mb-1 text-left">Tổng tiền: </p>
                                <h6 class="mb-1 text-right">{{$total}}đ</h6>
                            </div>
                                <button class="btn-block btn-blue">
                                    <span>
                                        <span id="checkout"><a href="{{asset('checkout')}}">Tiến hành đặt hàng</a> </span>
                                        <span id="check-amt">{{$total}}đ</span>
                                    </span>
                                </button>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @else 
    <div class="container">
    <div class="row text-center">
        <div class="col-sm-12 col-sm-offset-3">
            <br><br>
            <p> Chưa có sản phẩm trong giỏ hàng !</p>
            
            <a href="{{asset('product')}}" style="border-radius:20px ; width:20%;" class="btn btn-success"> Quay lại mua sắm </a>
            <br><br>
        </div>

    </div>
</div>
@endif
@endsection