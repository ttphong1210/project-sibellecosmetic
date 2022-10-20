<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountCustomerController extends Controller
{
    //
    public function getLoginCus(){
        return view('frontend.login_customer');
    }

    public function postLoginCus(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($data)){
            if(Auth::user()->level == 1){
                return redirect('admin/home');
            }else{
                return redirect()->intended('/');
            }          
        }else{
            return back()->withInput()->with('error','Emai or Password incorrect');
        }
    }

    public function getAddAcc(){
        return view('frontend.register');
    }

    public function postAddAcc(Request $request){
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->pass);
        $users->level = $request->level;

        $users->save();

         return redirect('/');
    }

    public function getLogOutCus(){
        Auth::logout();
        return redirect('/');
    }
}
