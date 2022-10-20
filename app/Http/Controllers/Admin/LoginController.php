<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
    // khai báo sử dụng loginRequest
// use App\Http\Requests\LoginRequest;
// use Auth;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getLogin(){
        return view('admin.login');     
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($login)) {
            return redirect()->intended('admin/home');
            
        } else {
            // return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
            return back()->withInput()->with('error','Emai or Password incorrect');
        };
    }
    

}
