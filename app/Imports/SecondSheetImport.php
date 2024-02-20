<?php

namespace App\Imports;

use App\Models\Pengungsi;
use App\Models\KepalaKeluarga;
use App\Models\Integrasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\ToArray;

class SecondSheetImport implements ToArray, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function array(array $rows)
    {
        //
        // $idTrc = $request->bencana_id;
        foreach ($rows as $row)
        {
           $pengungsi = Pengungsi::create([
               'nama' => $row[0],
               'statKel' => $row[1],
               'telpon' => $row[2],
               'gender' => $row[3],
               'umur' => $row[4],
               'statPos' => $row[5],
               'statKon' => $row[6],
           ]);
           $kplKeluarga = KepalaKeluarga::create([
               'nama' => $row[7],
               'provinsi' => $row[8],
               'kota' => $row[9],
               'kecamatan' => $row[10],
               'kelurahan' => $row[11],
               'detail' => $row[12],
               'anggota' => $row[13],
           ]);
           Integrasi::create([
                'kpl_id' => $kplKeluarga->id,
                'png_id' => $pengungsi->id,
           ]);

           
        }
    }
}