@extends('layouts.app')
@section('title','Trang chủ')
@section('content')

<div>
    <!--================Home Banner Area =================-->
    <section class="home_banner_area mb-40">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="./img/banner/bioderma_banner.png" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./img/banner/banner-11.png" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./img/banner/banner-lumi-1.jpeg" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./img/banner/la-mer.png" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./img/banner/website-banner.png" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- Start feature Area -->
    <section class="feature-area section_gap_bottom_custom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <a href="#" class="title">
                            <i class="flaticon-money"></i>
                            <h3>Money back gurantee</h3>
                        </a>
                        <p>Shall open divide a one</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <a href="#" class="title">
                            <i class="flaticon-truck"></i>
                            <h3>Free Delivery</h3>
                        </a>
                        <p>Shall open divide a one</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <a href="#" class="title">
                            <i class="flaticon-support"></i>
                            <h3>Alway support</h3>
                        </a>
                        <p>Shall open divide a one</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <a href="#" class="title">
                            <i class="flaticon-blockchain"></i>
                            <h3>Secure payment</h3>
                        </a>
                        <p>Shall open divide a one</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End feature Area -->
    <!--================ Feature Product Area =================-->
    <section class="feature_product_area section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Sản Phẩm Nổi bật</span></h2>
                    </div>
                </div>
            </div>
            <div class="lunchbox">
                <div class="row swiper" id="swiper1">
                    <div class="swiper-wrapper">
                        @foreach($featured as $item)
                        <div class="col-md-3 swiper-slide">
                            <div class="single-product">
                                <form enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$item->prod_id}}"
                                        class="product_favorite_id_{{$item->prod_id}}">
                                    <input type="hidden" value="{{$item->prod_name}}"
                                        class="product_favorite_name_{{$item->prod_id}}">
                                    <input type="hidden" value="{{$item->prod_img}}"
                                        class="product_favorite_image_{{$item->prod_id}}">
                                    <input type="hidden" value="{{$item->prod_price}}"
                                        class="product_favorite_price_{{$item->prod_id}}">
                                    <div class="product-img">
                                        <img class="img-fluid" style="width:255px; height:258.44px"
                                            src="{{asset('storage/avatar/'.$item->prod_img)}}" alt="" />
                                        <div class="p_icon">
                                            <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}">
                                                <i class="ti-eye icon-style"></i>
                                            </a>
                                            <a class="icon-ti-heart ti-heart-favorite" data-id="{{$item->prod_id}}">
                                                <i class="ti-heart icon-style"></i>
                                            </a>
                                            <a href="#" data-url="{{asset('cart/add/'.$item->prod_id)}}"
                                                class="add-to-cart">
                                                <i class="ti-shopping-cart icon-style"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-btm">
                                        <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}"
                                            class="d-block">
                                            <h4>{{$item->prod_name}}</h4>
                                        </a>
                                        <div class="mt-3">
                                            <span class="mr-4">{{number_format($item->prod_price,0,',','.')}}VND</span>
                                            <del><small>
                                                    {{number_format($item->prod_promotion,0,',','.')}}VND</small></del>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
                <div id="js-prev1" class="swiper-button-prev"></div>
                <div id="js-next1" class="swiper-button-next"></div>
            </div>
        </div>
    </section>
    <!--================ End Feature Product Area =================-->

    <!--================ New Product Area =================-->
    <section class="new_product_area section_gap_top section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>SẢN PHẨM MỚI</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="new_product">
                        <h5 class="text-uppercase">Lựa chọn hàng đầu</h5>
                        <h3 class="text-uppercase">Sữa tắm nước hoa</h3>
                        <div class="product-img">
                            <img class="img-fluid" src="img/product/new-product/images.png" alt="" />
                        </div>
                        <h4>120.000 VND</h4>
                        <a href="#" class="main_btn">Thêm vào giỏ hàng</a>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="row">
                        @foreach($new as $item)
                        <div class="col-lg-6 col-md-6">
                            <div class="single-product">
                                <form>
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$item->prod_id}}"
                                        class="product_favorite_id_{{$item->prod_id}}">
                                    <input type="hidden" value="{{$item->prod_name}}"
                                        class="product_favorite_name_{{$item->prod_id}}">
                                    <input type="hidden" value="{{$item->prod_img}}"
                                        class="product_favorite_image_{{$item->prod_id}}">
                                    <input type="hidden" value="{{$item->prod_price}}"
                                        class="product_favorite_price_{{$item->prod_id}}">
                                    <div class="product-img">
                                        <img class="img-fluid w-100" src="{{asset('storage/avatar/'.$item->prod_img)}}"
                                            alt="" />
                                        <div class="p_icon">
                                            <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}">
                                                <i class="ti-eye icon-style"></i>
                                            </a>
                                            <a class="icon-ti-heart ti-heart-favorite" data-id="{{$item->prod_id}}">
                                                <i class=" ti-heart icon-style"></i>
                                            </a>
                                            <a href="#" data-url="{{asset('cart/add/'.$item->prod_id)}}"
                                                class="add-to-cart">
                                                <i class="ti-shopping-cart icon-style"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-btm">
                                        <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}"
                                            class="d-block">
                                            <h4>{{$item->prod_name}}</h4>
                                        </a>
                                        <div class="mt-3">
                                            <span class="mr-4">{{number_format($item->prod_price,0,',','.')}} VND</span>
                                            <del><small>
                                                    {{number_format($item->prod_promotion,0,',','.')}}VND</small></del>
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
    </section>
    <!--================ End New Product Area =================-->

    <!--================ Suggested Products Area =================-->
    <section class="inspired_product_area section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Sản phẩm gợi ý</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($suggested as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('storage/avatar/'.$item->prod_img)}}" alt="" />
                            <div class="p_icon">
                                <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}">
                                    <i class="ti-eye icon-style"></i>
                                </a>
                                <a class="icon-ti-heart ti-heart-favorite" data-id="{{$item->prod_id}}">
                                    <i class=" ti-heart icon-style"></i>
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
                    </div>
                </div>
                @endforeach
            </div>
    </section>
    <!--================ Start Knowledge $ Share Area =================-->
    <section class="inspired_share_area section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2 style="padding-top: 20px;"><span>Kiến thức & Quà tặng</span></h2>
                        <p style="text-align: center;">Những chia sẻ thú vị và thông tin hữu ích</p>
                    </div>
                </div>
                <div class="main_carousel grid-carousel col-lg-12">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>

                </div>
            </div>
    </section>
    <!--================ End Knowledge $ Share Area =================-->


    <!--================ End Inspired Product Area =================-->


    <!--================ End Blog Area =================-->
</div>

@endsection