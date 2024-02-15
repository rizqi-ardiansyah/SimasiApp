<?php

namespace App\Imports;

use App\Models\Pengungsi;
use App\Models\KepalaKeluarga;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportPengungsi implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
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
           KepalaKeluarga::create([
               'nama' => $row[7],
               'provinsi' => $row[8],
               'kota' => $row[9],
               'kecamatan' => $row[10],
               'kelurahan' => $row[11],
               'detail' => $row[12],
               'anggota' => $row[13],
           ]);

        //    $myString = $row[8];
        //    $myArray = explode(',', $myString);
        //    foreach ($myArray as $value) {
        //        Courses::create([
        //             'user_id' => $user->id,
        //             'course_name' => $value,
        //        ]);
        //    }

           
        }
    }
}