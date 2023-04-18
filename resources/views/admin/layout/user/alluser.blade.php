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

    .input-checkbox {
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
                            @include('errors.note')
                            @foreach($userlist as $user)
                            <form method="POST" action="{{asset('admin/user/assign-role')}}">
                                {{csrf_field()}}
                                
                                <tr>
                                    <td><?php echo $stt++ ?></td>
                                    <td>{{$user->name}}</td>
                                    <td></td>
                                    <td>{{$user->email}}
                                        <input type="hidden" name="email" value="{{$user->email}}">
                                    </td>
                                    <td>{{$user->password}}</td>
                                    <td class="input-checkbox">
                                        <input type="checkbox" name="author_role" {{ $user->hasRole('author') ? 'checked' : '' }}>
                                    </td>
                                    <td class="input-checkbox">
                                        <input type="checkbox" name="admin_role" {{ $user->hasRole('admin') ? 'checked' : '' }}>
                                    </td>
                                    <td class="input-checkbox">
                                        <input type="checkbox" name="user_role" {{ $user->hasRole('user') ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="submit" name="" value="Trao quyền">
                                        <a class="btn btn-sm btn-danger" href="{{asset('admin/user/delete-user/'.$user->id)}}">Xoá User</a>
                                       
                                    </td>
                                </tr>
                            </form>
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