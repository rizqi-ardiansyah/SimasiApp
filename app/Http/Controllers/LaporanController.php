<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KepalaKeluarga;
use App\Models\Pengungsi;
use App\Models\Bencana;
use App\Models\Posko;
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
            'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
            'bencana.nama as namaBencana', 'lokasi', 'status',
            'bencana.updated_at as waktuUpdate', 'p.bencana_id',
            DB::raw('count(p.bencana_id) as ttlPosko'),
            //  DB::raw('count(p.id) as ttlPengungsi')
        )
        ->join('posko AS p', 'bencana.id', '=', 'p.bencana_id')
        // ->join('pengungsi as peng','peng.posko_id','=','p.id')
            ->orderBy('bencana.tanggal', 'desc')
            ->distinct()
            // ->where('p.bencana_id', '=', 'b.id')
        // ->where('peng.posko_id','=','p.id')
            ->groupBy('p.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
                'bencana.nama', 'lokasi', 'status', 'bencana.updated_at')
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
        $getIdPosko = Posko::where('bencana_id', $id)->value('id');

        $data = Bencana::select(DB::raw("concat(tanggal,' ',waktu) as waktu"),
        'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
        'bencana.nama as namaBencana', 'lokasi', 'status',
        'bencana.updated_at as waktuUpdate', 'p.bencana_id',
        DB::raw('count(p.bencana_id) as ttlPosko'),
        'p.nama as namaPosko',
        'peng.nama',
        'peng.id as idPengungsi',
        'peng.kpl_id',
        'peng.statKel',
        'peng.telpon',
        'peng.gender',
        'peng.umur',
        'peng.statPos',
        'peng.posko_id as idPospeng',
        'statKon',
        'peng.created_at as tglMasuk',
        'kpl.id as idKepala',
        'kpl.nama as namaKepala',
        'kpl.provinsi as provinsi',
        'kpl.kota as kota',
        'kpl.kecamatan as kecamatan',
        'kpl.kelurahan as kelurahan',
        'kpl.detail as detail',
        //  DB::raw('count(p.id) as ttlPengungsi')
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
        ->paginate(5);

    $getJml = Pengungsi::select('*')
    ->where('pengungsi.posko_id', '=', $getIdPosko)
    ->get();

    $getJmlPengungsi = $getJml->count();

    $getBalita = Pengungsi::select('*')
    ->where('umur', '<', 5)
    ->where('pengungsi.posko_id', '=', $getIdPosko)->get();

    $getTtlBalita = $getBalita->count();

    $getLansia = Pengungsi::select('*')
        ->where('umur', '>', 60)
        ->where('pengungsi.posko_id', '=', $getIdPosko)->get();

    $getTtlLansia = $getLansia->count();

    $getDewasa = Pengungsi::select('*')
        ->where('umur', '>', 5)
        ->where('umur', '<', 60)
        ->where('pengungsi.posko_id', '=', $getIdPosko)->get();

    $getTtlDewasa = $getDewasa->count();
    
    $getSehat = Pengungsi::select('*')
        ->where('statKon', '=', 0)
        ->where('pengungsi.posko_id', '=', $getIdPosko)->get();

    $getTtlSehat = $getSehat->count();

    $getSakit = Pengungsi::select('*')
        ->where('statKon', '>', 0)
        ->where('statKon', '<', 4)
        ->where('pengungsi.posko_id', '=', $getIdPosko)->get();

    $getTtlSakit = $getSakit->count();

    $getDifabel = Pengungsi::select('*')
        ->where('statKon', '=', 4)
        ->where('pengungsi.posko_id', '=', $getIdPosko)->get();

    $getTtlDifabel = $getDifabel->count();


        // view()->share('data', $data);
        view()->share(
        [
            'data' => $data,
            'ttlBalita' => $getTtlBalita,
            'ttlDewasa' => $getTtlDewasa,
            'ttlLansia' => $getTtlLansia,
            'ttlSehat' => $getTtlSehat,
            'ttlDifabel' => $getTtlDifabel,
            'jmlPeng' => $getJmlPengungsi,
        ]);
        $pdf = PDF::loadview('datapengungsi-pdf');
        return $pdf->download('dataPengungsi.pdf');
    }

    public function exportExcel(Request $request){
        // $data = Pengungsi::all();
        return Excel::download(new PengungsiExport($request->id), 'dataPengungsi.xlsx');
    }
}