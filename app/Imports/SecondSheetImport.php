<?php

namespace App\Imports;

use App\Models\Pengungsi;
use App\Models\KepalaKeluarga;
use App\Models\Integrasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SecondSheetImport implements ToArray, WithCalculatedFormulas, WithValidation, WithHeadingRow
{
    use Importable;
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
               'nama' => $row['nama_pengungsi'],
               'statKel' => $row['statkel'],
               'telpon' => $row['telepon'],
               'gender' => $row['gender'],
               'umur' => $row['umur'],
               'statPos' => $row['status_posko'],
               'statKon' => $row['status_kondisi'],
           ]);
           $kplKeluarga = KepalaKeluarga::create([
               'nama' => $row['nama_kepala'],
               'provinsi' => $row['provinsi'],
               'kota' => $row['kota'],
               'kecamatan' => $row['kecamatan'],
               'kelurahan' => $row['kelurahan'],
               'detail' => $row['detail_alamat'],
               'anggota' => $row['anggota'],
           ]);
           Integrasi::create([
                'kpl_id' => $kplKeluarga->id,
                'png_id' => $pengungsi->id,
           ]);

           
        }
    }

    public function rules(): array
    {
        return [
            'nama_pengungsi' => 'unique:pengungsi,nama',
        ];

    }

}