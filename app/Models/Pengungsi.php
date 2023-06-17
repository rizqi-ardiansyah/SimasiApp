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
        'kpl_id',
        'statKel',
        'gender',
        'umur',
        'statPos',
        'posko_id',
        'statKon',
    ];

    public static function getExportData($id){
             // $data = Pengungsi::all();
             $getIdBencana = Bencana::where('id', $id)->value('id');
             $getIdPosko = Posko::where('bencana_id', $id)->value('id');
             
            //  DB::statement(DB::raw('set @count=0'));
             $data = Bencana::select('p.nama as namaPosko',
             'peng.nama',
             'peng.statKel',
             'kpl.nama as namaKepala',
             'peng.telpon',
             DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
             Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
             Daerah ',kpl.detail,' ')
             as lokasi"),
             'peng.gender',
             'peng.umur',
             'peng.statKon',
         )
             ->join('posko AS p', 'bencana.id', '=', 'p.bencana_id')
             ->join('pengungsi as peng','peng.posko_id','=','p.id')
             ->leftJoin('kepala_keluarga as kpl', 'peng.kpl_id', '=', 'kpl.id')
             ->orderBy('bencana.tanggal', 'desc')
             ->distinct()
             ->where('p.bencana_id', '=', $id)
         // ->where('peng.posko_id','=','p.id')
             ->groupBy('p.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
                 'bencana.nama', 'lokasi', 'status', 'bencana.updated_at',
                 'p.nama','peng.nama',
                 'peng.id',
                 'peng.kpl_id',
                 'peng.statKel',
                 'peng.telpon',
                 'peng.gender',
                 'peng.umur',
                 'peng.statPos',
                 'peng.posko_id',
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