@extends('layouts.app')
@section('title',$item->prod_name)
@section('content')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">

<div class="container body">
    <div class="product-detail row">
        <div class="col-xs-4 col-md-6 product-detail-image">
            <div class="row">
                <div class="col-md-3">
                    <div id="divId" onclick="changeImageOnClick(event)">
                        <?php
                        $images = explode('|', $item->prod_gallery);
                        ?>
                        @foreach($images as $file)
                        <img class="imgStyle" src="{{asset('storage/gallery/'.$file)}}" />
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9">
                    <img id="mainImage" src="{{asset('storage/avatar/'.$item->prod_img)}}" />
                </div>
            </div>

        </div>
        <div class="col-xs-5 col-md-6 product-detail-info" style="border:0px solid gray">
            <div class="product-detail-title">
                <div class="product-detail-name clearfix">
                    <h1>{{$item->prod_name}}</h1>
                    <div class="product-useful">

                        <h5><small>Sản phẩm thuộc công dụng: <a style="color:black" href="{{asset('category/'.$cateName[0]->cate_id.'/'.$cateName[0]->cate_slug.'.html')}}">{{$cateName[0]->cate_name}}</a></small>
                        </h5>
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
                            <div class="qty-section-title col-md-4">
                                Số lượng:
                            </div>
                            <div class="col-md-8">
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

            <div class="section" style="padding:20px 0;">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-action btn-add-to-cart add-to-cart" data-url="{{asset('cart/add/'.$item->prod_id)}}">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
                            </span>
                            <a class="icon-ti-cart ti-cart" href="#"> Thêm vào giỏ hàng <i class="ti-shopping-cart-full"></i>
                            </a>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-action btn-add-to-wishlist"><span class="glyphicon glyphicon-heart-empty" style="cursor:pointer;"></span><a class="icon-ti-heart ti-heart-favorite" data-id="{{$item->prod_id}}">
                                Thêm vào yêu thích <i class="ti-heart"></i>
                            </a></button>
                    </div>

                </div>
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
                        <a class="pd-tabitem-link product-review-section" nav="product-review-section">Đánh giá</a>
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
            <div id="product-review-section" class="product-detail-review-section">
                <div class="product-detail-description-wrapper">
                    <h2 class="product-detail-information-title"> Đánh giá & nhận xét </h2>
                </div>
                <div class="product-detail-review-content">
                    <div id="review-summary" class="row">
                        <div class="product-review col-md-4 float-left">
                            <div class="barChart">
                                <div class="barChart__row" data-value="0"><span class="barChart__label">5
                                        Star</span><span class="barChart__value">0</span><span class="barChart__bar"><span class="barChart__barFill"></span></span></div>
                                <div class="barChart__row" data-value="0"><span class="barChart__label">4
                                        Star</span><span class="barChart__value">0</span><span class="barChart__bar"><span class="barChart__barFill"></span></span></div>
                                <div class="barChart__row" data-value="0"><span class="barChart__label">3
                                        Star</span><span class="barChart__value">0</span><span class="barChart__bar"><span class="barChart__barFill"></span></span></div>
                                <div class="barChart__row" data-value="0"><span class="barChart__label">2
                                        Star</span><span class="barChart__value">0</span><span class="barChart__bar"><span class="barChart__barFill"></span></span></div>
                                <div class="barChart__row" data-value="0"><span class="barChart__label">1
                                        Star</span><span class="barChart__value">0</span><span class="barChart__bar"><span class="barChart__barFill"></span></span></div>
                            </div>
                        </div>
                        <div class="product-review col-md-4 float-left text-right">
                            <a class="btnWriteReview btn elife-btn-yellow text-uppercase">Viết nhận xét</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="product-different">
        <div class="title">
            <h3>Sản phẩm khác</h3>
        </div>
        <!-- navigation buttons -->
        <div id="navigation-bar">
            <button id="prev-btn" class="nav-btn"> <i class="fa fa-angle-left" aria-hidden="true"></i></button>
            <button id="next-btn" class="nav-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        </div>
        <div class="lunchbox">
            <div class="row swiper" id="swiper1">
                <div class="swiper-wrapper">
                    @foreach($product as $item)
                    <div class="col-md-3 swiper-slide">
                        <div class="single-product">
                            <form>
                                {{csrf_field()}}
                                <input type="hidden" value="{{$item->prod_id}}" class="product_favorite_id_{{$item->prod_id}}">
                                <input type="hidden" value="{{$item->prod_name}}" class="product_favorite_name_{{$item->prod_id}}">
                                <input type="hidden" value="{{$item->prod_img}}" class="product_favorite_image_{{$item->prod_id}}">
                                <input type="hidden" value="{{$item->prod_price}}" class="product_favorite_price_{{$item->prod_id}}">

                                <div class="product-img">
                                    <img class="img-fluid" src="{{asset('storage/avatar/'.$item->prod_img)}}" alt="" />
                                    <div class="p_icon">
                                        <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}">
                                            <i class="ti-eye icon-style"></i>
                                        </a>
                                        <a class="icon-ti-heart ti-heart-favorite" data-id="{{$item->prod_id}}">
                                            <i class="ti-heart icon-style"></i>
                                        </a>
                                        <a href="#" data-url="{{asset('cart/add/'.$item->prod_id)}}" class="add-to-cart">
                                            <i class="ti-shopping-cart icon-style"></i>
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
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var images = document.getElementsByTagName("img");
    for (var i = 0; i < images.length; i++) {
        images[i].onmouseover = function() {
            this.style.cursor = "hand";
            this.style.borderColor = "grey";
        };
        images[i].onmouseout = function() {
            this.style.cursor = "pointer";
            this.style.borderColor = "white";
        };
    }

    function changeImageOnClick(event) {
        var targetElement = event.srcElement;
        if (targetElement.tagName === "IMG") {
            mainImage.src = targetElement.getAttribute("src");
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('.product-review-section').on('click', function() {
            $('html, body').animate({
                scrollTop: $('#product-review-section').offset().top - 60
            }, 'slow');
        });
    });
</script>
@endsection