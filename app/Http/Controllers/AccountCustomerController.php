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
    public function __construct(AccountCustomerRepository $accountCustomerRepository){
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
        // $data = $request->all();

        // $accountCustomer = new AccountCustomer;
        // $accountCustomer->name = $data['name'];
        // $accountCustomer->number_phone = $data['number_phone'];
        // $accountCustomer->email = $data['email'];
        // $accountCustomer->password = bcrypt($data['pass']);
        // $accountCustomer->save();
        $this->accountCustomerRepository->postRegisterCustomer($request->all());

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
        $title_send_mail = "Yêu cầu đặt lại mật khẩu Si.Belle Cosmetics" . '' . $now;
        $account_customer = AccountCustomer::where('email', '=', $data['email'])->get();
        foreach ($account_customer as $key => $value) {
            $account_customer_id = $value->id;
        }
        if (!empty($account_customer)) {
            $forgot_token_email = Str::random(10);
            $account_customer = AccountCustomer::find($account_customer_id);
            $account_customer->forgot_token = $forgot_token_email;
            $account_customer->save();

            // send-link-reset-pass 
            //Dependency injection(Services / Repository) -> sql
            $to_mail = $request->email;
            $url_reset_password = url('/account/update-new-password?email=' . $to_mail . '&token=' . $forgot_token_email);
            $data['body_send_mail'] = $url_reset_password;
            //services 
            Mail::send('frontend.mail_reset_password_notify', $data, function ($message) use ($to_mail, $title_send_mail) {
                $message->to($to_mail, $to_mail);
                $message->subject($title_send_mail);
            });

            return redirect()->back()->with('message', 'Vui lòng check mail để khôi phục mật khẩu !');
        }
    }
    public function getUpdateNewPassword()
    {
        return view('frontend.new_password');
    }
    public function postUpdateNewPassword(Request $request)
    {
        $token_email_random = Str::random();
        $data = $request->all();
        $account_update_password = AccountCustomer::where('email', '=', $data['email'])
            ->where('forgot_token', '=', $data['token'])
            ->get();
        $count_account = $account_update_password->count();
        if ($count_account > 0) {
            foreach ($account_update_password as $key => $value) {
                $account_id = $value->id;
            }
            $update_account_pass = AccountCustomer::find($account_id);
            $update_account_pass->password = bcrypt($data['password']);
            $update_account_pass->forgot_token = $token_email_random;
            $update_account_pass->save();
            
            return redirect('account/login-customer')->with('message', 'Đặt lại mật khẩu thành công !');
        } else {
            return redirect('account/forgot-password')->with('error', 'Link đã hết hạn, vui lòng nhập lại email !');
        }
    }
    public function getLogOutCustomer()
    {
        Auth::guard('account_customer')->logout();
        return redirect()->back();
    }

}
