<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHome(){
        return view('admin.layout.home_admin');
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->intended('login-auth');
    }

   
}
