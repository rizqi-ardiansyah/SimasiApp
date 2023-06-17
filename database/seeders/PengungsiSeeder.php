<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengungsi;
use App\Models\KepalaKeluarga;
use Illuminate\Support\Facades\DB;

class PengungsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Pengungsi::factory(3)->create();
        KepalaKeluarga::truncate();
        DB::table('kepala_keluarga')->insert([
            [
                'nama' => 'Budiman',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Batu',
                'kelurahan' => 'Sumberejo',
                'detail' => 'Jln. Pattimura, Toko Dekat Perempatan Sumberejo RT. 05 RW. 07',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Tejo',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Bumiaji',
                'kelurahan' => 'Bulukerto',
                'detail' => 'Jln. Brawijaya 5, RT. 07, RW. 01, Rumah tingkat 2 kanan mushola At-Taqwa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Andi Firmansyah',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Batu',
                'kecamatan' => 'Junrejo',
                'kelurahan' => 'Mojorejo',
                'detail' => 'Jln. Merpati 10, RT. 04, RW. 03, Perum Griya, Blok G',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);

        Pengungsi::truncate();
        DB::table('pengungsi')->insert([
            [
                'nama' => 'Budiman',
                'statKel' => 0,
                'kpl_id' => 1,
                'telpon' => '085647225203',
                'gender' => 1,
                'umur' => 55,
                'statPos' => 1,
                'posko_id' => 1,
                'statKon' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Riko Firmansyah',
                'statKel' => 2,
                'kpl_id' => 1,
                'telpon' => '085647225203',
                'gender' => 1,
                'umur' => 4,
                'statPos' => 1,
                'posko_id' => 1,
                'statKon' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Rini Sukmawati',
                'statKel' => 1,
                'kpl_id' => 1,
                'telpon' => '085647225203',
                'gender' => 1,
                'umur' => 50,
                'statPos' => 1,
                'posko_id' => 1,
                'statKon' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Tejo',
                'statKel' => 0,
                'kpl_id' => 2,
                'telpon' => '085747225123',
                'gender' => 1,
                'umur' => 50,
                'statPos' => 1,
                'posko_id' => 1,
                'statKon' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Irma Wati',
                'statKel' => 1,
                'kpl_id' => 2,
                'telpon' => '085747225123',
                'gender' => 0,
                'umur' => 45,
                'statPos' => 0,
                'posko_id' => 2,
                'statKon' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Andi Firmansyah',
                'statKel' => 0,
                'kpl_id' => 3,
                'telpon' => '085747225123',
                'gender' => 0,
                'umur' => 45,
                'statPos' => 1,
                'posko_id' => 3,
                'statKon' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Putri Cantika',
                'statKel' => 1,
                'kpl_id' => 3,
                'telpon' => '085747225123',
                'gender' => 0,
                'umur' => 42,
                'statPos' => 1,
                'posko_id' => 3,
                'statKon' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],            

        ]);
    }
}
