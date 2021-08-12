<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprenticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apprentice')->insert([
            'jss_id'    => 'JSS-I9461',
            'team_id'   => 1,
            'npm'       => '123180176',
            'cv'        => '3VEqIakuoP.pdf',
            'photo'     => 'maulana.jpeg',
        ]);
        DB::table('apprentice')->insert([
            'jss_id'    => 'JSS-I7870',
            'team_id'   => 1,
            'npm'       => '123180174',
            'cv'        => 'P2zVio1DWa.pdf',
            'photo'     => 'rizal.jpeg',
        ]);
 
        DB::table('apprentice')->insert([
            'jss_id'    => 'JSS-I7873',
            'team_id'   => 2,
            'npm'       => '123180173',
            'cv'        => 'ySiSdU0EWD.pdf',
            'photo'     => 'BpT5V36dST.jpeg',
        ]);
        DB::table('apprentice')->insert([
            'jss_id'    => 'JSS-I7871',
            'team_id'   => 2,
            'npm'       => '123180165',
            'cv'        => '748RZzRZCA.pdf',
            'photo'     => '4Tqj7mKzOY.jpeg',
        ]);
    }
}