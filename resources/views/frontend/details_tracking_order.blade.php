@extends('layouts.app')
@section('title', 'Chi tiết đơn hàng của bạn')
@section('content')
<link rel="stylesheet" href="{{asset('css/trackingorder.css')}}">
<div class="container" style="padding: 20px">
    <h2>Thông tin đơn hàng</h2>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @else
    @endif
    @if($order)
    <div class="card mt-4">
        <div class="card-header">
            <h4>Mã đơn hàng: {{ $order->order_code }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Ngày đặt hàng:</strong> {{ $order->date_order }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} VND</p>
            <p><strong>Trạng thái:</strong>
                @if($order->order_status == 1) Chưa giao
                @elseif($order->order_status == 2) Đang giao
                @else Đã giao @endif
            </p>
            <p><strong>Phương thức thanh toán:</strong> {{ $order->order_payment }}</p>

            <h5 class="mt-3">Thông tin khách hàng</h5>
            <p><strong>Tên:</strong> {{ $order->customer->cust_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer->cust_email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->customer->cust_phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->customer->address }}</p>

            <h5 class="mt-3">Chi tiết sản phẩm</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->prod_name }}</td>
                        <td>{{ $detail->quantily }}</td>
                        <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                        <td>{{ number_format($detail->price * $detail->quantily, 0, ',', '.') }} VND</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            <b style="color: grey;">Tổng tiền:</b> <small>(Bao gồm phí ship)</small>
                        </td>
                        <td colspan="1" style="color: red">{{ number_format($order->total, 0, ',', '.') }} VND</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div
    @endsection