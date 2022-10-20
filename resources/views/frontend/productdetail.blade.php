@extends('layouts.app')
@section('title',$item->prod_name)
@section('content')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">

<div class="container body">
    <div class="product-detail row">
        <div class="col-xs-4 col-md-6 item-photo product-detail-image">
            <img style="max-width:100%; height:80%" src="{{asset('storage/avatar/'.$item->prod_img)}}" />
        </div>
        <div class="col-xs-5 col-md-6 product-detail-info" style="border:0px solid gray">
            <div class="product-detail-title">
                <div class="product-detail-name clearfix">
                    <h1>{{$item->prod_name}}</h1>
                    <div class="product-useful">

                        <h5><small>Sản phẩm thuộc công dụng: <a style="color:black" href="#">{{$cateName[0]->cate_name}}</a></small></h5>
                    </div>
                </div>
                <div class="product-detail-sale-price">
                    <div class="detail-saleoff">
                        <h6 class="title-price"> <small>Giá đề xuất:</small> </h6>
                        <span>{{number_format($item->prod_price,0,',','.')}} VND</span>
                        <del><small>Giá thị trường: {{number_format($item->prod_promotion,0,',','.')}}VND</small></del>
                    </div>
                </div>
                <div class="product-detail-summary">
                    <div>
                        <p>
                            {!!$item->prod_summary!!}
                        </p>
                    </div>
                </div>
                <div class="product-detail-option">
                    <div class="qty-section">
                        <div class="row">
                            <div class="qty-section-title col-md-2">
                                Số lượng:
                            </div>
                            <div class="col-md-10">
                                <div id="order-qty" class="enumber-control">
                                    <input aria-label="Số lượng" value="1" min="1" max="100" maxlength="2" name="quantity" class="qty" type="number" style="text-align:center;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section" style="padding: 15px;">
                <h6 class="title-attr"><small>Tình trạng: @if($item->prod_status==0) Còn hàng @else Hết hàng @endif
                    </small></h6>
            </div>

            <div class="section" style="padding-bottom:20px;">
                <button class="btn btn-success"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><a href="{{asset('cart/add/'.$item->prod_id)}}" style="color:black;"> Thêm vào giỏ hàng</a></button>
                <h6><a href="#"><span class="glyphicon glyphicon-heart-empty" style="cursor:pointer;"></span> Agregar a
                        lista de deseos</a></h6>
            </div>
        </div>
    </div>
    <div class="product-detail-content">
        <div class="product-detail-main-content">
            <div class="product-detail-tab">
                <div class="row">
                    <div class="product-detail-tab-item col-md-3">
                        <a class="pd-tabitem-link" nav="product-info-section">Thông tin sản phẩm</a>
                    </div>
                    <div class="product-detail-tab-item col-md-3">
                        <a class="pd-tabitem-link" nav="product-user-guide-section">Hướng dẫn sử dụng</a>
                    </div>
                    <div class="product-detail-tab-item col-md-3">
                        <a class="pd-tabitem-link" nav="product-specification-section">Thành phần</a>
                    </div>
                    <div class="product-detail-tab-item col-md-3">
                        <a class="pd-tabitem-link" nav="product-review-section">Đánh giá</a>
                    </div>
                </div>
            </div>
            <div id="product-info-section" class="product-detail-description">
                <div class="product-detail-description-wrapper">
                    <h2 class="product-detail-information-title"></h2>
                </div>
                <div class="prduct-detail-description-content">
                    {!!$item->prod_des!!}

                </div>
            </div>
        </div>
    </div>
    <div class="product-different">
    <div class="title">
                <h3>Sản phẩm khác</h3>
            </div>
        <div class="lunchbox">
            <div class="row swiper" id="swiper1">
                <div class="swiper-wrapper">
                    @foreach($product as $item)
                    <div class="col-md-3 swiper-slide">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid" style="width:255px; height:258.44px" src="{{asset('storage/avatar/'.$item->prod_img)}}" alt="" />
                                <div class="p_icon">
                                    <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="ti-heart"></i>
                                    </a>
                                    <a href="{{asset('cart/add/'.$item->prod_id)}}">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-btm">
                                <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}" class="d-block">
                                    <h4>{{$item->prod_name}}</h4>
                                </a>
                                <div class="mt-3">
                                    <span class="mr-4">{{number_format($item->prod_price,0,',','.')}}VND</span>
                                    <del><small> {{number_format($item->prod_promotion,0,',','.')}}VND</small></del>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <!-- navigation buttons -->
            <div id="js-prev1" class="swiper-button-prev"></div>
            <div id="js-next1" class="swiper-button-next"></div>
        </div>
    </div>
</div>
@endsection