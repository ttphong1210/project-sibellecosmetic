<?php
namespace App\Repositories\Admin\Eloquent;
use App\Repositories\Admin\Interfaces\AccountAdminRepositoryInterface;
use App\Repositories\EloquentRepository;
use App\User;
use Illuminate\Support\Collection;

class AccountAdminRepository extends EloquentRepository implements AccountAdminRepositoryInterface{
    /**
     * Get the model class.
     * 
     * @return string
     */
    public function getModel(){
        return User::class;
    }

    /**
     * AccountAdminRepository constructor.
     * 
     * @param User $_model
     */
    public function __construct(User $_model){
        $this->_model = $_model;
    }

    public function show(){
        return $this->_model::pluck('name', 'id');
    }

    /**
     * Create a new account.
     * 
     * @param array $data
     * @return bool
     */
    public function createNewAccount(array $data){
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        return $user->save();
    }
    public function findByEmail(string $email){
        return User::where('email', $email)->get();
    }

    /**
     * Update forgot token.
     * 
     * @param int $id
     * @param string $token
     * @return void
     */
    public function updateForgotToken(int $id, string $token){
        $accountAdmin = User::find($id);
        $accountAdmin->forgot_token = $token;
        $accountAdmin->save();
    }

    /**
     * Find user by email and token.
     * 
     * @param string $email
     * @param string $token
     * @return Collection
     */
    public function findByEmailAndToken(string $email, string $token):Collection{
        return User::where('email', $email)->where('forgot_token', $token)->get();
    }

    /**
     * Update user's password and forgot token.
     * 
     * @param int $id
     * @param string $token
     * @param string $password
     * @return bool
     */
    public function updatePassword(int $id, string $token, string $password): bool{
        $accountAdmin = User::find($id);
        if($accountAdmin){
            $accountAdmin->password = bcrypt($password);
            $accountAdmin->forgot_token = $token;
            return $accountAdmin->save();
        }
        return false;
    }
}