<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{asset('img/logo-cosmetic.png')}}" type="image/png" />

    <title>SI.BELLE Cosmetic | @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/fonts/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/fonts/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}" />
    <link rel="" type="" href="http://sachinchoolur.github.io/lightslider/dist/css/lightslider.css">

    <!-- main css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
    <link rel="stylesheet" href="{{asset('css/login-checkout.css')}}">


    <link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
</head>

<body>

    @if (session('success'))
    <div class="alert alert-success container">
        {{ session('success') }}
    </div>
    @endif
    <!--================Header Menu Area =================-->
    @include('frontend.includes.header')
    <!-- ================ End Header Menu Area ================= -->
    <div id="preloader">
        <div class="loading"></div>
    </div>
    <main>
        
    @yield('content')
    </main>

    <!--================ start footer Area  =================-->
    @include('frontend.includes.footer')
    <!-- ================ end footer Area  ================= -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>

    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/stellar.js')}}"></script>
    <script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('js/mail-script.js')}}"></script>

    <!-- Contact JS -->
    <script src="{{asset('js/jquery.form.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <!--Gmaps Js-->
    <script src="{{asset('js/gmaps.min.js')}}"></script>

    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    <!-- Nice Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Swiper demos-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script src="{{asset('js/script.js')}}"></script>

    <script src="{{asset('js/account.js')}}"></script>

    <!-- AJAX add to Cart -->
    <script src="{{asset('js/cart.js')}}"></script>

    <!-- AJAX form check out -->
    <script src="{{asset('js/checkout.js')}}"></script>
    <script>
        window.addEventListener('load', () => {
            const preloader = document.querySelector('#preloader');
            preloader.classList.add('unactive');

        })
    </script>

    <script>
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name = "_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'district'
                } else {
                    result = 'ward'
                }
                $.ajax({
                    url: "/select-shipping-infomation",
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                })
            })
            $(document).ready(function() {
                $('#ward').change(function() {
                    var matp = $('.city').val();
                    var maqh = $('.district').val();
                    var xaid = $('.ward').val();
                    var _token = $('input[name = "_token"]').val();
                    if (xaid === "") {
                        alert('Vui lòng nhập thông tin tính phí vận chuyển !');
                    } else {
                        $.ajax({
                            url: "/charge-shipping",
                            method: 'POST',
                            data: {
                                matp: matp,
                                maqh: maqh,
                                xaid: xaid,
                                _token: _token
                            },
                            success: function(response) {
                                alert('Phí ship đã được tính thành công !');
                                $('.check-total-checkout').html(response.checkout_component);
                            },
                            error: function(error) {
                                alert(
                                    'Đã xảy ra lỗi trong quá trình tính phí vận chuyển. Vui lòng thử lại.');
                            }
                        })
                    }
                })
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.icon-ti-heart').on('click', function() {
                var id = $(this).attr('data-id');
                var product_favorite_id = $('.product_favorite_id_' + id).val();
                var product_favorite_name = $('.product_favorite_name_' + id).val();
                var product_favorite_image = $('.product_favorite_image_' + id).val();
                var product_favorite_price = $('.product_favorite_price_' + id).val();
                var _token = $('input[name = "_token"]').val();

                $.ajax({
                    url: "/add-product-favorite",
                    method: 'POST',
                    data: {
                        product_favorite_id: product_favorite_id,
                        product_favorite_name: product_favorite_name,
                        product_favorite_image: product_favorite_image,
                        product_favorite_price: product_favorite_price,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.action == 'add') {
                            $('a[data-id = ' + product_favorite_id + ']').html(
                                '<i class="ti-heart icon-style" style="color:red"></i>'
                            );
                            alert(response.message);
                        } else if (response.action == 'remove') {
                            $('a[data-id = ' + product_favorite_id + ']').html(
                                '<i class="ti-heart icon-style"></i>');
                            alert(response.message);
                        }
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function(event){
            $('#user-account').click(function(){
                window.location.href = 'account/login-customer';
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.submit_btn_tracking_order').on('click', function(event){
                event.preventDefault();
                var order_code = $('input[name = "order_code"]').val();
                var email_order = $('input[name = "email_order"]').val();
                var _token = $('input[name = "_token"]').val();
                if (!order_code || !email_order) {
                    alert("Vui lòng điền đầy đủ mã đơn hàng và email đặt hàng.");
                    return;
                }

                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(!emailRegex.test(email_order)){
                    alert("Vui lòng nhập đúng định dạng email.");
                    return;
                }

                $.ajax({
                    url: "/tracking-order",
                    method: 'POST',
                    data: {
                        order_code: order_code,
                        email_order: email_order,
                        _token: _token
                    },
                    success: function(response){
                        if (response.messageSuccess) {
                            alert(response.messageSuccess);
                            setTimeout(function(){
                                window.location.href = '/detail-tracking-order?order_code=' + encodeURIComponent(String(response.order_code));
                            },1000);
                        } else {
                            alert("Không tìm thấy thông tin đơn hàng.");
                        }
                    },
                    error: function(xhr){
                        if (xhr.status === 404) {
                            alert(xhr.responseJSON.messageError);
                        } else {
                            alert("Thất bại khi theo dõi đơn hàng.");
                        }
                    }
                })
            })
            
        });
    </script>

</body>

</html>