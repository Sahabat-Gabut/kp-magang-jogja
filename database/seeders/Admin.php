<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin')->insert([
            'id_admin'          => '1',
            'id_role_admin'     => '1',
            'id_jss'            => '9461',
            'imgSrc'            => 'asd'
        ]);
    }
}
