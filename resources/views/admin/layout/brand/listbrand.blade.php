@extends('admin.layout.admin_template')
@section('title','Danh sách Thương hiệu')
@section('content')
<!-- Main content -->
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
                        <th>Tên Thương Hiệu</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($brandlist as $brand)
                    <tr>
                        <td>{{$brand->brand_id}}</td>
                        <td><a href="{{asset('admin/brand/edit/'.$brand->brand_id)}}">{{$brand->brand_name}}</a></td>
                        <td>
                          <a href="{{asset('admin/brand/delete/'.$brand->brand_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá ?')" class="btn btn-danger"> 
                          <span class="glyphicon glyphicon-trash"></span> Xoá </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên Thương Hiệu</th>
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