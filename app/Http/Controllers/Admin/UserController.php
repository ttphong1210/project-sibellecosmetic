<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //
    public function getAllUser(){
        $data['userlist'] = User::all();
        // dd($data);
        return view('admin.layout.user.alluser',$data);
    }
}
