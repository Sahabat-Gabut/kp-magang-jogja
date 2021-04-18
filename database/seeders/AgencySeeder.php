<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('agency')->insert([
            'name'      => 'Dinas Pendidikan Pemudan dan Olahraga'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Kesehatan'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Pekerjaan Umum, Perumahan, dan Kawasan Permukiman'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Pertanahan dan Tata Ruang (Kundha Niti Mandala Sarta Tata Sasana)'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Satuan Polisi Pamong Praja'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Sosial, Tenaga Kerja, dan Transmigrasia'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Pemberdayaan Perempuan, Perlindungan Anak, dan Pengendalian Penduduk dan Keluarga Berencana'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Kependudukan dan Pencatatan Sipil'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Perdagangan'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Pertanian dan Pangan'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Lingkungan Hidup'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Komunikasi Informatika dan Persandian'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Perhubungan'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Kebudayaan (Kundha Kabudayan)'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Pariwisata'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Penanaman Modal dan Pelayanan Satu Pintu'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Perindustrian, Koperasi, Usaha Kecil dan Menengah'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Pemadam Kebakaran dan Penyelamatan'
        ]);
        \DB::table('agency')->insert([
            'name'      => 'Dinas Perpustakaan dan Kearsipan'
        ]);
    }
}
