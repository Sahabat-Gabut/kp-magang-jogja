<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SUPER ADMIN
        DB::table('jss')->insert([
            'id'        => 'JSS-I1',
            'NIK'       => '0000000000000000',
            'username'  => 'superadmin',
            'fullname'  => 'Super Admin',
            'password'  => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email'     => 'superadmin@admin.com',
            'no_wa'     => '0000000000000'
        ]);

        // ADMIN
        DB::table('jss')->insert([
            'id'        => 'JSS-I2',
            'NIK'       => '0000000000000000',
            'username'  => 'diskominfosan',
            'fullname'  => 'Dinas Komunikasi Informatika dan Persandian',
            'password'  => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email'     => 'admin@admin.com',
            'no_wa'     => '0000000000000'
        ]);

        // PEMBIMBING LAPANGAN
        DB::table('jss')->insert([
            'id'        => 'JSS-I3',
            'NIK'       => '0000000000000000',
            'username'  => 'pemlapdiskominfosan',
            'fullname'  => 'Pembimbing Lapangan Dinas Komunikasi Informatika dan Persandian',
            'password'  => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email'     => 'pemlapdiskominfosan@admin.com',
            'no_wa'     => '0000000000000'
        ]);

        DB::table('jss')->insert([
            'id'        => 'JSS-I9461',
            'NIK'       => '0000000000000000',
            'username'  => 'maulanaakurniaa',
            'fullname'  => 'Maulana Kurnia Fiqih Ainul Yaqin',
            'password'  => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email'     => 'maulanaakurniaa@yahoo.com',
            'no_wa'     => '0000000000000'
        ]);

        DB::table('jss')->insert([
            'id'        => 'JSS-I7873',
            'NIK'       => '3323100201010002',
            'username'  => 'Ashariwdd',
            'fullname'  => 'Ashari Widodo',
            'password'  => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email'     => 'ashariwdd@gmail.com',
            'no_wa'     => '0000000000000'
        ]);

        DB::table('jss')->insert([
            'id'        => 'JSS-I7871',
            'NIK'       => '0000000000000000',
            'username'  => 'bayupamungkassejati',
            'fullname'  => 'Bayu Pamungkas Sejati',
            'password'  => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email'     => 'bayupamungkas@gmail.com',
            'no_wa'     => '0000000000000'
        ]);
        DB::table('jss')->insert([
            'id'        => 'JSS-I7870',
            'NIK'       => '0000000000000000',
            'username'  => 'rizaldi77',
            'fullname'  => 'Rizaldi Aidinul Hakim',
            'password'  => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email'     => 'rizaldi77@gmail.com',
            'no_wa'     => '0000000000000'
        ]);
    }
}
