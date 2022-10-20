@extends('admin.layout.admin_template')
@section('title', 'Danh sách danh mục')
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
                        <th>Tên Danh Mục</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($catelist as $cate)
                    <tr>
                        <td>{{$cate->cate_id}}</td>
                        <td><a href="{{asset('admin/category/edit/'.$cate->cate_id)}}">{{$cate->cate_name}}</a></td>
                        <td>
                          <a href="{{asset('admin/category/delete/'.$cate->cate_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá ?')" class="btn btn-danger"> 
                          <span class="glyphicon glyphicon-trash"></span> Xoá </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên Danh Mục</th>
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