<?php
namespace App\Repositories\AccountCustomer;

use App\Models\AccountCustomer;
use App\Repositories\EloquentRepository;
use App\Repositories\AccountCustomer\AccountCustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountCustomerRepository extends EloquentRepository implements AccountCustomerRepositoryInterface {

    /**
     * get model
     * @return string
     */
    public function getModel(){
        return App\Models\AccountCustomer::class;
    }

    public function __construct(AccountCustomer $_model ){
        $this->_model = $_model;
    }
    public function getLoginCustomer(){

    }
    // public function postLoginCustomer(Request $request){
    //     $credentials = $request->only('email','password');
    // }
    // public function postLoginCustomer($request){
    //     $data = [
    //         'email' => $request->email,
    //         'password' => $request->password
    //     ];
    //     dd($data);
    //     if (Auth::guard('account_customer')->attempt($data)) {
    //         return redirect('/');
    //     } else {
    //         return redirect()->back()->with('error', 'Username hoặc Password không đúng');
    //     }
    // }
    public function getRegisterCustomer(){

    }
    public function postRegisterCustomer($data){
        return AccountCustomer::create([
            'name' => $data['name'],
            'number_phone' => $data['number_phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['pass']),
        ]);
    }
}
