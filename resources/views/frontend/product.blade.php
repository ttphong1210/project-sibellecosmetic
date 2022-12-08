@extends('layouts.app')
@section('title','Sản phẩm')
@section('content')
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Sản phẩm</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="{{route('home')}}">Home</a>
          <a href="category.html">Shop</a>
          <a href="category.html">Women Fashion</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <div class="product_top_bar">
          <div class="left_dorp">
            <form action="">

              <select class="sorting" id="sort">
                <option value="{{Request::url()}}?sort_by=none">Sắp xếp theo...</option>
                <option value="{{Request::url()}}?sort_by=gia_tang_dan">Giá tăng dần...</option>
                <option value="{{Request::url()}}?sort_by=gia_giam_dan">Giá giảm dần...</option>
              </select>

              <!-- <select class="show" id="show">
                    <option value="{{Request::url()}}?show_by=none">Hiển thị...</option>
                    <option value="{{Request::url()}}?show_by=show_6">Hiển thị 6</option>
                    <option value="{{Request::url()}}?show_by=show_10">Hiển thị 10</option>
                    <option value="{{Request::url()}}?show_by=show_14">Hiển thị 14</option>
                  </select> -->
              {{csrf_field()}}
            </form>
          </div>
        </div>

        <div class="latest_product_inner">
          <div class="row">
            @foreach($product as $item)
            <div class="col-lg-4 col-md-6">
              <div class="single-product">
                <form>
                  {{csrf_field()}}
                  <input type="hidden" value="{{$item->prod_id}}" class="product_favorite_id_{{$item->prod_id}}">
                  <input type="hidden" value="{{$item->prod_name}}" class="product_favorite_name_{{$item->prod_id}}">
                  <input type="hidden" value="{{$item->prod_img}}" class="product_favorite_image_{{$item->prod_id}}">
                  <input type="hidden" value="{{$item->prod_price}}" class="product_favorite_price_{{$item->prod_id}}">
                  <div class="product-img">
                    <img class="card-img" src="{{asset('storage/avatar/'.$item->prod_img)}}" alt="" />
                    <div class="p_icon">
                      <a href="{{asset('detail/'.$item->prod_id.'/'.$item->prod_slug.'.html')}}">
                        <i class="ti-eye"></i>
                      </a>
                      <a class="icon-ti-heart ti-heart-favorite" data-id="{{$item->prod_id}}">
                        <i class=" ti-heart"></i>
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
                      <del><small>{{number_format($item->prod_promotion,0,',','.')}}VND</small></del>
                    </div>
                  </div>
                  </form>
              </div>
            </div>
            @endforeach

          </div>
          {{$product->links()}}
        </div>
      </div>

      <div class="col-lg-3">
        <div class="left_sidebar_area">
          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Danh mục sản phẩm</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                @foreach($category as $cate)
                <li>
                  <a href="{{asset('category/'.$cate->cate_id.'/'.$cate->cate_slug.'.html')}}">{{$cate->cate_name}}</a>
                </li>
                @endforeach
              </ul>
            </div>
          </aside>

          <aside class="left_widgets p_filter_widgets">
            <div class="l_w_title">
              <h3>Thương hiệu sản phẩm</h3>
            </div>
            <div class="widgets_inner">
              <ul class="list">
                @foreach($brands as $brand)
                <li>
                  <a href="{{asset('brand/'.$brand->brand_id.'/'.$brand->brand_slug.'.html')}}">{{$brand->brand_name}}</a>
                </li>
                @endforeach
              </ul>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Category Product Area =================-->
@endsection