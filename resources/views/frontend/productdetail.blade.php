@extends('layouts.app')
@section('title',$item->prod_name)
@section('content')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">

<div class="container body">
    <div class="product-detail row">
        <div class="col-xs-4 col-md-6 product-detail-image">
            <div class="row product-detail-image-info">
                <div class="col-md-3 image-gallery">
                    <div id="divId" onclick="changeImageOnClick(event)">
                        <?php
                        $images = explode('|', $item->prod_gallery);
                        ?>
                        @foreach($images as $file)
                        <img class="imgStyle" src="{{asset('storage/gallery/'.$file)}}" />
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9 image-main-show">
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
                                    <button class="decrement-btn" type="button">-</button>
                                    <input aria-label="Số lượng" value="1" min="1" max="100" maxlength="2" name="quantity" class="qty" type="text" readonly style="text-align:center;">
                                    <button class="increment-btn" type="button">+</button>
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
                        <div class="product-review col-md-2 float-left text-right">
                            <a class="btnWriteReview btn elife-btn-yellow text-uppercase">Viết nhận xét</a>
                        </div>

                        <div id="reviewForm" class="review-form col-md-6" style="display: none; background:#F5F5F5">
                            <p style="margin-top:10px">Xin vui lòng chia sẻ đánh giá của bạn về sản phẩm này
                            </p>
                            <form action="" method="">
                                {{csrf_field()}}
                                <input type="hidden" name="product_id" class="product_id" value="{{ $item->prod_id }}">
                                <div class="form-group">
                                    <label for="name">Tiêu đề đánh giá (optional)</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Đánh giá</label>
                                    <select class="form-control" id="rating" name="rating" required>
                                        <option value="5">5 sao</option>
                                        <option value="4">4 sao</option>
                                        <option value="3">3 sao</option>
                                        <option value="2">2 sao</option>
                                        <option value="1">1 sao</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Nhận xét</label>
                                    <textarea class="form-control" id="comment_content" name="comment_content" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btnWriteReview btn-submit-Write-Review btn btn-primary">Gửi nhận xét</button>
                            </form>
                        </div>

                    </div>
                    <!-- Phần hiển thị bình luận -->
                    <div class="user-comments mt-5 col-md-12">
                        <h4 class="text-uppercase">Nhận xét về sản phẩm</h4>
                        <!-- <form>
                            {{csrf_field()}} -->
                        <!-- <input type="hidden" name="_token" value=""> -->
                        <input type="hidden" name="comments_product_id" class="comment_product_id" value="{{ $item->prod_id }}">
                        <div id="show_comments">
                            @foreach ($comments as $cmt)
                            <div class="comment row mb-4">
                                <div class="col-md-2 d-flex align-items-center justify-content-center">
                                    <!-- <img src="{{ $cmt->avatar ? asset('storage/avatars/'.$cmt->avatar) : asset('storage/avatars/default.png') }}"
                                                alt="avatar" class="img-fluid rounded-circle" style="width: 70px; height: 70px;"> -->
                                    <img src="" alt="avatar" class="img-fluid rounded-circle" style="width: 70px; height: 70px;">
                                </div>
                                <div class="col-md-10">
                                    <div class="comment-header d-flex justify-content-between">
                                        <strong>{{ $cmt->name }}</strong>
                                        <span class="text-muted">{{ $cmt->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="comment-body mt-2">
                                        <p>{{ $cmt->comment }}</p>
                                        <span class="badge badge-primary">{{ $cmt->rating }} sao</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach

                        </div>
                        <!-- </form> -->
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
            this.style.borderColor = "white";
        };
        images[i].onmouseout = function() {
            this.style.cursor = "pointer";
            this.style.borderColor = "grey";
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
                scrollTop: $('#product-review-section').offset().top - 110
            }, 'slow');
        });
    });
</script>
<script>
    document.querySelector('.btnWriteReview').addEventListener('click', function() {
        document.getElementById('reviewForm').style.display = 'block';
    });
    $(document).ready(function() {
        load_comments();

        $(document).on('click', '.btn-submit-Write-Review', add_comments);

        function add_comments(event) {
            event.preventDefault();
            var product_id = $('input[name="product_id"]').val();
            var rating = $('#rating').val();
            var comment_content = $('#comment_content').val();
            var _token = $('input[name="_token"]').val();
            // alert(product_id);

            $.ajax({
                url: '/add-comments',
                method: 'POST',
                data: {
                    product_id: product_id,
                    rating: rating,
                    comment_content: comment_content,
                    _token: _token,
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(response) {

                },
            })
        }

        function load_comments() {
            var product_id = $('.comment_product_id').val();

            $.ajax({
                url: '/load-comments',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: product_id,
                },
                success: function(response) {
                    $('#show_comments').html(response.html);
                },

            });
        }
    });
</script>
@endsection