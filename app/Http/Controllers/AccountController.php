<?php

namespace App\Http\Controllers;

use App\Repositories\Admin\Interfaces\AccountAdminRepositoryInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    protected $accountAdminRepository;
    public function __construct(AccountAdminRepositoryInterface $accountAdminRepository)
    {
        $this->accountAdminRepository = $accountAdminRepository;
    }
    public function getRegisterAuth()
    {
        return view('admin.register_auth');
    }
    public function postRegisterAuth(Request $request)
    {
        $this->validation($request);
        $data = $request->all();
        $this->accountAdminRepository->createNewAccount($data);
        return redirect('/register-auth')->with('message', 'Đăng ký thành công !');
    }
    public function validation(Request $request)
    {
        return $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);
    }
    public function getForgotPassword()
    {
        return view('admin.forgot_password');
    }
    public function postResetPassword(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-y');
        $title_send_mail = "Yêu cầu đặt lại mật khẩu Si.Belle Cosmetics " . '' . $now;
        $accountAdmin = $this->accountAdminRepository->findByEmail($data['email']);
        if ($accountAdmin->isNotEmpty()) {
            $accountAdmin_id = $accountAdmin->first()->id;
            $forgot_token_email = Str::random(10);
            $this->accountAdminRepository->updateForgotToken($accountAdmin_id, $forgot_token_email);
            $to_mail = $request->email;
            $url_reset_password = url('/update-password-auth?email=' . $to_mail . '&token=' . $forgot_token_email);
            $data['body_send_mail'] = $url_reset_password;
            Mail::send('frontend.mail_reset_password_notify', $data, function ($message) use ($to_mail, $title_send_mail) {
                $message->to($to_mail, $to_mail);
                $message->subject($title_send_mail);
            });
            return redirect()->back()->with('message', 'Vui lòng check mail để khôi phục mật khẩu!');
        }
        return redirect()->back()->with('error', 'Email không tồn tại!');
    }
    public function getUpdateNewPassword(){
        return view('admin.new_password');
    }
    public function postUpdateNewPassword(Request $request){
        $tokenEmailRandom = Str::random();
        $data = $request->all();
        $accountUpdatePassword = $this->accountAdminRepository->findByEmailAndToken($data['email'], $data['token']);
        $countAccount = $accountUpdatePassword->count();
        if($countAccount > 0){
            $accountAdminId = $accountUpdatePassword->first()->id;
            $isUpdate = $this->accountAdminRepository->updatePassword($accountAdminId, $tokenEmailRandom, $data['password']);
            if($isUpdate){
                return redirect('login-auth')->with('message', 'Đặt lại mật khẩu thành công !');
            }else{
                return redirect('forgot-password-auth')->with('error', 'Có lỗi xảy ra khi đặt lại mật khẩu!');
            }
        }else{
            return redirect('forgot-password-auth')->with('error', 'Link đã hết hạn, vui lòng nhập lại email!');
        }
    }
    public function getLoginAuth()
    {
        return view('admin.login_auth');
    }
    public function postLoginAuth(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            return redirect('/admin/home');
        } else {
            return redirect('/login-auth')->with('error', 'Lỗi đăng nhập');
        }
    }
    public function getLogOutAuth()
    {
        Auth::logout();
        return redirect('/login-auth')->with('message', 'Đăng xuất thành công !');
    }
}
