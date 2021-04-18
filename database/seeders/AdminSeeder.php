<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin')->insert([
            'id'                => '1',
            'role_admin_id'     => '1',
            'jss_id'            => '9461',
            'imgSrc'            => 'https://ui-avatars.com/api/?name=Maulana+Kurnia&color=84e1bc&background=EBF4FF'
        ]);
    }
}
