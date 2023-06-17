<?php

namespace App\Exports;

use App\Models\Pengungsi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengungsiExport implements FromCollection, WithHeadings
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Pengungsi::all();
        return collect(Pengungsi::getExportData($this->id));
    }
    public function headings():array{
        return[
            'Nama Posko',
            'Nama Pengungsi',
            'StatKel',
            'KepKel',
            'No Telepon',
            'Alamat',
            'JK',
            'Umur',
            'Kond'
        ];
    }
        
}
