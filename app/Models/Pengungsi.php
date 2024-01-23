<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengungsi extends Model
{
    use HasFactory;

    protected $table = 'pengungsi';

    protected $fillable = [
        'nama',
        'telpon',
        // 'kpl_id',
        'statKel',
        'gender',
        'umur',
        'statPos',
        // 'posko_id',
        'statKon',
    ];

    public static function getExportData($id){
             // $data = Pengungsi::all();
             $getIdBencana = Bencana::where('id', $id)->value('id');
             $getIdPosko = Integrasi::where('bencana_id', $id)->value('id');
            //  $getIdPosko = Posko::where('bencana_id', $id)->value('id');
             
            //  DB::statement(DB::raw('set @count=0'));
             $data = Bencana::select('p.nama as namaPosko',
             'peng.nama',
             DB::raw('(case when (peng.statKel = 0) then "Kepala Keluarga" when (peng.statKel = 1)
             then "Ibu" when (peng.statKel = 2) then "Anak" when (peng.statKel = 3) then "Lainnya" end) 
             as present'),
            //  'peng.statKel',
             'kpl.nama as namaKepala',
             'peng.telpon',
             DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
             Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
             Daerah ',kpl.detail,' ')
             as lokasi"),
            //  'peng.gender',
             DB::raw('(case when (peng.gender = 0) then "Perempuan" when (peng.gender = 1)
             then "Laki-laki" end) as genders'),
             'peng.umur',
            //  'peng.statKon',
             DB::raw('(case when (peng.statKon = 0) then "Sehat" when (peng.statKon = 1)
             then "Luka Ringan" when (peng.statKon = 2) then "Luka Sedang" when (peng.statKon = 3) 
             then "Luka Berat" when (peng.statKon = 4) then "Difabel" end) as statKons')
         )
             ->join('integrasi as int','int.bencana_id','=','bencana.id')
             ->join('posko AS p', 'p.id', '=', 'int.posko_id')
             ->join('pengungsi as peng','peng.id','=','int.png_id')
             ->leftJoin('kepala_keluarga as kpl', 'int.kpl_id', '=', 'kpl.id')
             ->orderBy('bencana.tanggal', 'desc')
             ->distinct()
             ->where('int.bencana_id', '=', $id)
         // ->where('peng.posko_id','=','p.id')
             ->groupBy('int.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
                 'bencana.nama', 'lokasi', 'status', 'bencana.updated_at',
                 'p.nama','peng.nama',
                 'peng.id',
                 'int.kpl_id',
                 'peng.statKel',
                 'peng.telpon',
                 'peng.gender',
                 'peng.umur',
                 'peng.statPos',
                 'int.posko_id',
                 'statKon',
                 'peng.created_at',
                 'kpl.id',
                 'kpl.nama',
                 'kpl.provinsi',
                 'kpl.kota',
                 'kpl.kecamatan',
                 'kpl.kelurahan',
                 'kpl.detail')
             ->get()->toArray();

             return $data;
     
    }
}