@extends('admin.layout.admin_template')
@section('title','Thông tin đơn hàng')
@section('content')

<section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container123  col-md-6"   style="">
                            <h4></h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-md-4">Thông tin khách hàng</th>
                                    <th class="col-md-6"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Thông tin người đặt hàng</td>
                                    <td>{{$customerInfo->cust_name}}</td>
                                </tr>
                                <tr>
                                    <td>Ngày đặt hàng</td>
                                    <td>{{$customerInfo->date_order}}</td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>{{$customerInfo->cust_phone}}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>{{$customerInfo->address}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$customerInfo->cust_email}}</td>
                                </tr>
                                <tr>
                                    <td>Thanh toán</td>
                                    <td>
                                        @if($customerInfo->order_payment == 0)
                                            Tiền mặt
                                            @else Thanh toán Paypal

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ghi chú</td>
                                    <td>{{$customerInfo->notes}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting col-md-1" >STT</th>
                                <th class="sorting_asc col-md-4">Tên sản phẩm</th>
                                <th class="sorting col-md-2">Số lượng</th>
                                <th class="sorting col-md-2">Đơn giá</th>
                                <th class="sorting col-md-2">Thành tiền</th>
                            </thead>
                            <tbody>
                                @foreach($orderInfo as $key => $items)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$items->prod_name}}</td>
                                    <td>{{$items->quantily}}</td>
                                    <td>{{number_format($items->price,0,',','.')}} </td>
                                    <td>{{number_format($items->price*$items->quantily,0,',','.')}} VNĐ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><b>Tổng tiền</b></td>
                                <td></td>
                                <td colspan="1"><b class="text-red">{{number_format($customerInfo->total,0,',','.')}} VNĐ</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                <form action="{{asset('admin/order/edit/'.$customerInfo->id)}}" method="POST">
                    <input type="hidden" name="_method" value="">
                    {{ csrf_field() }}
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="form-inline">
                            <label>Trạng thái giao hàng: </label>
                            <select name="status" class="form-control input-inline" style="width: 200px">
                                <option value="1">Chưa giao</option>
                                <option value="2">Đang giao</option>
                                <option value="3">Đã giao</option>
                            </select>

                            <input type="submit" value="Xử lý" class="btn btn-primary">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection