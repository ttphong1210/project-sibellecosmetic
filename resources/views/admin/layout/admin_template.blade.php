<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | SE.BELLE Comestic</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="{{asset('img/logo-cosmetic.png')}}" type="image/png" />
  <link rel="stylesheet" href="{{asset('vendor/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('vendor/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('vendor/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('vendor/dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('vendor/dist/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('css/sb-admin-2.min.css')}}"> -->

  <script type="text/javascript" src="{{asset('editor/ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript" src="{{asset('editor/ckfinder/ckfinder.js')}}"></script>

  <!-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> -->
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{asset('js/admin-script.js')}}"></script>

  <script>
    var description = CKEDITOR.replace('description');
    CKFinder.setupCKEditor(description);
    var edit_description = CKEDITOR.replace('edit_description');
    CKFinder.setupCKEditor(edit_description);
  </script>

  <script>
    $(document).ready(function() {
      $('.add_delivery').click(function() {
        var city = $('.city').val();
        var district = $('.district').val();
        var ward = $('.ward').val();
        var feeship = $('.fee_ship').val();
        var _token = $('input[name = "_token"]').val();

        $.ajax({
          url: "/admin/delivery/add-delivery",
          method: 'POST',
          data: {
            city: city,
            district: district,
            _token: _token,
            ward: ward,
            feeship: feeship
          },
          success: function(data) {
            alert('Thêm phí vận chuyển thành công');
            location.reload();
          }
        })
      });

      $(document).on('blur', '.feeship_edit', function() {

        var feeship_id = $(this).data('feeship_id');
        var fee_value = $(this).text();
        var _token = $('input[name = "_token"]').val();

        $.ajax({
          url: "/admin/delivery/update-delivery",
          method: "POST",
          data: {
            feeship_id: feeship_id,
            fee_value: fee_value,
            _token: _token
          },
          success: function(data) {
            alert('Sửa phí ship thành công');
            location.reload();
          }
        });
      });

      $('.choose').on('change', (function() {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name = "_token"]').val();
        var result = '';

        if (action == 'city') {
          result = 'district';
        } else {
          result = 'ward';
        }
        $.ajax({
          url: "/admin/delivery/select-delivery",
          method: 'POST',
          data: {
            action: action,
            ma_id: ma_id,
            _token: _token
          },
          success: function(data) {
            $('#' + result).html(data);
          }
        })
      }));
    })
  </script>
  <script type="text/javascript">
    function fileUpload(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('previewImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
  </script>
  <script type="text/javascript">
    function loadFileGallery(event) {
      var input = document.getElementById('exampleInputFileGallery');
      var inputLe = input.files.length;
      for (i = 0; i <= inputLe; i++) {
        var urls = URL.createObjectURL(input.files[i]);
        document.getElementById('preview').innerHTML += '<img src="' + urls + '"style="width: 150px; margin:0px 5px;">';
      }
    }
  </script>
  <script type="text/javascript">

    function togglePasswordVisibility() {
            const passwordInput = document.getElementById("exampleInputPassword");
            const passwordIcon = document.getElementById("passwordIcon");
        
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove("fa-eye");
                passwordIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove("fa-eye-slash");
                passwordIcon.classList.add("fa-eye");
            }
        }
  </script>
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="{{url('admin/home')}}" class="logo">
          <!-- <img src="{{asset('img/Si.belle.jpeg')}}" alt="SI BELLE" width=""> -->
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">SI BELLE</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                  <!-- inner menu: contains the messages -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="{{asset('vendor/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <!-- The message -->
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                  <!-- /.menu -->
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li><!-- start notification -->
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    <li><!-- Task item -->
                      <a href="#">
                        <!-- Task title and progress text -->
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>
                <li class="footer">
                  <a href="#">View all tasks</a>
                </li>
              </ul>
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{asset('vendor/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{Auth::user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{asset('vendor/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                  <p>
                    {{ Auth::user()->name}}
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{url('admin/profile-user')}}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{asset('logout-auth')}}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{asset('vendor/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{Auth::user()->email}}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">HEADER</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active"><a href="{{asset('admin/home')}}"><i class="fa fa-link"></i> <span>Trang Chủ</span></a></li>

          @hasrole(['admin','author'])
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Tài khoản</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/user/all-user')}}">Tất cả tài khoản</a></li>
            </ul>
          </li>
          @endhasrole
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Sản Phẩm</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/product')}}">Tất cả sản phẩm</a></li>
              <li><a href="{{asset('admin/product/add')}}">Thêm sản phẩm</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Danh Mục</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/category')}}">Tất cả danh mục</a></li>
              <li><a href="{{asset('admin/category/add')}}">Thêm danh mục</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Thương Hiệu</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/brand')}}">Tất cả thương hiệu</a></li>
              <li><a href="{{asset('admin/brand/add')}}">Thêm thương hiệu</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Quản lý Đơn hàng</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/order')}}">Tất cả đơn hàng</a></li>
              <li><a href="{{asset('admin/order/customer')}}">Danh sách khách hàng order</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Phí vận chuyển</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/delivery')}}">Thông tin phí vận chuyển</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Banner</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/slider')}}">Tất cả slider</a></li>
              <li><a href="{{asset('admin/slider/add-slider')}}">Thêm slider</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Blog</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('admin/blog')}}">Tất cả Blog</a></li>
              <li><a href="{{asset('admin/blog/add-blog')}}">Thêm Blog</a></li>
            </ul>
          </li>
          </h1>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('title')
          <!-- <small>Optional description</small> -->
        </h1>

      </section>

      @yield('content')

    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <!-- <div class="pull-right hidden-xs">
        Anything you want
      </div> -->
      <!-- Default to the left -->
      <!-- <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved. -->
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>

    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="{{asset('vendor/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('vendor/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('vendor/dist/js/adminlte.min.js')}}"></script>

</body>

</html>