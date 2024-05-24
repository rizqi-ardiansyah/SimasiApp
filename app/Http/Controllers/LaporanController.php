<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KepalaKeluarga;
use App\Models\Pengungsi;
use App\Models\Bencana;
use App\Models\Posko;
use App\Models\Integrasi;
use App\Exports\PengungsiExport;
use PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bencana::select(DB::raw("concat(tanggal,' ',waktu) as waktu"),
            DB::raw("concat('Prov. ',bencana.provinsi,', Kota ',bencana.kota,', Kec. ',
             bencana.kecamatan,', Ds. ',bencana.kelurahan) as lokasi" ),'bencana.provinsi',
            'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
            'bencana.nama as namaBencana','status',
            'bencana.updated_at as waktuUpdate', 'int.bencana_id', 'bencana.jmlPosko',
            DB::raw('count(int.bencana_id) as ttlPosko'),
            //  DB::raw('count(p.id) as ttlPengungsi')
        )   
            ->join('integrasi as int', 'int.bencana_id','=','bencana.id')
            // ->join('posko AS p', 'bencana.id', '=', 'p.bencana_id')
        // ->join('pengungsi as peng','peng.posko_id','=','p.id')
            ->orderBy('bencana.tanggal', 'desc')
            ->distinct()
            // ->where('p.bencana_id', '=', 'b.id')
        // ->where('peng.posko_id','=','p.id')
            ->groupBy('int.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
                'bencana.nama', 'lokasi', 'status', 'bencana.updated_at','bencana.jmlPosko','bencana.provinsi')
            ->paginate(5);

            return view('admin.laporan.index', [ 
                // 'data2' => $bencana2,
                'data' => $data,
                // 'ttlPengungsi' => $ttlPeng,
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportPdf($id){
        // $data = Pengungsi::all();
        $getIdBencana = Bencana::where('id', $id)->value('id');
        $getIdPosko = Integrasi::where('bencana_id', $id)->value('posko_id');
        // $getIdPosko = Posko::where('bencana_id', $id)->value('id');

        $dataBencana = Bencana::select(DB::raw("concat(tanggal,' ',waktu) as waktu"),
        'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
        'bencana.nama as namaBencana', 'status',
        'bencana.updated_at as waktuUpdate', 'int.bencana_id',
        DB::raw('count(int.bencana_id) as ttlPosko'),
        'p.nama as namaPosko',
        // 'peng.nama',
        // 'peng.id as idPengungsi',
        // 'int.kpl_id',
        // 'peng.statKel',
        // 'peng.telpon',
        // 'peng.gender',
        // 'peng.umur',
        // 'peng.statPos',
        'int.posko_id as idPospengs',
        // 'statKon',
        // 'peng.created_at as tglMasuk',
        // 'kpl.id as idKepala',
        // 'kpl.nama as namaKepala',
        // 'kpl.detail as detail',
        DB::raw("concat('Prov. ',bencana.provinsi,', Kota ',bencana.kota,', Kec. ',
        bencana.kecamatan,', Ds. ',bencana.kelurahan) as lokasiBencana" ),
        DB::raw("concat('Prov. ',bencana.provinsi,', Kota ',bencana.kota,', Kec. ',
        bencana.kecamatan,', Ds. ',bencana.kelurahan) as lokasi" ),
        //  DB::raw('count(p.id) as ttlPengungsi')
    )
        ->join('integrasi as int','int.bencana_id','bencana.id')
        ->join('posko AS p', 'p.id', '=', 'int.posko_id')
        // ->join('pengungsi as peng','peng.id','=','int.png_id')
        // ->leftJoin('kepala_keluarga as kpl', 'kpl.id', '=', 'int.kpl_id')
        ->orderBy('bencana.tanggal', 'desc')
        // ->distinct()
        ->where('int.bencana_id', '=', $id)
    // ->where('peng.posko_id','=','p.id')
        ->groupBy('int.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
            'bencana.nama', 'status', 'bencana.updated_at',
            'p.nama',
            // 'peng.nama',
            // 'peng.id',
            // 'int.kpl_id',
            // 'peng.statKel',
            // 'peng.telpon',
            // 'peng.gender',
            // 'peng.umur',
            // 'peng.statPos',
            'int.posko_id',
            // 'statKon',
            // 'peng.created_at',
            // 'kpl.id',
            // 'kpl.nama',
            // 'kpl.provinsi',
            // 'kpl.kota',
            // 'kpl.kecamatan',
            // 'kpl.kelurahan',
            // 'kpl.detail',
            'lokasi','lokasiBencana')
        ->paginate(100);

        $dataPengungsi = Bencana::select(DB::raw("concat(tanggal,' ',waktu) as waktu"),
        'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
        'bencana.nama as namaBencana', 'status',
        'bencana.updated_at as waktuUpdate', 'int.bencana_id',
        DB::raw('count(int.bencana_id) as ttlPosko'),
        'p.nama as namaPosko',
        'peng.nama',
        'peng.id as idPengungsi',
        'int.kpl_id',
        'peng.statKel',
        'peng.telpon',
        'peng.gender',
        'peng.umur',
        'peng.statPos',
        'int.posko_id as idPospeng',
        'statKon',
        'peng.created_at as tglMasuk',
        'kpl.id as idKepala',
        'kpl.nama as namaKepala',
        'kpl.detail as detail',
        DB::raw("concat('Prov. ',bencana.provinsi,', Kota ',bencana.kota,', Kec. ',
        bencana.kecamatan,', Ds. ',bencana.kelurahan) as lokasiBencana" ),
        DB::raw("concat('Prov. ',bencana.provinsi,', Kota ',bencana.kota,', Kec. ',
        bencana.kecamatan,', Ds. ',bencana.kelurahan, ' Daerah. ',kpl.detail) as lokasi" ),
        //  DB::raw('count(p.id) as ttlPengungsi')
    )
        ->join('integrasi as int','int.bencana_id','bencana.id')
        ->join('posko AS p', 'p.id', '=', 'int.posko_id')
        ->join('pengungsi as peng','peng.id','=','int.png_id')
        ->leftJoin('kepala_keluarga as kpl', 'kpl.id', '=', 'int.kpl_id')
        ->orderBy('bencana.tanggal', 'desc')
        ->distinct()
        ->where('int.bencana_id', '=', $id)
        // ->where('int.posko_id','=', $getIdPosko)
        ->groupBy('int.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
            'bencana.nama', 'status', 'bencana.updated_at',
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
            'kpl.detail',
            'lokasi','lokasiBencana')
        ->paginate(100);

    $getJml = Pengungsi::select('*','p.id as idPospeng')
    ->join('integrasi as int','int.png_id','=','pengungsi.id')
    ->join('posko as p','p.id','=','int.posko_id')
    ->where('int.bencana_id', '=', $getIdBencana)
    ->get();

    $getJmlPengungsi = $getJml->count();

    $getBalita = Pengungsi::select('*','p.id as idPospeng')
    ->where('umur', '<', 6)
    ->join('integrasi as int','int.png_id','=','pengungsi.id')
    ->join('posko as p','p.id','=','int.posko_id')
    ->where('int.bencana_id', '=', $getIdBencana)
    ->get();

    $getTtlBalita = $getBalita->count();

    $getLansia = Pengungsi::select('*','p.id as idPospeng')
    ->join('integrasi as int','int.png_id','=','pengungsi.id')
    ->join('posko as p','p.id','=','int.posko_id')
    ->where('umur', '>', 59)
    ->where('int.bencana_id', '=', $getIdBencana)
    ->get();

    $getTtlLansia = $getLansia->count();

    $getDewasa = Pengungsi::select('*','p.id as idPospeng')
        ->join('integrasi as int','int.png_id','=','pengungsi.id')
        ->join('posko as p','p.id','=','int.posko_id')
        ->where('umur', '>', 4)
        ->where('umur', '<', 60)
        ->where('int.bencana_id', '=', $getIdBencana)
        ->get();

    $getTtlDewasa = $getDewasa->count();
    
    $getSehat = Pengungsi::select('*','p.id as idPospeng')
        ->join('integrasi as int','int.png_id','=','pengungsi.id')
        ->join('posko as p','p.id','=','int.posko_id')
        ->where('statKon', '=', 0)
        ->where('int.bencana_id', '=', $getIdBencana)
        ->get();

    $getTtlSehat = $getSehat->count();

    $getSakit = Pengungsi::select('*','p.id as idPospeng')
        ->join('integrasi as int','int.png_id','=','pengungsi.id')
        ->join('posko as p','p.id','=','int.posko_id')
        ->where('statKon', '>', 0)
        ->where('statKon', '<', 5)
        ->where('int.bencana_id', '=', $getIdBencana)
        ->get();

    $getTtlSakit = $getSakit->count();

    $getDifabel = Pengungsi::select('*','p.id as idPospeng')
        ->join('integrasi as int','int.png_id','=','pengungsi.id')
        ->join('posko as p','p.id','=','int.posko_id')
        ->where('statKon', '=', 5)
        ->where('int.bencana_id', '=', $getIdBencana)
        ->get();

    $getTtlDifabel = $getDifabel->count();


        // view()->share('data', $data);
        view()->share(
        [
            'dataBencana' => $dataBencana,
            'dataPengungsi' => $dataPengungsi,
            'getBalita' => $getBalita,
            'getDewasa' => $getDewasa,
            'getLansia' => $getLansia,
            'ttlBalita' => $getTtlBalita,
            'ttlDewasa' => $getTtlDewasa,
            'ttlLansia' => $getTtlLansia,
            'ttlSehat' => $getTtlSehat,
            'ttlDifabel' => $getTtlDifabel,
            'jmlPeng' => $getJmlPengungsi,
            'getJml' => $getJml
        ]);
        $pdf = PDF::loadview('datapengungsi-pdf');
        return $pdf->download('dataPengungsi.pdf');
    }

    public function exportExcel(Request $request){
        // $data = Pengungsi::all();
        return Excel::download(new PengungsiExport($request->id), 'dataPengungsi.xlsx');
    }
}