<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('role_admin')->insert([
            'id'     => '1',
            'name'   => 'SUPER ADMIN'
        ]);
        \DB::table('role_admin')->insert([
            'id'     => '2',
            'name'   => 'ADMIN'
        ]);
        \DB::table('role_admin')->insert([
            'id'     => '3',
            'name'   => 'MODERATOR'
        ]);
    }
}
