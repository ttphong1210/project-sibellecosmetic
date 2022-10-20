@extends('admin.layout.admin_template')
@section('title','Sửa sản phẩm')
@section('content')
    <div class="form-group">
        <label for=""> Miêu tả sản phẩm</label>
        <textarea name="des" class="ckeditor"> Miêu tả sản phẩm ở đây </textarea>
    </div>
@endsection