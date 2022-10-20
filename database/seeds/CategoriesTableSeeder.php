<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
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
                'cate_name'=>'Trang điểm',
                'cate_slug'=>str_slug('Trang điểm'),
            ],
            [
                'cate_name'=>'Chăm sóc da',
                'cate_slug'=>str_slug('Chăm sóc da'),
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
