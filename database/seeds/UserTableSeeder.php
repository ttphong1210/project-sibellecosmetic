<?php

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
        $data=[
            [
            'email'=>'phong@gmail.com',
            'password'=>bcrypt('1234567'),
            'level'=>1
            ],
            [
            'email'=>'phong12@gmail.com',
            'password'=>bcrypt('1234567'),
            'level'=>2
            ],
        ];
        DB::table('vp_users')->insert($data);
    }
}
