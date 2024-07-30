<?php
namespace App\Repositories\AccountCustomer;

use App\Models\AccountCustomer;
use App\Repositories\EloquentRepository;
use App\Repositories\AccountCustomer\AccountCustomerRepositoryInterface;
use Illuminate\Support\Collection;

class AccountCustomerRepository extends EloquentRepository implements AccountCustomerRepositoryInterface {

    /**
     * get model
     * @return string
     */
    public function getModel(){
        return AccountCustomer::class;
    }

    public function __construct(AccountCustomer $_model ){
        $this->_model = $_model;
    }

    public function postRegisterCustomer($data){
        return AccountCustomer::create([
            'name' => $data['name'],
            'number_phone' => $data['number_phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['pass']),
        ]);
    }

    public function findByEmail(string $email){
        return AccountCustomer::where('email', $email)->get();
    }
    public function updateForgotToken(int $id, string $token){
        $accountCustomer = AccountCustomer::find($id);
        $accountCustomer->forgot_token = $token;
        $accountCustomer->save();
    }
    public function findByEmailAndToken(string $email, string $token): Collection
    {
        return AccountCustomer::where('email', $email)->where('forgot_token', $token)->get();
    }
    public function updatePassword(int $id, string $password, string $token): bool{
        $account = AccountCustomer::find($id);
        if($account){
            $account->password = bcrypt($password);
            $account->forgot_token = $token;
            return $account->save();
        } 
        return false;
    }
}
