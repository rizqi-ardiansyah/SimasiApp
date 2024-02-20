<?php

namespace App\Imports;

use App\Models\Pengungsi;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\ToModel;

class PengungsiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pengungsi([
            //
            'nama' => $row[0],
            'telpon' => $row[1],
            'statKel' => $row[2],
            'gender' => $row[3],
            'umur' => $row[4],
            'statPos' => $row[5],
            // 'posko_id',
            'statKon' => $row[6],   
        ]);
    }
}
