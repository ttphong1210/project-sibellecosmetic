@extends('admin.layout.admin_template')
@section('title','Sửa Thương Hiệu Sản Phẩm')
@section('content')

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
                @include('errors.note')
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên thương hiệu:</label>
                  <input required type="text" name="name" class="form-control"  placeholder="Tên thương hiệu..." value="{{$brand->brand_name}}">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
              </div>
              <div class="box-footer">
                <button class="btn btn-primary"><a href="{{asset('admin/brand')}}"> Huỷ bỏ</a></button>
              </div>
              {{csrf_field()}}
            </form>
          </div>
    </section>
    <!-- /.content -->
@endsection