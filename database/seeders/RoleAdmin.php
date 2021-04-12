<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('role_admin')->insert([
            'id_role_admin'     => '1',
            'name_role_admin'   => 'SUPER ADMIN'
        ]);
        \DB::table('role_admin')->insert([
            'id_role_admin'     => '2',
            'name_role_admin'   => 'ADMIN'
        ]);
        \DB::table('role_admin')->insert([
            'id_role_admin'     => '3',
            'name_role_admin'   => 'MODERATOR'
        ]);
    }
}
