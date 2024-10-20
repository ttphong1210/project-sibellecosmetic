<header class="header_area">
    <div class="top_menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="float-left">
                        <p>Phone: 077 940 6396</p>
                        <p>email: Si.Belle@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="float-right">
                        <ul class="right_side">
                            <li>
                                <a href="cart.html">
                                     Quà tặng
                                </a>
                            </li>
                            <li>
                                <a href="{{url('tracking-order')}}">
                                    Theo dõi đơn hàng
                                </a>
                            </li>
                            <li>
                                <a href="{{url('contact')}}">
                                    Liên hệ
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{route('home')}}">
                    <img src="{{asset('img/Si.belle.jpeg')}}" alt="" style="width: 137px; height: 38px;" />
                </a>
                <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                    <div class="row w-100 mr-0">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('home')}}">Trang chủ</a>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="{{route('product')}}" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sản phẩm</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('product')}}">Tất cả sản phẩm</a>
                                        </li>
                                        @foreach($categories as $cate)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{asset('category/'.$cate->cate_id.'/'.$cate->cate_slug.'.html')}}">{{$cate->cate_name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="{{route('product')}}" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Thương hiệu</a>
                                    <ul class="dropdown-menu">

                                        @foreach($brands as $brand)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{asset('brand/'.$brand->brand_id.'/'.$brand->brand_slug.'.html')}}">{{$brand->brand_name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{asset('blog/qua-tang')}}">Quà tặng</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="single-blog.html">Kiến thức chăm sóc</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('contact')}}">Liên hệ</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5 pr-0">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">                                
                                <li class="nav-item">
                                    <form action="{{asset('search/')}}" method="get" class="icons form-search-icons">
                                        <div class="form-search">
                                            <input type="text" placeholder="Tìm kiếm.." id="input-search" name="result" style="border:none; outline:none;">
                                            <!-- <button id="btn-submit-search" type="submit" style="outline: none;">
                                                 <i id="icon-search" class="ti-search" aria-hidden="true"></i>
                                                </button> -->
                                        </div>
                                    </form>
                                </li>
                                <li id="list-product-minicart" class="nav-item submenu dropdown ">
                                    @include('frontend.component.mini_cart')
                                </li>
                                <li id="user-account" class="nav-item submenu dropdown ">
                                    <a class="icons nav-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-user" aria-hidden="true"></i>
                                    </a>
                                    @if(Auth::guard('account_customer')->check())
                                    <ul class="dropdown-menu-user show-menu-login">
                                        <li class="nav-link">
                                            <a href="#" style="color: black;"> Chào
                                                {{Auth::guard('account_customer')->user()->name}}</a>
                                        </li>
                                        <li class="nav-link">
                                            <a href="{{asset('account/logout-customer')}}" style="color: black;">Logout</a>
                                        </li>
                                    </ul>
                                    @else
                                    <ul class="dropdown-menu-user d-flex row show-menu-login">
                                        <li class="col-md-6 nav-link">
                                            <a href="{{asset('account/login-customer')}}" style="color: black;">Đăng
                                                nhập</a>
                                        </li>
                                        <li class="col-md-6 nav-link">
                                            <a href="{{asset('account/register-customer')}}" style="color: black;">Đăng
                                                ký</a>
                                        </li>
                                    </ul>
                                    @endif
                                </li>
                                <li id="favorite-product" class="nav-item ">
                                    <a href="{{asset('favorite')}}" class="icons">
                                        <i class="ti-heart" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<script>
    $(document).ready(function() {
        $("#icon-search").click(function() {
            $("#input-search").show();
        });
    });
</script>