<?php

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate();
        Roles::create(['name'=>'admin']);
        Roles::create(['name'=>'author']);
        Roles::create(['name'=>'user']);

        // DB::table('roles')->insert([
        //     ['name' => 'admin' ],
        //     ['name' => 'author'],
        //     ['name' => 'user'],
        // ]);
    }
}
