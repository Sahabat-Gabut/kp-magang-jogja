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
            'jss_id'            => '0',
        ]);

        \DB::table('admin')->insert([
            'id'                => '1',
            'role_admin_id'     => '2',
            'jss_id'            => '00',
        ]);

        \DB::table('admin')->insert([
            'id'                => '1',
            'role_admin_id'     => '3',
            'jss_id'            => '000',
        ]);

        \DB::table('admin')->insert([
            'id'                => '1',
            'role_admin_id'     => '2',
            'jss_id'            => '9461',
        ]);
    }
}
