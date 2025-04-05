@extends('admin.layout.admin_template')
@section('title','Danh sách sản phẩm')
@section('content')
<style>
  .dataTables_length label{
    display: flex;
    align-items: center;
    justify-content: start;
  }
  .dataTables_length select{
    border-radius: 5px;
    margin: 3px;
    width: 12%;
  }
  .dataTables_filter {
    margin: 5px;
  }
  .dataTables_filter label{
    display: flex;
    align-items: center;
    justify-content: end;
  }
  .dataTables_filter input[type="search"] {
    margin-left: .5rem !important;
    width: 30%;
    border-radius: 5px;
  }
  .dataTables_filter input[type="search"]:focus {
    color: #6e707e;
    background-color: #fff;
    border-color: #bac8f3;
    outline: none;
    box-shadow: -2px 3px 2px 0.2rem rgba(78, 115, 223, .25);
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="dataTables_length">
                <label>Hiển thị <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select> mục</label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div id="dataTable_filter" class="dataTables_filter">
                <label>Tìm kiếm:<input type="search" id="dataInputSearch" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
            </div>
          </div>
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
            <tbody id="productList">
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
          <div class="pagination">
            {{ $productlist->links() }}
        </div>

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