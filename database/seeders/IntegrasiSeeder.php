<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Integrasi;
use Illuminate\Support\Facades\DB;

class IntegrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Integrasi::truncate();

        DB::table('integrasi')->insert([
            [
                'kpl_id' => 1,
                'png_id' => 1,
                'posko_id' => 1,
                'bencana_id' => 1,
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kpl_id' => 2,
                'png_id' => 2,
                'posko_id' => 2,
                'bencana_id' => 2,
                'user_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kpl_id' => 3,
                'png_id' => 3,
                'posko_id' => 3,
                'bencana_id' => 3,
                'user_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // [
            //     'nama' => 'Siaga Longsor 1',
            //     'provinsi' => 'Jawa Timur',
            //     'kota' => 'Batu',
            //     'kecamatan' => 'Junrejo',
            //     'kelurahan' => 'Mojorejo',
            //     'detail' => 'Jln. Merpati, RT. 05, RW. 01',
            //     // 'trc_id' => 5,
            //     // 'bencana_id' => 3,
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ]

        ]);

    }
}
