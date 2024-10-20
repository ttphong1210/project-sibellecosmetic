@foreach($items as $item)
<div class="row d-flex justify-content-center">
    <table class="cart-product-item-table">
        <tbody>
            <tr>
                <td class="tablesheet-col1">
                    <div class="book">
                        <img src="{{asset('storage/avatar/'.$item->options->img)}}" class="book-img">
                    </div>
                </td>
                <td class="tablesheet-col2">
                    <div class="my-auto flex-column d-flex pad-left">
                        <div class="products-description-name">
                            <h6 class="mob-text">{{$item->name}}</h6>
                        </div>
                        <div class="products-description-price">
                            <p class="mob-text">{{number_format($item->price,0,',','.')}} VND</p>
                        </div>
                        <div class="products-description-subprice">
                            <p class="mob-text">Thành tiền: {{number_format($item->price*$item->qty,0,',','.')}} VND</p>
                        </div>
                        <div class="delete-item-cart btn-delete" data-id="{{$item->rowId}}" data-url="{{url('cart/delete/'.$item->rowId)}}">
                            <a class="highlight">
                                <svg width="18px" height="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                </svg> Xóa
                            </a>
                        </div>
                    </div>
                </td>
                <td class="tablesheet-col3">
                    <div class="quantity-input">
                        <button class="minus-btn" type="button" data-id="{{$item->rowId}}" data-url="{{url('cart/update')}}">-</button>
                        <input type="text" id="number-quantity-{{$item->rowId}}" value="{{$item->qty}}" min="1" maxlength="2" readonly="readonly">
                        <button class="plus-btn" type="button" data-id="{{$item->rowId}}" data-url="{{url('cart/update')}}">+</button>
                    </div>
                </td>
                <td class="tablesheet-col4">
                    <div class="btn-delete" data-id="{{$item->rowId}}" data-url="{{url('cart/delete/'.$item->rowId)}}">
                        <a class="highlight">
                            <svg width="18px" height="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                            </svg>
                        </a>
                        <!-- <span><a class="delete-item-cart" href="{{asset('cart/delete/'.$item->rowId)}}"> Xoá </a></span> -->
                    </div>
                </td>

            </tr>
        </tbody>
    </table>
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