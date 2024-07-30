<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function getAllUser()
    {
        $data['userlist'] = User::with('roles')->orderBy('id', 'DESC')->paginate(5);

        return view('admin.layout.user.alluser', $data);
    }
    public function postAssignRole(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->roles()->detach();
        if ($request->author_role) {
            $user->roles()->attach(Roles::where('name', 'author')->first());
        }
        if ($request->admin_role) {
            $user->roles()->attach(Roles::where('name', 'admin')->first());
        }
        if ($request->user_role) {
            $user->roles()->attach(Roles::where('name', 'user')->first());
        }
        return redirect()->back();
    }
    public function getDeleteUser($id)
    {
        if (Auth::user()->id == $id) {
            return back()->with('error', 'Không được xoá chính bạn !');
        } else {
            $user = User::find($id);
            if($user){
                $user->roles()->detach();
                $user->delete();
            }
            return back()->with('message','Xoá thành công !');
        }
    }
}
