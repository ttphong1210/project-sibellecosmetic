<?php

namespace App\Http\Controllers;

use App\Models\AccountCustomer;
use App\Repositories\AccountCustomer\AccountCustomerRepository;
use App\Repositories\AccountCustomer\AccountCustomerRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountCustomerController extends Controller
{
    use Authenticatable;
    public $accountCustomerRepository;
    public function __construct(AccountCustomerRepository $accountCustomerRepository)
    {
        $this->accountCustomerRepository = $accountCustomerRepository;
    }

    public function getLoginCustomer()
    {
        return view('frontend.login_customer');
    }
    public function postLoginCustomer(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('account_customer')->attempt($data)) {
            return redirect('/');
        } else {
            return redirect()->back()->with('error', 'Username hoặc Password không đúng');
        }
        // $this->accountCustomerRepository->postLoginCustomer($request->all());
    }
    public function getRegisterCustomer()
    {
        return view('frontend.register');
    }
    public function postRegisterCustomer(Request $request)
    {
        $data = $request->all();
        $this->accountCustomerRepository->postRegisterCustomer($data);

        return redirect()->back()->with('message', 'Đăng ký tài khoản thành công !');
    }

    public function getForgotPassword()
    {
        return view('frontend.forgot_password');
    }
    public function postResetPassword(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-y');
        $title_send_mail = "Yêu cầu đặt lại mật khẩu Si.Belle Cosmetics " . '' . $now;
        $account_customer = $this->accountCustomerRepository->findByEmail($data['email']);

        //check mail exist
        if ($account_customer->isNotEmpty()) {
            $account_customer_id = $account_customer->first()->id;
            $forgot_token_email = Str::random(10);
            $this->accountCustomerRepository->updateForgotToken($account_customer_id, $forgot_token_email);

            // send link reset password
            $to_mail = $request->email;
            $url_reset_password = url('/account/update-new-password?email=' . $to_mail . '&token=' . $forgot_token_email);
            $data['body_send_mail'] = $url_reset_password;
            Mail::send('frontend.mail_reset_password_notify', $data, function ($message) use ($to_mail, $title_send_mail) {
                $message->to($to_mail, $to_mail);
                $message->subject($title_send_mail);
            });
            return redirect()->back()->with('message', 'Vui lòng check mail để khôi phục mật khẩu!');
        }
        return redirect()->back()->with('error', 'Email không tồn tại!');
    }
    public function getUpdateNewPassword()
    {
        return view('frontend.new_password');
    }
    public function postUpdateNewPassword(Request $request){
        $tokenEmailRandom = Str::random();
        $data = $request->all();
        $accountUpdatePassword = $this->accountCustomerRepository->findByEmailAndToken($data['email'], $data['token']);
        $countAccount = $accountUpdatePassword->count();
        if($countAccount > 0){
            $accountId = $accountUpdatePassword->first()->id;
            $isUpdate = $this->accountCustomerRepository->updatePassword($accountId, $data['password'], $tokenEmailRandom);
            if($isUpdate){
                return redirect('account/login-customer')->with('message', 'Đặt lại mật khẩu thành công !');
            }else{
                return redirect('account/forgot-password')->with('error', 'Có lỗi xảy ra khi đặt lại mật khẩu!');
            }
        }else{
            return redirect('account/forgot-password')->with('error', 'Link đã hết hạn, vui lòng nhập lại email!');
        }
    }
    public function getLogOutCustomer()
    {
        Auth::guard('account_customer')->logout();
        return redirect()->back();
    }
}
