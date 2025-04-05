@extends('admin.layout.admin_template')
@section('title','Danh sách hình ảnh')
@section('content')
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
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
                <th>Trang thái</th>
              </tr>
            </thead>
            <tbody>
              <?php $stt = 1 ?>
              @foreach($listSlider as $slider)
              <tr>
                <td> <?php echo $stt++ ?></td>
                <td>{{$slider->title}}</td>
                <td><img width="200px" src="{{asset('storage/slider/'.$slider->image)}}" alt=""></td>
                <td class="slider-status-change">
                  <div class="form-check form-switch">
                    <label class="switch">
                      <input type="checkbox" class="toggle-status" data-id="{{$slider->id}}" {{$slider->status ? 'checked' : ''}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </td>
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