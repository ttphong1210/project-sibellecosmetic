@extends('layouts.app')
@section('title',' Sản phầm yêu thích')
@section('content')
<div class="container px-4 py-5 mx-auto">
    <div class="row d-flex justify-content-center border-top" style="padding-top:40px;">
        <div class="col-2 title-for-product-favorite">
            <div class="row d-flex">
                <div class="my-auto flex-column d-flex pad-left">
                    <span class="mob-text"> Sản phẩm yêu thích</span>
                </div>
            </div>
        </div>

        <div class="my-auto col-10 item-favorite" style="padding: 0 40px;">
            @if(session()->get('favorite') == true)
                @foreach(Session::get('favorite') as $key => $item)
                <div class="row text-right favorite">
                    <div class="col-2">
                        <img style="width:auto;" src="{{asset('storage/avatar/'.$item['product_image'])}}" alt="">
                    </div>
                    <div class="col-8 product-favorite">
                        <div class="product-favorite-name">
                            <span>{{$item['product_name']}}</span>
                        </div>
                        <div class="product-favorite-price">
                            <span>Giá: {{number_format($item['product_price'])}}</span>
                        </div>
                    </div>
                    <div class="col-2 product-favorite btn-buy">
                        <a href="#" data-url="{{asset('cart/add/'.$item['product_id'])}}"
                                                class="add-to-cart"> <button class="btn btn-buy-product">Mua ngay</button></a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="row text-center">
                    <div class="col-sm-12 col-sm-offset-3">
                        <br><br>
                        <p> Chưa có sản phẩm được yêu thích !</p>
                        <a href="{{asset('product')}}" style="border-radius:20px ; width:20%;" class="btn btn-success"> Quay lại mua sắm </a>
                        <br><br>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection     