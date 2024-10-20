@extends('admin.layout.admin_template')
@section('title','Sửa sản phẩm')
@section('content')
<section class="content">
    <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="#" enctype="multipart/form-data">
                    @include('errors.note')
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputName">Tên sản phẩm :</label>
                        <input type="text" class="form-control" required name="name" placeholder="Tên sản phẩm..." value="{{$product->prod_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPrice">Giá :</label>
                        <input type="number" class="form-control"required name="price" placeholder="Giá..." min="0" value="{{$product->prod_price}}">
                    </div>
                    <div class="form-group" >
						<label>Ảnh sản phẩm</label>
						<input id="exampleInputFile" type="file" name="image" accept="image/*" onchange="fileUpload(event)">
					   <img id="previewImage" src="{{asset('storage/avatar/'.$product->prod_img)}}" width="150px" alt="">
					</div>
                    <div class="form-group" >
						<label>Thư viện ảnh sản phẩm</label>
						<input id="exampleInputFileGallery" type="file" name="image-gallery[]" multiple accept="image/*" onchange="loadFileGallery(event)">
                        <?php
                            $image = explode('|', $product->prod_gallery)
                        ?>
                        @foreach($image as $file)
                            <img src="{{asset('storage/gallery/'.$file)}}" alt="" width="100" style="margin-right: 10px; margin-top:10px;">
                        @endforeach
                       <div id="preview">
                            <!-- <img id="fileImageGallery" src="" alt="" width="150px"> -->
                       </div>
					</div>
                    <div class="form-group">
                        <label> Trạng thái </label>
                        <select required name="status" class="form-control">
                            <option value="0" @if($product->prod_status == 0) selected @endif >Còn hàng</option>
                            <option value="1" @if($product->prod_status == 1) selected @endif >Hết hàng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tóm tắt</label>
                        <textarea class="ckeditor" name="edit_summary">{{$product->prod_summary}}</textarea>
                    </div>
                     <div class="form-group">
                        <label>Miêu tả</label>
                        <textarea class="ckeditor" required name="edit_description" >{{$product->prod_des}}</textarea>
                        <script>
                            CKEDITOR.replace( 'edit_description', {
                                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Images') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                                filebrowserImageUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                                filebrowserFlashUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                            });
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="">Khuyến mãi</label>
                        <input type="text" required name="promotion" class="form-control" value="{{$product->prod_promotion}}">
                    </div>
                    <div class="form-group">
                        <label>Danh mục </label>
                        <select class="form-control" name="cate" style="width: 100%;">
                            @foreach($listcate as $cate)
                            <option value="{{$cate->cate_id}}" @if($product->prod_cate == $cate->cate_id) selected @endif >{{$cate->cate_name}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thương hiệu: </label>
                        <select class="form-control" name="brand" style="width: 100%;">
                            @foreach($listbrand as $brand)
                            <option value="{{$brand->brand_id}}" @if($product->prod_brand == $brand->brand_id) selected @endif >{{$brand->brand_name}}</option>
                           @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                         <label for="">Sản phẩm nổi bật</label><br>
                         Có: <input type="radio"  name="featured" value="1" @if($product->prod_featured == 1) selected @endif  >
                         Không: <input type="radio" checked name="featured" value="0" @if($product->prod_featured == 0) selected @endif  >
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                </div>
              {{csrf_field()}}
                </form>
            </div>
    </section>

@endsection
