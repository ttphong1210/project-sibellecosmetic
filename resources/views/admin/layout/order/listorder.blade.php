@extends('admin.layout.admin_template')
@section('title','Danh sách đơn hàng')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên người order</th>
                                <th>Địa chỉ</th>
                                <th>Mã ĐH</th>
                                <th>Ngày đặt hàng</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                           @foreach($order as $key => $item)
                           @php $i++ @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->cust_name}}</td>
                                <td>{{$item->address}} </td>
                                <td><a href="{{asset('admin/order/edit/'.$item->cust_id)}}">{{$item->order_code}}</a> </td>
                                <td> {{$item->created_at}}</td>
                                <td>{{$item->cust_email}}</td>
                                <td>
                                    @if($item->order_status==1)
                                        Chưa giao
                                     @elseif($item->order_status==2)
                                        Đang giao
                                    @else 
                                        Đã giao
                                    @endif
                                </td>
                                <td>
                                    <a href="{{asset('admin/order/delete-order/'.$item->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá ?')" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span> Xoá </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên người order</th>
                                <th>Địa chỉ</th>
                                <th>Mã ĐH</th>
                                <th>Ngày đặt hàng</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

@endsection