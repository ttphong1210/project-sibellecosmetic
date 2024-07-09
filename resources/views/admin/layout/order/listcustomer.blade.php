@extends('admin.layout.admin_template')
@section('title','Danh sách khách hàng')
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
                                <th>Ngày đặt hàng</th>
                                <th>Email</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                           @foreach($customer as $key => $item)
                           @php $i++ @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><a href="{{asset('admin/order/edit/'.$item->cust_id)}}">{{$item->cust_name}}</a></td>
                                <td>{{$item->address}} </td>
                                <td> {{$item->created_at}}</td>
                                <td>{{$item->cust_email}}</td>
                                <td>
                                    <a href="{{asset('admin/order/customer/delete-customer/'.$item->cust_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá ?')" class="btn btn-danger">
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
                                <th>Ngày đặt hàng</th>
                                <th>Email</th>
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