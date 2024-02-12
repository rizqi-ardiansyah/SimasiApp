<?php

namespace App\Imports;

use App\Models\Pengungsi;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function sheets(): array
    {
        return [
            'Upload_Data' => new PengungsiImport(),
        ];
    }
}
