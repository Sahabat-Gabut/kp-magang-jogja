<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'role_id'     => '1',
            'jss_id'            => 'JSS-I1',
        ]);

        DB::table('admin')->insert([
            'role_id'     => '2',
            'jss_id'            => 'JSS-I2',
            'agency_id'         => '12'
        ]);

        DB::table('admin')->insert([
            'role_id'     => '3',
            'jss_id'            => 'JSS-I3',
            'agency_id'         => '12'
        ]);
    }
}
