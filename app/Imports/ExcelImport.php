<?php

namespace App\Imports;

use App\Models\Pengungsi;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

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
            'Data_Pengungsi' => new FirstSheetImport(),
            'Upload_Data' => new SecondSheetImport()
        ];
    }
}
