@extends('admin.layout.admin_template')
@section('title','Trang chủ')
@section('content')
<style>
    .btn-delete-user {
        background-color: red;
        color: white;
        border: none;
        border-radius: 10px;
        margin: 5px 0;
        height: 30px;
    }

    .btn-change-user {
        background-color: #66FF00;
        color: black;
        border: none;
        border-radius: 10px;
        margin: 5px 0;
        height: 30px;
    }

    .input-checkbox {
        text-align: center;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('errors.note')

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection