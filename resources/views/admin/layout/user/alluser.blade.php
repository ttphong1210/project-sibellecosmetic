@extends('admin.layout.admin_template')
@section('title',' Danh sách người dùng')
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
    .input-checkbox{
        text-align: center;
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
                                <th>Tên user</th>
                                <th>Roles</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Author</th>
                                <th>Admin</th>
                                <th>User</th>
                                <th>Active</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1 ?>
                            @foreach($userlist as $user)
                            <tr>

                                <td><?php echo $stt++ ?></td>
                                <td>{{$user->name}}</td>
                                <td></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->password}}</td>
                                <td class="input-checkbox">
                                    <input type="checkbox" name="authorize" value="">
                                </td>
                                <td class="input-checkbox">
                                    <input type="checkbox" name="admin" value="">
                                </td>
                                <td class="input-checkbox">
                                    <input type="checkbox" name="user" value="">
                                </td>
                                <td>
                                    <button type="submit" name="btn-author">Trao quyền</button>
                                    <button type="submit" class="btn-delete-user">Xoá user</button>
                                    <button type="submit" class="btn-change-user">Đổi user</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên user</th>
                                <th>Roles</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Author</th>
                                <th>Admin</th>
                                <th>User</th>
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