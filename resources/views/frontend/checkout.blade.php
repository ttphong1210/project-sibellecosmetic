@extends('layouts.app')
@section('title','Xác nhận mua hàng')
@section('content')
<link rel="stylesheet" href="{{asset('css/login-checkout.css')}}">

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <form class="row contact_form" action="{{asset('checkout')}}" method="POST" novalidate="novalidate">
                    <div class="col-lg-8">
                        <h3>Địa chỉ giao hàng</h3>
                        @if(session('alert'))
                        <div class="alert alert-success">
                            {{session('alert')}}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 form-group p_star">
                                <span class="placeholder" data-placeholder="Họ và Tên"></span>
                                <input type="text" required class="form-control" name="name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <span class="placeholder" data-placeholder="Số điện thoại"></span>
                                <input type="text" required class="form-control" id="number" name="number_phone" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <span class="placeholder" data-placeholder=" Email"></span>
                                <input type="text" required class="form-control" id="email" name="email" />
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <span class="placeholder" data-placeholder="Địa chỉ"></span>
                                <input type="text" required class="form-control" id="address" name="address" />
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
                                <textarea class="form-control" name="notes" id="notes" rows="1" value="Không ghi chú cho đơn hàng" placeholder="Ghi chú đơn hàng"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Thông tin đơn hàng</h2>
                            <ul class="list">
                            <?php $totalProduct =  0 ?>
                                @foreach($cart as $item)
                                <li>
                                    <a href="#">
                                        <span style="width: 70%;" class="cart-name">{{$item->name}}</span>
                                        <span style="width: 10%;" class="middle">x {{$item->qty}}</span>
                                        <span style="width: 20%;" class="last">{{number_format($item->price*$item->qty,0,',','.')}}đ</span>
                                    </a>
                                </li>
                                <?php $totalProduct +=$item->price*$item->qty?>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a class="summary-main table" style="margin: 0px;" href="#">
                                        <p class="col subtotal-title">Tạm tính:</p>
                                        <span class="col text-right"><?php echo number_format( $totalProduct,0,',','.')?>đ</span> 
                                    </a>
                                </li>
                                
                                @if(Session::has('feeship'))
                                    <li>
                                        <a href="{{asset('delete-feeship')}}" id="fee-ship-checkout">
                                        <p class="col subtotal-title"> Phí ship:</p>
                                        <i class="fa fa-close" style="padding:18px 10px;"></i>
                                            <span>
                                                {{number_format(Session::get('feeship'),0,',','.')}}đ
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="summary-main table" id="total-checkout" href="#">
                                            <p class="col total-title">Tổng tiền:</p>
                                            <?php  $total_after_feeship = $totalProduct + session()->get('feeship') ?>
                                            <span class="col text-right"> <?php echo number_format($total_after_feeship,0,',','.')?>đ </span>
                                        </a>
                                    </li>
                                    @else
                                     <?php $fee = 25000 ?>
                                    <li>
                                        <a href="#" id="fee-ship-checkout">
                                            <p class="col subtotal-title"> Phí ship: <small>Toàn quốc</small></p>
                                           
                                            <span>
                                                {{number_format($fee,0,',','.')}}đ
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="summary-main table" id="total-checkout" href="#">
                                            <p class="col total-title">Tổng tiền:</p>
                                            <?php $total_after_feeship = $totalProduct + $fee?>
                                            <span class="col text-right"> <?php echo number_format($total_after_feeship,0,',','.')?>đ </span>
                                        </a>
                                    </li>
                                    
                                @endif
                            </ul>
                            <!-- <div class="list-2">
                            <div class="summary-main table">
                                <div class="summary-subtotal row">
                                    <p class="col">Tạm tính: </p>
                                    <span class="col text-right"> 220.000</span>
                                </div>
                            </div>
                        </div> -->
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="payments" value="0" />
                                    <label for="f-option5">Tiền mặt</label>
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Vui lòng thanh toán khi nhận hàng.
                                </p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="payments" value="1" />
                                    <label for="f-option6">Paypal </label>
                                    <img src="img/product/single-product/card.jpg" alt="" />
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Please send a check to Store Name, Store Street, Store Town,
                                    Store State / County, Store Postcode.
                                </p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector" />
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            <div class="form-group" style="display: grid;">
                                <button type="submit" class="main_btn" name="submit">Thực hiện đơn hàng</button>
                            </div>
                            <!-- <a class="main_btn" name="submit" type="submit" href="{{asset('cart/show')}}">Proceed to Paypal</a> -->
                        </div>
                    </div>

                    {{csrf_field()}}
                </form>
                <form role="form delivery_form" method="POST" action="" style="width: 66%;" enctype="multipart/form-data">
                    @include('errors.note')
                    <div class="box-body">
                        <div class="form-group">
                            <select required name="city" id="city" class="form-control choose city">
                                <option value="0">-- Chọn tỉnh/thành phố --</option>
                                @foreach($city as $key => $c)
                                <option value="{{$c->matp}}">{{$c->name_city}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select required name="district" id="district" class="form-control choose district">
                                <option value="">-- Chọn quận/huyện --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select required name="ward" id="ward" class="form-control ward">
                                <option value="">-- Chọn phường/xã --</option>
                            </select>
                        </div>
                        <div class="box-footer">
                            <button type="button" data-token="{{ csrf_token() }}" style="background-color:#71cd14 ;" name="charge-shipping" class="btn btn-primary charge-shipping">Tính phí vận chuyển</button>
                        </div>
                        {{csrf_field()}}
                </form>
            </div>

        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

@endsection