@extends('admin.layout.admin_template')
@section('title','Danh sách sản phẩm')
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
                        <th>Tên Sản phẩm</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>     
                        <th>Hành động</th>             
                    </tr>
                </thead>
                <tbody>
                  @foreach($productlist as $product)
                    <tr>
                        <td>{{$product->prod_id}}</td>
                        <td><a href="{{asset('admin/product/edit/'.$product->prod_id)}}">{{$product->prod_name}}</a></td>
                        <td>{{number_format($product->prod_price,0,',','.')}} VND </td>
                        <td>
                          <img width="150px" src="{{asset('storage/avatar/'.$product->prod_img)}}" alt="">
                        </td>
                        <td>{{$product->cate_name}}</td>
                        <td>{{$product->brand_name}}</td>
                        <td>
                          <a href="{{asset('admin/product/delete/'.$product->prod_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá ?')" class="btn btn-danger"> 
                          <span class="glyphicon glyphicon-trash"></span> Xoá </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên Sản phẩm</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>     
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