<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team')->insert([
            "id"            => 1,
            "agency_id"     => 12,
            "status"        => "SEDANG DIPROSES",
            "university"    => "Universitas Pembangunan Nasional \"Veteran\" Yogyakarta",
            "department"   => "Informatika",
            "proposal"      => "scaq0nQEiE.pdf",
            "presentation"  => "RAIBVRM47n.pptx",
            "cover_letter"  => "vzBB3kaTyB.pdf",
            "date_start"    => "2021-08-19",
            "date_finish"   => "2021-10-28",
            "date_of_created" => "2021-08-02"
        ]);
        DB::table('team')->insert([
            "id"            => 2,
            "agency_id"     => 12,
            "status"        => "DITOLAK",
            "university"    => "Universitas Pembangunan Nasional \"Veteran\" Yogyakarta",
            "department"   => "Informatika",
            "proposal"      => "MUPnOe0jfj.pdf",
            "presentation"  => "gRqrvLqVu9.pptx",
            "cover_letter"  => "ZmWVDZ1vHw.pdf",
            "date_start"    => "2021-08-01",
            "date_finish"   => "2021-09-10",
            "date_of_created"=> "2021-08-03"
        ]);
    }
}
