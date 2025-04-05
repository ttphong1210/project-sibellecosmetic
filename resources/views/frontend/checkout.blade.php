@extends('layouts.app')
@section('title','Xác nhận mua hàng')
@section('content')
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <!-- Loader -->
        <div id="loader-overlay" style="display: none ;">
            <img src="{{asset('img/loading.gif')}}" alt="Loading..." />
        </div>
        <!-- Thông báo -->
        <div id="message" style="display: none;" class="alert alert-success"></div>

        <div class="billing_details">
            <div class="row">
                <form id="checkoutForm" class="row contact_form" method="POST" enctype="multipart/form-data">
                    <div class="col-lg-8">
                        <h3>Địa chỉ giao hàng</h3>
                        <div class="row">
                            <div class="col-md-12 form-group p_star">
                                <span class="placeholder" data-placeholder="Họ và Tên"></span>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" />
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-md-6 form-group p_star">
                                <span class="placeholder" data-placeholder="Số điện thoại"></span>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" class="form-control" id="number" name="number_phone"
                                    value="{{old('number_phone')}}" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <span class="placeholder" data-placeholder=" Email"></span>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{old('email')}}" />
                            </div>
                            <div class="box-body col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <select name="city" id="city" class="form-control choose city">
                                            <option value="0">-- Chọn tỉnh/thành phố --</option>
                                            @foreach($city as $key => $c)
                                            <option value="{{$c->matp}}">{{$c->name_city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <select name="district" id="district" class="form-control choose district">
                                            <option value="">-- Chọn quận/huyện --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <select name="ward" id="ward" class="form-control ward">
                                            <option value="">-- Chọn phường/xã --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <span class="placeholder" data-placeholder="Địa chỉ chi tiết"></span>
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{old('address')}}" />
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector" />
                                    <label for="f-option2">Create an account?</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Chi tiết vận chuyển</h3>
                                    <input type="checkbox" id="f-option3" name="selector" />
                                    <label for="f-option3">Gửi hàng đến địa chỉ khác?</label>
                                </div>
                                <textarea class="form-control" name="notes" id="notes" rows="1"
                                    value="Không ghi chú cho đơn hàng" placeholder="Ghi chú đơn hàng"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Thông tin đơn hàng</h2>
                            <ul class="list">
                                @foreach($cart as $item)
                                <li>
                                    <a href="#">
                                        <span style="width: 70%;" class="cart-name">{{$item->name}}</span>
                                        <span style="width: 10%;" class="middle">x {{$item->qty}}</span>
                                        <span style="width: 20%;"
                                            class="last">{{number_format($item->price*$item->qty,0,',','.')}}đ</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a class="summary-main table" style="margin: 0px;" href="#">
                                        <p class="col subtotal-title">Tạm tính:</p>
                                        <span class="col text-right">{{$totalProduct}}đ</span>
                                    </a>
                                </li>
                                <div class="check-total-checkout">
                                    @include('frontend.component.checkout_component')
                                </div>

                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="payments" value="cash" />
                                    <label for="f-option5">Tiền mặt</label>
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Vui lòng thanh toán khi nhận hàng.
                                </p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="payments" value="credit_card" />
                                    <label for="f-option6">Chuyển khoản</label>
                                    <img src="img/product/single-product/card.jpg" alt="" />
                                    <div class="check"></div>
                                </div>
                                <div id="textbox" style="display: none;">
                                    <p class="textbox-banking">
                                        Số tài khoản: 0898238258
                                        Chủ tài khoản: TRAN THE PHONG
                                        Ngân hàng: MB BANK - MB (NGAN HANG QUAN DOI )
                                        Chi nhánh: DA NANG

                                        Nội dung chuyển khoản: “ Tên + SĐT đặt hàng ”

                                    </p>
                                </div>
                            </div>
                            <div class="form-group" style="display: grid;">
                                <button type="submit" class="main_btn" name="submit">Thực hiện đơn hàng</button>
                            </div>
                        </div>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>

        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
@endsection