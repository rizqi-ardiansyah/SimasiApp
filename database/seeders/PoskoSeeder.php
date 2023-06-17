<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Posko;
use Illuminate\Support\Facades\DB;

class PoskoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Posko::factory(10)->create();
        Posko::truncate();
        DB::table('posko')->insert([
            [
                'nama' => 'Kelud Siaga 1',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Batu',
                'kelurahan' => 'Sumberejo',
                'detail' => 'Jln. Pattimura, RT. 02, RW. 01',
                'trc_id' => 3,
                'bencana_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Siaga Banjir 1',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Bumiaji',
                'kelurahan' => 'Bulukerto',
                'detail' => 'Jln. Brawijaya, RT. 03, RW. 01',
                'trc_id' => 4,
                'bencana_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Siaga Longsor 1',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Junrejo',
                'kelurahan' => 'Mojorejo',
                'detail' => 'Jln. Merpati, RT. 05, RW. 01',
                'trc_id' => 5,
                'bencana_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
