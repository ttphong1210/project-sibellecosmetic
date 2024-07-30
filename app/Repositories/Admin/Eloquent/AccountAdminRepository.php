<?php
namespace App\Repositories\Admin\Eloquent;
use App\Repositories\Admin\Interfaces\AccountAdminRepositoryInterface;
use App\User;
use Illuminate\Support\Collection;

class AccountAdminRepository implements AccountAdminRepositoryInterface{
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
    public function updateForgotToken(int $id, string $token){
        $accountAdmin = User::find($id);
        $accountAdmin->forgot_token = $token;
        $accountAdmin->save();
    }
    public function findByEmailAndToken(string $email, string $token):Collection{
        return User::where('email', $email)->where('forgot_token', $token)->get();
    }
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