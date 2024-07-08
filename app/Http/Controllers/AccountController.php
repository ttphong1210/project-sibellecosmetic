<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    //
    // public function getLoginCus()
    // {
    //     return view('frontend.login_customer');
    // }

    // public function postLoginCus(Request $request)
    // {
    //     $data = [
    //         'email' => $request->email,
    //         'password' => $request->password
    //     ];
    //     if (Auth::attempt($data)) {
    //         if (Auth::user()->level == 1) {
    //             return redirect('admin/home');
    //         } else {
    //             return redirect()->intended('/');
    //         }
    //     } else {
    //         return back()->withInput()->with('error', 'Emai or Password incorrect');
    //     }
    // }

    // public function getAddAcc()
    // {
    //     return view('frontend.register');
    // }

    // public function postAddAcc(Request $request)
    // {
    //     $users = new User();
    //     $users->name = $request->name;
    //     $users->email = $request->email;
    //     $users->password = bcrypt($request->pass);
    //     // $users->level = $request->level;

    //     $users->save();

    //     return redirect('/account/login_customer');
    // }

    // public function getLogOutCus()
    // {
    //     Auth::logout();
    //     return redirect('/');
    // }
    // public function getForgotPassword()
    // {
    //     return view('frontend.forgot_password');
    // }

    // public function postResetPassword(Request $request)
    // {
    //     $data = $request->all();
    //     $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-y');
    //     $title_send_mail = "Yêu cầu đặt lại mật khẩu Si.Belle Cosmetics" . '' . $now;
    //     $user_customer = User::where('email', '=', $data['email'])->get();
    //     foreach ($user_customer as $key => $value) {
    //         $user_customer_id = $value->id;
    //     }
    //     if (!empty($user_customer)) {
    //         $token_email = Str::random(10);
    //         $user_customer = User::find($user_customer_id);
    //         $user_customer->remember_token = $token_email;
    //         $user_customer->save();

    //         // send-link-reset-pass 
    //         //Dependency injection(Services / Repository) -> sql
    //         $send_to_mail = $data['email'];
    //         $link_reset_password = url('/account/update-new-password?email=' . $send_to_mail . '&token=' . $token_email);
    //         $data['name_send_mail'] = $title_send_mail;
    //         $data['body_send_mail'] = $link_reset_password;

    //         //services 
    //         Mail::send('frontend.mail_reset_password_notify', $data, function ($message) use ($send_to_mail, $title_send_mail) {
    //             $message->from('supportSi.BelleCosmetic@gmail.com', 'Si.Belle Cosmetics');
    //             $message->to($send_to_mail, $send_to_mail);
    //             $message->subject($title_send_mail);
    //         });
    //         return redirect()->back()->with('message', 'Vui lòng check mail để khôi phục mật khẩu !');
    //         // }
    //     }
    // }
    // public function getUpdateNewPassword(Request $request){
    //     return view('frontend.new_password');
    // }
    // public function postUpdateNewPassword(Request $request){
    //     $token_email_random = Str::random();
    //     $data = $request->all();
    //     $user_update_password = User::where('email', '=', $data['email'])
    //         ->where('remember_token', '=', $data['token'])
    //         ->get();
    //     $count_user = $user_update_password->count();
    //     if($count_user>0){
    //         foreach($user_update_password as $key =>$value){
    //             $user_id = $value->id;
    //         }
    //         $update_user_pass = User::find($user_id);
    //         $update_user_pass->password = bcrypt($data['password']);
    //         $update_user_pass->remember_token = $token_email_random;
    //         $update_user_pass->save();
    //         return redirect('account/login_customer')->with('message', 'Đặt lại mật khẩu thành công !');
    //     }else{
    //         return redirect('account/forgot_password')->with('error','Link đã hết hạn, vui lòng nhập lại email !');
    //     }
    // }

    public function getRegisterAuth(){
        return view('admin.register_auth');
    }
    public function postRegisterAuth(Request $request ){
        $this->validation($request);
        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']) ;
        $user->save();
        return redirect('/register-auth')->with('message','Đăng ký thành công !');

    }
    public function validation($request){
        return $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);
    }
    public function getLoginAuth(){
        return view('admin.login_auth');
    }
    public function postLoginAuth(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::attempt($data)){
             return redirect('/admin/home');
        }else{
             return redirect('/login-auth')->with('error','Lỗi đăng nhập');
        }
    }
    public function getLogOutAuth(){
        Auth::logout();
        return redirect('/login-auth')->with('message','Đăng xuất thành công !');
    }
}
