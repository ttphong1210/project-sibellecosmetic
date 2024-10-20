@extends('admin.layout.admin_template')
@section('title','Thêm sản phẩm')
@section('content')
<section class="content">
    <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"></h3>
                </div>
                <form role="form" method="post" action="#" enctype="multipart/form-data">
                    @include('errors.note')
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputName">Tên sản phẩm :</label>
                        <input type="text" class="form-control" required name="name" placeholder="Tên sản phẩm...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPrice">Giá :</label>
                        <input type="number" class="form-control" required name="price" min="0" placeholder="Giá...">
                    </div>
                    <div class="form-group" >
						<label>Ảnh sản phẩm</label>
						<input required id="exampleInputFile" type="file" name="img" accept="image/*" onchange="fileUpload(event)">
					    <img id="previewImage" src="" alt="" width="150px" style="margin-top:10px ;">
					</div>
                    <div class="form-group" >
						<label>Thư viện ảnh sản phẩm</label>
						<input id="exampleInputFileGallery" type="file" name="image-gallery[]" multiple accept="image/*" onchange="loadFileGallery(event)">
					   <img src="" alt="">
                       <div id="preview">
                            <!-- <img id="fileImageGallery" src="" alt="" width="150px"> -->
                       </div>
					</div>
                    <div class="form-group">
                        <label> Trạng thái </label>
                        <select required name="status" class="form-control">
                            <option value="0">Còn hàng</option>
                            <option value="1">Hết hàng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tóm tắt</label>
                        <textarea class="ckeditor" required name="summary"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Miêu tả</label>
                        <textarea class="ckeditor" required name="description"></textarea>
                        <script>
                                CKEDITOR.replace('description', {
                                    filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
                                    filebrowserImageBrowseUrl: "{{ asset('editor/ckfinder/ckfinder.html?type=Images') }}",
                                    filebrowserFlashBrowseUrl: "{{ asset('editor/ckfinder/ckfinder.html?type=Flash') }}",
                                    filebrowserUploadUrl: "{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                                    filebrowserImageUploadUrl: "{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
                                    filebrowserFlashUploadUrl: "{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
                                });
                                // CKFinder.setupCKEditor();

                        </script>
                    </div>
                    <div class="form-group">
                        <label for="">Khuyến mãi</label>
                        <input type="text" required name="promotion" class="form-control" placeholder="Giá gốc..." value="">
                    </div>
                    <div class="form-group">
                        <label>Danh mục </label>
                        <select class="form-control" name="cate" style="width: 100%;">
                        @foreach($catelist as $cate)
                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thương hiệu </label>
                        <select class="form-control" name="brand" style="width: 100%;">
                        @foreach($brandlist as $brand)
                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                         <label for="">Sản phẩm nổi bật</label><br>
                         Có: <input type="radio" name="featured" value="1">
                         Không: <input type="radio" checked name="featured" value="0">
                    </div>
                </div>
                

                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              {{csrf_field()}}
                </form>
            </div>
    </section>
@endsection