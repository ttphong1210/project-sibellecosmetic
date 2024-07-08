@extends('admin.layout.admin_template')
@section('title','Thêm ảnh Banner')
@section('content')
<section class="content">
    <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"></h3>
                </div>
                <form role="form" method="post" action="{{asset('admin/slider/add-slider')}}" enctype="multipart/form-data">
                    @include('errors.note')
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputName">Title :</label>
                        <input type="text" class="form-control" required name="title" placeholder="Tiêu đề banner...">
                    </div>
                    <div class="form-group" >
						<label>Photo</label>
						<input required id="exampleInputFile" type="file" name="img" accept="image/*" onchange="fileUpload(event)">
					    <img id="previewImage" src="" alt="" width="450px" style="margin-top:10px ;">
					</div>
                    <div class="form-group">
                        <label> Trạng thái </label>
                        <select required name="status" class="form-control">
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn </option>
                        </select>
                    </div>
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              {{csrf_field()}}
                </form>
            </div>
    </section>
@endsection