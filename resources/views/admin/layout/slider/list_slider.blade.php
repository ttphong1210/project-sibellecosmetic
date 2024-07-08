@extends('admin.layout.admin_template')
@section('title','Danh sách hình ảnh')
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
                        <th>Hình ảnh</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $stt = 1 ?>
                @foreach($listSlider as $slider)
                    <tr>
                        <td> <?php echo $stt++ ?></td>
                        <td>{{$slider->title}}</td>
                        <td><img width="200px" src="{{asset('storage/slider/'.$slider->image)}}" alt=""></td>
                    </tr>
                    @endforeach
                </tbody>
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