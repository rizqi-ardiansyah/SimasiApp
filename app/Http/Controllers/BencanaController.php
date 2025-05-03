<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Integrasi;
use App\Models\Posko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BencanaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bencana = Bencana::select(DB::raw("concat(tanggal,' ',waktu) as waktu"),
            'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
            'bencana.nama as namaBencana', 'status',
            'bencana.updated_at as waktuUpdate', 'int.bencana_id', 'bencana.jmlPengungsi',
            'bencana.provinsi', 'bencana.kota', 'bencana.kecamatan', 'bencana.kelurahan',
            // DB::raw('count(int.png_id) as ttlPengungsi'),
            //  DB::raw('count(int.posko_id) as ttlPosko'),
            'bencana.jmlPosko',
            DB::raw('count(int.png_id) as ttlPengungsi'),
            DB::raw("concat(bencana.provinsi,',',' ',bencana.kota,',',' ',bencana.kecamatan,',',
             ' ',bencana.kelurahan) as alamat")
        )
            ->join('integrasi as int', 'int.bencana_id', '=', 'bencana.id')
            ->leftJoin('posko AS p', 'int.posko_id', '=', 'p.id')
            ->leftJoin('pengungsi as peng', 'int.png_id', '=', 'peng.id')
            ->orderBy('bencana.tanggal', 'desc')
            ->distinct()
        // ->where('p.bencana_id', '=', 'b.id')
        // ->where('peng.posko_id','=','p.id')
            ->groupBy('int.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
                'bencana.nama', 'status', 'bencana.provinsi', 'bencana.kota', 'bencana.kecamatan', 'bencana.kelurahan',
                'bencana.updated_at', 'bencana.jmlPengungsi', 'bencana.jmlPosko')
            ->paginate(5);

        // $getIdBencana = Bencana::where('id',$bencana)->value('id');

        $bencana2 = Bencana::select(DB::raw("concat(tanggal,' ',waktu) as waktu"),
            'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
            'bencana.nama as namaBencana', 'status',
            'bencana.updated_at as waktuUpdate', 'int.bencana_id', 'int.user_id as trc',
            DB::raw('count(int.bencana_id) as ttlPosko'), DB::raw("concat(bencana.provinsi,',',' ',bencana.kota,',',' ',
            bencana.kecamatan,',',' ',bencana.kelurahan) as alamat"), 'bencana.jmlPosko', 'bencana.jmlPengungsi'

            //  DB::raw('count(p.id) as ttlPengungsi')
        )
        // ->join('posko AS p', 'bencana.id', '=', 'p.bencana_id')
            ->join('integrasi AS int', 'bencana.id', '=', 'int.bencana_id')
        // ->join('pengungsi as peng','peng.posko_id','=','p.id')
            ->orderBy('bencana.tanggal', 'desc')
            ->distinct()
        // ->where('p.bencana_id', '=', 'b.id')
            ->groupBy('int.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
                'bencana.nama', 'status', 'bencana.updated_at', 'int.user_id', 'bencana.provinsi', 'bencana.kota',
                'bencana.kecamatan', 'bencana.kelurahan', 'bencana.jmlPosko', 'bencana.jmlPengungsi')
            ->paginate(5);

        $getTtlPengungsi = Posko::select('*')
        // ->join('bencana as b', 'posko.bencana_id', '=', 'b.id')
            ->join('integrasi as int', 'int.posko_id', '=', 'posko.id')
            ->join('bencana as b', 'b.id', '=', 'int.bencana_id')
        // ->join('pengungsi as p', 'posko.id', '=', 'p.posko_id')
            ->where('int.bencana_id', '=', 3)
            ->get();

        $ttlPeng = $getTtlPengungsi->count();

        // return view('admin.bencana.index', ['data'=>$bencana]);
        return view('admin.bencana.index', [
            'data2' => $bencana2,
            'data' => $bencana,
            'ttlPengungsi' => $ttlPeng,
        ]);

    }

    public function searchBencana(Request $request)
    {
    $cari = $request->search;

    $query = Bencana::select(
        'bencana.id as idBencana',
        DB::raw("MAX(bencana.nama) as namaBencana"),
        DB::raw("MAX(bencana.tanggal) as tgl"),
        DB::raw("MAX(bencana.waktu) as time"),
        DB::raw("MAX(bencana.status) as status"),
        DB::raw("MAX(bencana.updated_at) as waktuUpdate"),
        DB::raw("MAX(bencana.jmlPengungsi) as jmlPengungsi"),
        DB::raw("MAX(bencana.provinsi) as provinsi"),
        DB::raw("MAX(bencana.kota) as kota"),
        DB::raw("MAX(bencana.kecamatan) as kecamatan"),
        DB::raw("MAX(bencana.kelurahan) as kelurahan"),
        DB::raw("MAX(bencana.jmlPosko) as jmlPosko"),
        DB::raw("COUNT(DISTINCT int.png_id) as ttlPengungsi"),
        DB::raw("CONCAT(MAX(bencana.provinsi), ', ', MAX(bencana.kota), ', ', MAX(bencana.kecamatan), ', ', MAX(bencana.kelurahan)) as alamat")
    )
    ->join('integrasi as int', 'int.bencana_id', '=', 'bencana.id')
    ->leftJoin('posko as p', 'int.posko_id', '=', 'p.id')
    ->leftJoin('pengungsi as peng', 'int.png_id', '=', 'peng.id')
    ->groupBy('bencana.id')
    ->orderBy('tgl', 'desc');
    

    // Jika input search tidak kosong, tambahkan filter
    if (!empty($cari)) {
        $query->where(function($q) use ($cari) {
            $q->where('bencana.nama', 'LIKE', "%{$cari}%")
              ->orWhere('bencana.kelurahan', 'LIKE', "%{$cari}%");
        });
    }

    $bencana = $query->get();

    return response()->json($bencana);
    }

    

    public function searchForTrc($id)
    {
        $filter = request()->query();
        return $bencana = Bencana::select(DB::raw("concat(tanggal,' ',waktu) as waktu"),
            'tanggal as tgl', 'waktu as time', 'bencana.id as idBencana',
            'bencana.nama as namaBencana', 'lokasi', 'status',
            'bencana.updated_at as waktuUpdate', 'int.bencana_id', 'int.trc_id as trc',
            DB::raw('count(int.bencana_id) as ttlPosko'),
            //  DB::raw('count(p.id) as ttlPengungsi')
        )
        // ->join('posko AS p', 'bencana.id', '=', 'p.bencana_id')
            ->join('integrasi AS int', 'bencana.id', '=', 'int.bencana_id')
        // ->join('pengungsi as peng','peng.posko_id','=','p.id')
            ->distinct()
            ->groupBy('int.bencana_id', 'bencana.tanggal', 'bencana.waktu', 'bencana.id',
                'bencana.nama', 'lokasi', 'status', 'bencana.updated_at', 'int.trc_id')
            ->where('int.user_id', '=', $id)
            ->where(function ($query) use ($filter) {
                $query->where('bencana.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('bencana.lokasi', 'LIKE', "%{$filter['search']}%");
            })
            ->orderBy('bencana.tanggal', 'desc')
            ->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBencana(Request $request)
    {
        // if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $request->validate([
            //     'namaDepan' => ['required', 'max:50'],
            //     'namaBelakang' => ['required', 'max:50'],
            //     'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            // ]);
            $addBencana = new Bencana;
            // $role = Role::findOrFail($request->peran);
            $addBencana->nama = $request->namaBencana;
            $addBencana->tanggal = $request->tanggal;
            $addBencana->waktu = $request->waktu;
            // $addBencana->lokasi = $request->lokasi;
            $addBencana->provinsi = $request->provinsi;
            $addBencana->kota = $request->kota;
            $addBencana->kecamatan = $request->kecamatan;
            $addBencana->kelurahan = $request->kelurahan;
            $addBencana->status = $request->status;
            $addBencana->save();

            $getIdBencana = Bencana::select('id')->orderBy('id', 'desc')->value('id');
            $addIntegrasi = new Integrasi;
            $addIntegrasi->bencana_id = $getIdBencana;
            $addIntegrasi->save();

            // $addMember->assignRole($role);
            Alert::success('Success', 'Data berhasil ditambahkan');
            return back();
        // }
        // return back();
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
    public function edit(Request $request, $id)
    {
        $bencana = Bencana::where('id', $id)->first();

        // if (auth()->user()->hasAnyRole(['pusdalop'])) {
            $bencana->nama = $request->namaBencana;
            $bencana->tanggal = $request->tanggal;
            $bencana->waktu = $request->waktu;
            $bencana->provinsi = $request->provinsi;
            $bencana->kota = $request->kota;
            $bencana->kecamatan = $request->kecamatan;
            $bencana->kelurahan = $request->kelurahan;
            $bencana->status = $request->status;
            $bencana->update();
            Alert::success('Success', 'Data berhasil diubah');
            return redirect()->back();
        // }
        // return redirect()->back();
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

    public function delete($id)
    {
        // if (auth()->user()->hasAnyRole(['pusdalop'])) {
            $getIdPosko = Integrasi::select('posko_id')->where('bencana_id', $id)->value('posko_id');
            $getIdIntegrasi = Integrasi::where('bencana_id', $id)->get();
            $getPosko = Posko::where('id', $getIdPosko)->get();
            $getBencana = Bencana::where('id', $id)->get();

            $delIntegrasi = Integrasi::destroy($getIdIntegrasi);
            $delBencana = Bencana::destroy($getBencana);
            $delPosko = Posko::destroy($getPosko);

            // check data deleted or not
            if ($delIntegrasi && $delBencana == 1 || $delPosko == 1) {
                $success = true;
                $message = "Data berhasil dihapus";
            } else {
                $success = false;
                $message = "Data gagal dihapus";
            }

            //  return response
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        // }
        // return back();
    }

    public function getfrontpage()
    {
        $data = ['Balloon Fight', 'Donkey Kong', 'Excitebike'];

        return view('welcome', compact('data'));
    }
}
