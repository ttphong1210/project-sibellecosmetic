<?php
use App\User;
use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $data=[
        //     [
        //     'name'=>'PhongAdmin',
        //     'email'=>'phong@gmail.com',
        //     'password'=>bcrypt('1234567'),
        //     ],
        //     [
        //     'name'=>'PhongAuthor',
        //     'email'=>'phong12@gmail.com',
        //     'password'=>bcrypt('1234567'),
        //     ],
        // ];
        // DB::table('vp_users')->insert($data);

        User::truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = new User();
        $admin->name = 'Phong Admin';
        $admin->email = 'typhong1210@gmail.com';
        $admin->password = bcrypt('123456');
        $admin->save(); 
        $admin->roles()->attach($adminRoles);


        $author = new User();
        $author->name = 'Phong Author';
        $author->email = 'tranthephong1210@gmail.com';
        $author->password = bcrypt('123456');
        $author->save(); 
        $author->roles()->attach($authorRoles);


        $user = new User();
        $user->name = 'Phong user';
        $user->email = 'phong1210@gmail.com';
        $user->password = bcrypt('123456');
        $user->save(); 
        $user->roles()->attach($userRoles);

    }
}
