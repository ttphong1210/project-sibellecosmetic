@extends('admin.layout.admin_template')
@section('title','Thêm Blog Post')
@section('content')
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <form role="form" method="post" action="" enctype="multipart/form-data">
            @include('errors.note')
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputName">Tiêu đề Blog :</label>
                    <input type="text" class="form-control" required name="title" value="{{old('title')}}" placeholder="Tiêu đề Blog...">
                </div>
                <div class="form-group">
                    <label for="">Tóm tắt</label>
                    <textarea class="ckeditor" name="summary"></textarea>
                </div>
                <div class="form-group">
                    <label>Miêu tả</label>
                    <textarea class="ckeditor" required name="description" value="{{old('description')}}"></textarea>
                    <script>
                        CKEDITOR.replace('description', {
                            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
                            filebrowserImageBrowseUrl: "{{ asset('editor/ckfinder/ckfinder.html?type=Images') }}",
                            filebrowserFlashBrowseUrl: "{{ asset('editor/ckfinder/ckfinder.html?type=Flash') }}",
                            filebrowserUploadUrl: "{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                            filebrowserImageUploadUrl: "{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
                            filebrowserFlashUploadUrl: "{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
                        });
                    </script>
                </div>
                <div class="form-group">
                    <label>Ảnh nổi bật</label>
                    <input required id="exampleInputFile" type="file" name="featured_image" accept="image/*" onchange="fileUpload(event)" value="{{old('featured_image')}}">
                    <img id="previewImage" src="" alt="" width="150px" style="margin-top:10px ;">
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <!-- Tác giả -->
                        <div class="form-group">
                            <label for="author_id">Tác giả</label>
                            <select class="form-control" id="author_id" name="author_id">
                                <!-- Danh sách tác giả từ database -->
                                @foreach ($list_user as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Ngày xuất bản -->
                        <div class="form-group">
                            <label for="published_at">Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{old('published_at')}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Trạng thái -->
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select required class="form-control" id="status" name="status">
                                <option value="draft">Nháp</option>
                                <option value="published">Xuất bản</option>
                                <option value="archived">Lưu trữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!--Gắn Thẻ -->
                        <div class="form-group">
                            <label for="tag">Gắn thẻ</label>
                            <input type="text" class="form-control" id="tag" name="tag" value="{{old('tag')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Meta Title -->
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Meta Keywords -->
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords">
                        </div>
                    </div>
                </div>
                <!-- Meta Description -->
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                {{csrf_field()}}
        </form>
    </div>
</section>
@endsection