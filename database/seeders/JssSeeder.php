<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jss')->insert([
            'id'        => '1',
            'NIK'       => '0000000000000000',
            'username'  => 'superadmin',
            'fullname'  => 'Super Admin',
            'password'  => \Hash::make('1221'),
            'email'     => 'superadmin@admin.com',
            'no_wa'     => '0000000000000'
        ]);

        \DB::table('jss')->insert([
            'id'        => '2',
            'NIK'       => '0000000000000000',
            'username'  => 'admin',
            'fullname'  => 'admin',
            'password'  => \Hash::make('1221'),
            'email'     => 'admin@admin.com',
            'no_wa'     => '0000000000000'
        ]);

        \DB::table('jss')->insert([
            'id'        => '3',
            'NIK'       => '0000000000000000',
            'username'  => 'moderator',
            'fullname'  => 'moderator',
            'password'  => \Hash::make('1221'),
            'email'     => 'moderator@admin.com',
            'no_wa'     => '0000000000000'
        ]);

        \DB::table('jss')->insert([
            'id'        => '9461',
            'NIK'       => '6408040410990001',
            'username'  => 'maulanaakurniaa',
            'fullname'  => 'Maulana Kurnia Fiqih Ainul Yaqin',
            'password'  => \Hash::make('1221'),
            'email'     => 'maulanaakurniaa@yahoo.com',
            'no_wa'     => '6282115155714'
        ]);

        \DB::table('jss')->insert([
            'id'        => '7873',
            'NIK'       => '3323100201010002',
            'username'  => 'Ashariwdd',
            'fullname'  => 'Ashari Widodo',
            'password'  => \Hash::make('1221'),
            'email'     => 'ashariwdd@gmail.com',
            'no_wa'     => '6285158775801'
        ]);

        \DB::table('jss')->insert([
            'id'        => '7871',
            'NIK'       => '0000000000000000',
            'username'  => 'bayupamungkassejati',
            'fullname'  => 'Bayu Pamungkas Sejati',
            'password'  => \Hash::make('1221'),
            'email'     => 'bayupamungkas@gmail.com',
            'no_wa'     => '6285158775801'
        ]);
        \DB::table('jss')->insert([
            'id'        => '7870',
            'NIK'       => '0000000000000000',
            'username'  => 'rizaldi77',
            'fullname'  => 'Rizaldi Aidinul Hakim',
            'password'  => \Hash::make('1221'),
            'email'     => 'rizaldi77@gmail.com',
            'no_wa'     => '6285158775801'
        ]);
    }
}
