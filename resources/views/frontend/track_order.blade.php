@extends('layouts.app')
@section('title','Theo dõi đơn hàng')
@section('content')

<!--================Home Banner Area =================-->
<section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Theo dõi đơn hàng</h2>
              <!-- <p>Very us move be blessed multiply night</p> -->
            </div>
            <div class="page_link">
              <a href="{{url('/')}}">Trang chủ</a>
              <a href="{{url('tracking-order')}}">Theo dõi đơn hàng</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Tracking Box Area =================-->
    <section class="tracking_box_area section_gap">
        <div class="container">
            <div class="tracking_box_inner">
                <p>Để theo dõi đơn hàng của bạn, vui lòng nhập ID đơn hàng của bạn vào ô bên dưới và nhấn nút "Theo dõi". Điều này đã được trao cho bạn trên biên nhận của bạn và trong email xác nhận mà lẽ ra bạn phải nhận được.</p>
                <form class="row tracking_form" action="#" method="post" novalidate="novalidate">
                  {{csrf_field()}}
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" id="order" name="order_code" placeholder="Mã đơn hàng" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" name="email_order" placeholder="Địa chỉ Email thanh toán" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="btn submit_btn submit_btn_tracking_order">Theo dõi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Tracking Box Area =================-->
@endsection