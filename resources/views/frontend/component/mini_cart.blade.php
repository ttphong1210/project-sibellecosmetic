<a href="{{asset('cart/show')}}" class="icons" style="padding-right:10px;">
    <i class="ti-shopping-cart"></i>
    <span class="button-cart-total-item">{{Cart::count()}}</span>
</a>
<ul class="submenu-dropdown submenu-dropdown-list list-submenu-cart">
    <li class="nav-item" style="padding: 10px 15px;">
        <div class="minicart-header d-flex">
            <h5> Giỏ hàng</h5>
            <span>{{Cart::count()}} sản phẩm</span>
        </div>
        <table>
            <tbody>
                @foreach(Cart::content() as $item)
                <tr class="items-minicart">
                    <td style="width: 30%;">
                        <img width="100%" src="{{asset('storage/avatar/'.$item->options->img)}}">
                    </td>
                    <td class="name-cart minicart">{{$item->name}}</td>
                    <td class="qty-cart minicart">{{$item->qty}}x</td>
                    <td class="price-cart minicart">{{number_format($item->price,0,',','.')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="minicart-total">
            <div class="row">
                <div class="col-md-6">
                    Tạm tính:
                </div>
                <div class="col-md-6 text-right">{{Cart::subtotal(0,',','.')}} VND</div>
            </div>
        </div>
        <div class="minicart-button d-flex">
            <div class="col-md-6">
                <button class="link-to-cart"><a href="{{asset('cart/show')}}">Xem giỏ hàng</a></button>
            </div>
            @if(Cart::count() > 0)
            <div class="col-md-6">
                <button class="link-to-checkout"><a href="{{asset('checkout')}}">Thanh toán</a></button>
            </div>
            @else
            <div class="col-md-6">
                <button class="link-to-checkout"><a href="{{asset('product')}}">Thanh toán</a></button>
            </div>
            @endif

        </div>
    </li>
</ul>