<?php

namespace App\Http\Controllers;

use App\Models\Ransum;
use Illuminate\Http\Request;
use App\Models\Pengungsi;
use App\Models\Bencana;
use App\Models\Posko;
use Illuminate\Support\Facades\DB;
use App\Models\Integrasi;
use RealRashid\SweetAlert\Facades\Alert;

class RansumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $getBalita1 = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '<', 1)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlBalita1 = $getBalita1->count();

        $getBalita2 = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '>', 1)
            ->where('umur', '<=', 2)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlBalita2 = $getBalita2->count();

        $getBalita3 = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '>', 2)
            ->where('umur', '<=', 3)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlBalita3 = $getBalita3->count();

        $getBalita4 = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '>', 3)
            ->where('umur', '<=', 4)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlBalita4 = $getBalita4->count();

        $getDewasa = Pengungsi::select('*')
        ->join('integrasi as int','int.png_id','=','pengungsi.id')
        ->join('posko as p','p.id','=','int.posko_id')
        ->where('umur', '>', 4)
        ->where('umur', '<', 60)
        ->where('statKon', '!=', 4)
        ->where('int.posko_id', '=', $request->id)->get();

        $getDewasa = $getDewasa->count();

        $getLansia = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '>', 59)
            ->where('int.posko_id', '=', $request->id)->get();

        $getLansia = $getLansia->count();

        $getHamil = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('statKon', '=', 4)
            ->where('int.posko_id', '=', $request->id)->get();

        $getHamil = $getHamil->count();


        $getNmBencana = Bencana::select('nama')->where('id', $request->bencana_id)->get();

        $getJmlPosko = Bencana::select('jmlPosko')->where('id', $request->bencana_id)->get();

        $getNmTrc = Posko::select(
            DB::raw("concat(u.firstname,' ',u.lastname) as fullName"),"u.firstname","u.lastname"
        )
            // ->join('posko as p','pengungsi.posko_id','=','p.id')
            ->join('integrasi as int','int.posko_id','=','posko.id')
            ->join('users as u', 'u.id', '=', 'int.user_id')
            ->where('posko.id', $request->id)
            ->distinct()
            ->get();

        return view('admin.ransum.index', [
            'getTtlBalita1' => $getTtlBalita1,
            'getTtlBalita2' => $getTtlBalita2,
            'getTtlBalita3' => $getTtlBalita3,
            'getTtlBalita4' => $getTtlBalita4,
            'getDewasa' => $getDewasa,
            'getHamil' => $getHamil,
            'getLansia' => $getLansia,
            'getNama' => $getNmBencana,
            'getNmTrc' => $getNmTrc,
            'getJmlPosko' => $getJmlPosko
       
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
     * @param  \App\Models\Ransum  $ransum
     * @return \Illuminate\Http\Response
     */
    public function show(Ransum $ransum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ransum  $ransum
     * @return \Illuminate\Http\Response
     */
    public function edit(Ransum $ransum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ransum  $ransum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ransum $ransum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ransum  $ransum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ransum $ransum)
    {
        //
    }
}
