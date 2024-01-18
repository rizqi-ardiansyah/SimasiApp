<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KepalaKeluarga;
use Illuminate\Support\Facades\DB;

class KepKelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // KepalaKeluarga::truncate();

        DB::table('kepala_keluarga')->insert([
            [
                'nama' => 'Andi Hermansyah',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Bumiaji',
                'kelurahan' => 'Bulukerto',
                'detail' => 'Jln. Brawijaya, RT. 03, RW. 01',
                'anggota' => 0,
                // 'trc_id' => 4,
                // 'bencana_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Budi Santoso',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Batu',
                'kelurahan' => 'Oro-oro Ombo',
                'detail' => 'Jln. Sriwijaya, RT. 02, RW. 01',
                'anggota' => 0,
                // 'trc_id' => 4,
                // 'bencana_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Rahmat Dermawan',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Junrejo',
                'kelurahan' => 'Mojorejo',
                'detail' => 'Jln. Merpati, RT. 05, RW. 01',
                'anggota' => 0,
                // 'trc_id' => 5,
                // 'bencana_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
