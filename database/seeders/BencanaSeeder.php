<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bencana;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Bencana::factory(10)->create();
        Bencana::truncate();
        DB::table('bencana')->insert([
            [
                'nama' => 'Gunung Kelud Meletus',
                'tanggal' => Carbon::parse('2014-02-13'),
                'waktu' => '12:34',
                'lokasi' => 'Blitar, Malang, Kediri',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Banjir Bandang Kota Malang',
                'tanggal' => Carbon::parse('2018-02-14'),
                'waktu' => '16:34',
                'lokasi' => 'Sumberbrantas, Bumiaji, Batu',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Tanah Longsor',
                'tanggal' => Carbon::parse('2022-12-16'),
                'waktu' => '19:34',
                'lokasi' => 'Jalan Batu - Kediri',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
