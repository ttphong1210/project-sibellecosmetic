<?php

namespace App\Http\Controllers\Api\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthControllerApi extends Controller
{
    public function actionLoginAuth(Request $request){
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login Successful',
                'user' => Auth::user(),
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401  );
        }
    }
    public function actionLogOutAuth(){
        Auth::logout();
        return response()->json([
            'message' => 'LogOut Success!',
        ]);
    }
}
