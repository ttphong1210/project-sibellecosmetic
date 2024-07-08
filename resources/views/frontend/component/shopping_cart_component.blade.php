@foreach($items as $item)
    <div class="row d-flex justify-content-center border-top">
            <div class="col-5">
                <div class="row d-flex">
                    <div class="book">
                        <img src="{{asset('storage/avatar/'.$item->options->img)}}" class="book-img">
                    </div>
                    <div class="my-auto flex-column d-flex pad-left">
                        <h6 class="mob-text">{{$item->name}}</h6>

                    </div>
                </div>
            </div>
            <div class="my-auto col-7">
                <div class="row text-right">
                    <div class="col-4">
                        <div class="row d-flex justify-content-end px-3">
                            <input type="number" id="number-quantity" class="cart-quantity cart-update cart-update-url" name="cart-qty-changeQty[{{$item->rowId}}]" min="1" max="10" step="1" value="{{$item->qty}}" data-url="{{asset('cart/update')}}" data-id="{{$item->rowId}}">
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="mob-text">{{number_format($item->price,0,',','.')}} VND</p>
                    </div>

                    <div class="col-4">
                        <h6 class="mob-text">{{number_format($item->price*$item->qty,0,',','.')}} VND</h6>
                    </div>
                </div>
            </div>
            <div class="btn-delete">
                <span><a class="delete-item-cart" href="{{asset('cart/delete/'.$item->rowId)}}"> Xoá </a></span>
            </div>

    </div>
    @endforeach
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Chính sách mua hàng</h5>
                        <ul>
                            <li>Sản phẩm được đổi 1 lần duy nhất, không hỗ trợ trả.</li>
                            <li>Sản phẩm còn đủ tem mác, chưa qua sử dụng.</li>
                            <li>Sản phẩm nguyên giá được đổi trong 7 ngày</li>
                            <li>Sản phẩm sale chỉ hỗ trợ đổi size (nếu cửa hàng còn) trong 7 ngày</li>
                        </ul>
                    </div>
                    <div class="col-lg-4 mt-2">
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Tạm tính: </p>
                            <h6 class="mb-1 text-right">{{$total}}đ</h6>
                        </div>

                        <div class="row d-flex justify-content-between px-4" id="cart-total">
                            <p class="mb-1 text-left">Tổng tiền sản phẩm: </p>
                            <h6 class="mb-1 text-right">{{$total}}đ</h6>
                        </div>
                        <button class="btn-block btn-blue">
                            <span>
                                <span id="checkout"><a href="{{asset('checkout')}}">Tiến hành đặt hàng</a> </span>
                                <span id="check-amt">{{$total}}đ</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>