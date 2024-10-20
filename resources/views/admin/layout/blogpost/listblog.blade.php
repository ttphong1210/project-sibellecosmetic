@extends('admin.layout.admin_template')
@section('title','Danh sách Blog Post')
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
                                <th>Tiêu đề</th>
                                <th>Tóm tắt</th>
                                <th> Hình ảnh</th>
                                <th>Tác giả</th>
                                <th>Trạng thái</th>
                                <th>Lượt xem</th>
                                <th>Bình luận</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                             $stt = 1;
                            @endphp
                            @foreach ($bloglist as $item )
                                <tr>
                                    <td>@php echo $stt++ @endphp </td>
                                    <td> <a href="{{url('admin/blog/edit-blog/'.$item->id)}}" style="color: black;">{{$item->title}}</a> </td>
                                    <td style="width:30%;"> {!!$item->summary!!} </td>
                                    <td>
                                        <img width="150px" src="{{asset('storage/featured-img-blog/'.$item->featured_image)}}" alt="">
                                    </td>
                                    <td> {{$item->author->name}} </td>
                                    <td> {{$item->status}} </td>
                                    <td> {{$item->view_count}} </td>


                                </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Tóm tắt</th>
                                <th> Hình ảnh</th>
                                <th>Tác giả</th>
                                <th>Trạng thái</th>
                                <th>Lượt xem</th>
                                <th>Bình luận</th>
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