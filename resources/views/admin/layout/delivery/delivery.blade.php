@extends('admin.layout.admin_template')
@section('title','Thông tin phí vận chuyển')
@section('content')
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="" enctype="multipart/form-data">
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
                <div class="form-group">
                    <input type="" class="form-control fee_ship" required name="fee_ship" min="0" placeholder="Phí vận chuyển...">
                </div>
                <div class="box-footer">
                    <button type="button" data-token="{{ csrf_token() }}" name="add_delivery" class="btn btn-primary add_delivery">Thêm phí vận chuyển</button>
                </div>
                {{csrf_field()}}
        </form>
    </div>
</section>
<section id="load-delivery" class="content">
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
                                <th>Tên Tỉnh/Thành phố</th>
                                <th>Tên Quận/Huyện</th>
                                <th>Tên Phường/Xã</th>
                                <th>Phí vận chuyển</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($infoFeeship as $key => $item)
                            <tr>
                                <td>{{$item->name_city}}</td>
                                <td>{{$item->name_district}}</td>
                                <td>{{$item->name_ward}}</td>
                                <td contenteditable="" class="feeship_edit" data-feeship_id="{{$item->fee_id}}">{{number_format($item->fee_feeship,0,',','.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
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
<!-- /.content -->
@endsection