<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Pengungsi;
use App\Models\Integrasi;
use App\Models\Karyawan;
use App\Models\Posko;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

// use Spatie\Permission\Models\ModelHasRoles;

class PoskoController extends Controller
{
    // protected $idBencana;
    // Config::set('idBencana', 3);

    //Atur idBencana secara global
    public function _construct()
    {$this->idBencana;}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $getId = $request->id;
        $getIdBencana = Bencana::where('id', $id)->value('id');
        // $this->idBencana = $getIdBencana;
        //Memberikan nilai pada idBencana
        session()->put('idBencana', $id);

        $posko = Posko::select(
            DB::raw("concat('Prov. ',b.provinsi,', Kota ',b.kota,', Kec. ',
            b.kecamatan,', Ds. ',b.kelurahan, ' ',posko.detail)
            as lokasi"),
            'posko.id as idPosko',
            'posko.detail',
            'int.user_id as idTrc',
            'posko.nama as namaPosko',
            'kapasitas',
            'int.bencana_id',
            'b.id as idBencana',
            DB::raw("concat(u.firstname,' ',u.lastname) as fullName"), 'u.id as idAdmin','u.firstname',
            'posko.created_at',
            'posko.updated_at',
            'b.nama as namaBencana',
            'b.jmlPosko as jmlPosko',
            DB::raw('count(int.png_id) as ttlPengungsi'),
            'posko.namaPosko as namaSamaran'
        )
            ->join('integrasi as int','int.posko_id','=','posko.id')
            ->leftJoin('karyawans AS u', 'int.user_id', '=', 'u.id')
            ->join('bencana as b', 'int.bencana_id', '=', 'b.id')
            ->leftJoin('pengungsi as p', 'int.png_id', '=', 'p.id')
            ->groupBy('b.provinsi', 'b.kota', 'b.kecamatan', 'b.kelurahan', 'posko.id'
                , 'posko.nama', 'b.id', 'u.firstname', 'u.lastname', 'u.id', 'posko.created_at',
                'posko.updated_at', 'kapasitas','int.bencana_id','int.user_id','b.nama','posko.detail','b.jmlPosko','posko.namaPosko')
            ->where('int.bencana_id', $id)
            ->orderBy('u.id', 'desc')
            ->paginate(5);

            $trc = Karyawan::select(
                DB::raw("concat(firstname, ' ', lastname) as fullName"),
                'firstname',
                'lastname',
                'karyawans.email',
                'karyawans.id as idAdmin'
            )
            ->leftJoin('integrasi', 'karyawans.id', '=', 'integrasi.user_id')
            ->leftJoin('bencana', 'integrasi.bencana_id', '=', 'bencana.id')
            ->where(function($query) {
                $query->whereNull('bencana.status')
                      ->orWhere('bencana.status', '=', 0);
            })
            ->groupBy('karyawans.id', 'firstname', 'lastname', 'karyawans.email')
            ->orderBy('firstname', 'asc')
            ->get();

        // $trc = Karyawan::select(DB::raw("concat(firstname,' ',lastname) as fullName"), 'firstname',
        // 'karyawans.id as idAdmin', 'lastname')
        //     // ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
        //     // ->join('roles as r', 'r.id', '=', 'mr.role_id')
        //     // ->where(function ($query) {
        //     //     $query->where('r.id', 2)
        //     //         ->orWhere('r.id', 3);
        //     //     }) //memilih role yang akan ditampilkan (p,trc,r)
        //     ->whereNotExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('integrasi')
        //             ->whereRaw('karyawans.id = integrasi.user_id');
        //     })->get();

        $getTtlPengungsi = Pengungsi::select(DB::raw("count('int.posko_id') as ttlPengungsi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('posko as p', 'int.posko_id', '=', 'p.id')
            ->paginate(5);

        $getNmBencana= Bencana::select(
            'bencana.nama as namaBencana',
             DB::raw('bencana.jmlPosko+1 as jmlPosko'),
            // 'bencana.jmlPosko as jmlPosko',
            )
            
            // ->join('posko as p','pengungsi.posko_id','=','p.id')
            ->join('integrasi as int','int.bencana_id','=','bencana.id')
            ->where('int.bencana_id', $id)
            ->get();

        $getIdPosko = Posko::select('id')->orderBy('id','desc')->value('id');

        $getLokasi = Bencana::select( DB::raw("concat('Prov. ',provinsi,', Kota ',kota,', Kec. ',
        kecamatan,', Ds. ',kelurahan)
        as lokasi"))
        ->join('integrasi as int','int.bencana_id','=','bencana.id')
        ->where('int.bencana_id', $id)
        ->get();

        // return view('admin.posko.index', ['data'=>$posko],
        // ['getTrc'=>$trc],['getId'=>$getIdBencana],['ttlPengungsi'=>$getTtlPengungsi]);
        return view('admin.posko.index', [
            'data' => $posko,
            'getTrc' => $trc,
            'getId' => $getIdBencana,
            'ttlPengungsi' => $getTtlPengungsi,
            'getNmBencana' => $getNmBencana,
            'getIdPosko' => $getIdPosko,
            'getLokasi' => $getLokasi
        ]);

    }

    public function searchPosko(Request $request)
    {
        $cari = $request->search;
        $idBencana = $request->idBencana;
    
        $query = Posko::select(
            'posko.id as idPosko',
            DB::raw("MAX(posko.namaPosko) as namaPosko"),
            DB::raw("MAX(posko.detail) as detail"),
            DB::raw("MAX(b.id) as idBencana"),
            DB::raw("MAX(b.nama) as namaBencana"),
            DB::raw("MAX(b.status) as status"),
            DB::raw("MAX(b.provinsi) as provinsi"),
            DB::raw("MAX(b.kota) as kota"),
            DB::raw("MAX(b.kecamatan) as kecamatan"),
            DB::raw("MAX(b.kelurahan) as kelurahan"),
            DB::raw("MAX(CONCAT('Prov. ', b.provinsi, ', Kota ', b.kota, ', Kec. ', b.kecamatan, ', Ds. ', b.kelurahan, ', ', posko.detail)) as lokasi"),
            DB::raw("MAX(CONCAT(u.firstname, ' ', u.lastname)) as fullName"),
            DB::raw("MAX(posko.kapasitas) as kapasitas"),
            DB::raw("COUNT(DISTINCT int.png_id) as ttlPengungsi"),
            DB::raw("MAX(posko.created_at) as created_at"),
            DB::raw("MAX(posko.updated_at) as updated_at")
        )
        ->join('integrasi as int', 'int.posko_id', '=', 'posko.id')
        ->leftJoin('karyawans as u', 'int.user_id', '=', 'u.id')
        ->leftJoin('bencana as b', 'int.bencana_id', '=', 'b.id')
        ->leftJoin('pengungsi as p', 'int.png_id', '=', 'p.id')
        ->where('int.bencana_id', $idBencana)
        ->groupBy('posko.id')
        ->orderBy(DB::raw('MAX(posko.created_at)'), 'desc');
    
        // Jika input search tidak kosong, tambahkan filter
        if (!empty($cari)) {
            $query->where(function ($q) use ($cari) {
                $q->where('posko.nama', 'LIKE', "%{$cari}%")
                  ->orWhere('b.provinsi', 'LIKE', "%{$cari}%")
                  ->orWhere('b.kota', 'LIKE', "%{$cari}%")
                  ->orWhere('b.kecamatan', 'LIKE', "%{$cari}%")
                  ->orWhere('b.kelurahan', 'LIKE', "%{$cari}%")
                  ->orWhere('posko.detail', 'LIKE', "%{$cari}%");
            });
        }
    
        $posko = $query->get();
    
        return response()->json($posko);

        // $cari = $request->search;
        // $id = $request->idBencana;

        // $getIdBencana = Bencana::where('id', $id)->value('id');

        // $data = Posko::select(
        //     'posko.id as idPosko',
        //     DB::raw("MAX(posko.nama) as namaPosko"),
        //     DB::raw("MAX(detail) as detail"),
        //     DB::raw("MAX(b.id) as idBencana"),
        //     DB::raw("MAX(b.nama) as namaBencana"),
        //     DB::raw("MAX(b.status) as status"),
        //     DB::raw("MAX(b.provinsi) as provinsi"),
        //     DB::raw("MAX(b.kota) as kota"),
        //     DB::raw("MAX(b.kecamatan) as kecamatan"),
        //     DB::raw("MAX(b.kelurahan) as kelurahan"),
        //     DB::raw("MAX(CONCAT('Prov. ', b.provinsi, ', Kota ', b.kota, ', Kec. ', b.kecamatan, ', Ds. ', b.kelurahan, ', ', detail)) as lokasi"),
        //     DB::raw("MAX(CONCAT(u.firstname, ' ', u.lastname)) as fullName"),
        //     DB::raw("MAX(u.id) as idAdmin"),
        //     DB::raw("MAX(posko.kapasitas) as kapasitas"),
        //     DB::raw("COUNT(DISTINCT int.png_id) as ttlPengungsi"),
        //     DB::raw("MAX(posko.created_at) as created_at"),
        //     DB::raw("MAX(posko.updated_at) as updated_at")
        // )
        // ->join('integrasi as int', 'int.posko_id', '=', 'posko.id')
        // ->leftJoin('karyawans AS u', 'int.user_id', '=', 'u.id')
        // ->leftJoin('bencana as b', 'int.bencana_id', '=', 'b.id')
        // ->leftJoin('pengungsi as p', 'int.png_id', '=', 'p.id')
        // ->where('int.bencana_id', $id)
        // ->when(!empty($cari), function ($query) use ($cari) {
        //     $query->where(function ($q) use ($cari) {
        //         $q->where('posko.nama', 'LIKE', "%$cari%")
        //         ->orWhere('b.provinsi', 'LIKE', "%$cari%")
        //         ->orWhere('b.kota', 'LIKE', "%$cari%")
        //         ->orWhere('b.kecamatan', 'LIKE', "%$cari%")
        //         ->orWhere('b.kelurahan', 'LIKE', "%$cari%")
        //         ->orWhere('posko.detail', 'LIKE', "%$cari%");
        //     });
        // })
        // ->groupBy('posko.id')
        // ->orderBy('created_at', 'desc')
        // ->paginate(5);

        
        // // $getIdBencana = Bencana::where('id',$id)->value('id');
        // $cari = $request->search;
        // // $filter = request()->query();
        // $id = $request->idBencana;
        // $getIdBencana = Bencana::where('id', $id)->value('id');

        // $data = Posko::select(
        //     DB::raw("concat('Prov. ',b.provinsi,', Kota ',b.kota,', Kec. ',
        //     b.kecamatan,', Ds. ',b.kelurahan,', Daerah ',detail,' ')
        // as lokasi"),
        //     'posko.id as idPosko',
        //     'posko.nama as namaPosko',
        //     'int.user_id',
        //     'b.provinsi',
        //     'b.kota',
        //     'b.kecamatan',
        //     'b.kelurahan',
        //     'detail',
        //     'bencana_id',
        //     'b.id as idBencana',
        //     DB::raw("concat(u.firstname,' ',u.lastname) as fullName"), 'u.id as idAdmin',
        //     'posko.created_at',
        //     'posko.updated_at',
        //     DB::raw('count(int.posko_id) as ttlPengungsi'), 'kapasitas',
        // )
        //     ->leftJoin('integrasi as int','int.posko_id','=','posko.id')
        //     ->leftJoin('karyawans AS u', 'int.user_id', '=', 'u.id')
        //     ->leftJoin('bencana as b', 'int.bencana_id', '=', 'b.id')
        //     ->leftJoin('pengungsi as p', 'int.png_id', '=', 'p.id')
        //     ->groupBy('lokasi', 'b.provinsi', 'b.kota', 'b.kecamatan', 'b.kelurahan', 'detail', 'posko.id'
        //         , 'posko.nama', 'int.bencana_id', 'b.id', 'u.firstname', 'u.lastname', 'u.id', 'posko.created_at',
        //         'posko.updated_at','posko.kapasitas', 'int.user_id')
        //     ->where('int.bencana_id', $id)
        //     // ->where('int.user_id', $id)
        //     ->where(function ($query) use ($cari) {
        //         $query->where('posko.nama', 'LIKE', "%".$cari."%")
        //         ->orWhere('b.provinsi', 'LIKE', "%".$cari."%")
        //         ->orWhere('b.kota', 'LIKE', "%".$cari."%")
        //         ->orWhere('b.kecamatan', 'LIKE', "%".$cari."%")
        //         ->orWhere('b.kelurahan', 'LIKE', "%".$cari."%")
        //         ->orWhere('posko.detail', 'LIKE', "%".$cari."%");
        //     })
        //     ->paginate(5);

        //     $trc = Karyawan::select(
        //         DB::raw("concat(firstname, ' ', lastname) as fullName"),
        //         'firstname',
        //         'lastname',
        //         'karyawans.email',
        //         'karyawans.id as idAdmin'
        //     )
        //     ->leftJoin('integrasi', 'karyawans.id', '=', 'integrasi.user_id')
        //     ->leftJoin('bencana', 'integrasi.bencana_id', '=', 'bencana.id')
        //     ->where(function($query) {
        //         $query->whereNull('bencana.status')
        //               ->orWhere('bencana.status', '=', 0);
        //     })
        //     ->groupBy('karyawans.id', 'firstname', 'lastname', 'karyawans.email')
        //     ->orderBy('firstname', 'asc')
        //     ->get();
    


        //     $trc = User::select(DB::raw("concat(firstname,' ',lastname) as fullName"), 'firstname',
        // 'karyawans.id as idAdmin', 'lastname')
        //     // ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
        //     // ->join('roles as r', 'r.id', '=', 'mr.role_id')
        //     // ->where(function ($query) {
        //     //     $query->where('r.id', 2)
        //     //         ->orWhere('r.id', 3);
        //     //     }) //memilih role yang akan ditampilkan (p,trc,r)
        //     ->whereNotExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('integrasi')
        //             ->whereRaw('karyawans.id = integrasi.user_id');
        //     })->get();

        // $getTtlPengungsi = Pengungsi::select(DB::raw("count('int.posko_id') as ttlPengungsi"))
        //     ->join('integrasi as int','int.png_id','=','pengungsi.id')
        //     ->join('posko as p', 'int.posko_id', '=', 'p.id')
        //     ->paginate(5);

        // $getNmBencana= Bencana::select(
        //     'bencana.nama as namaBencana',
        //      DB::raw('bencana.jmlPosko+1 as jmlPosko'),
        //     // 'bencana.jmlPosko as jmlPosko',
        //     )
            
        //     // ->join('posko as p','pengungsi.posko_id','=','p.id')
        //     ->join('integrasi as int','int.bencana_id','=','bencana.id')
        //     ->where('int.bencana_id', $id)
        //     ->get();

        // $getIdPosko = Posko::select('id')->orderBy('id','desc')->value('id');

        // $getLokasi = Bencana::select( DB::raw("concat('Prov. ',provinsi,', Kota ',kota,', Kec. ',
        // kecamatan,', Ds. ',kelurahan)
        // as lokasi"))
        // ->join('integrasi as int','int.bencana_id','=','bencana.id')
        // ->where('int.bencana_id', $id)
        // ->get();

            // return view('admin.posko.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
            // return view('admin.posko.index', [
            //     'data' => $data,
                // 'getTrc' => $trc,
                // 'getId' => $getIdBencana,
                // 'ttlPengungsi' => $getTtlPengungsi,
                // 'getNmBencana' => $getNmBencana,
                // 'getIdPosko' => $getIdPosko,
                // 'getLokasi' => $getLokasi
            // ]);
       
    }

    public function searchPoskoTrc($id)
    {
        // $getIdBencana = Bencana::where('id',$id)->value('id');
        $filter = request()->query();
        return $posko = Posko::select(
            DB::raw("concat('Prov. ',provinsi,', Kota ',kota,', Kec. ',
            kecamatan,', Ds. ',kelurahan,', Daerah ',detail,' ')
        as lokasi"),
            'posko.id as idPosko',
            'posko.nama as namaPosko',
            'posko.kapasitas',
            'provinsi',
            'kota',
            'kecamatan',
            'kelurahan',
            'detail',
            'bencana_id',
            'b.id as idBencana',
            DB::raw("concat(u.firstname,' ',u.lastname) as fullName"), 'u.id as idAdmin',
            'posko.created_at',
            'posko.updated_at',
            DB::raw('count(p.posko_id) as ttlPengungsi'),
        )
            ->leftJoin('integrasi as int','int.posko_id','=','posko.id')
            ->leftJoin('karyawans AS u', 'int.user_id', '=', 'u.id')
            ->leftJoin('bencana as b', 'int.bencana_id', '=', 'b.id')
            ->leftJoin('pengungsi as p', 'int.png_id', '=', 'p.id')
            ->groupBy('lokasi', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'detail', 'posko.id'
                , 'posko.nama', 'int.bencana_id', 'b.id', 'u.firstname', 'u.lastname', 'u.id', 'posko.created_at',
                'posko.updated_at','posko.kapasitas')
            ->where('integrasi.user_id', $id)
            ->where(function ($query) use ($filter) {
                $query->where('posko.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('posko.provinsi', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('posko.kota', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('posko.kecamatan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('posko.kelurahan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('posko.detail', 'LIKE', "%{$filter['search']}%");
            })
            ->get();
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPosko(Request $request)
    {
        // if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $request->validate([
            //     // 'namaBelakang' => ['required', 'max:50'],
            //     'nama' => ['string', 'unique:posko'],
            //     // 'trc_id' => ['string', 'unique:posko'],
            // ]);
            Posko::create([
                'nama' => $request->nama,
                'namaPosko' => $request->namaSamaran,
                'detail' => $request->detail_lokasi,
                'kapasitas' => $request->kapasitas
            ]);
            Integrasi::create([
                'bencana_id' => $request->session()->get('idBencana'),
            ]);
            Bencana::where('id', $request->session()->get('idBencana'))
            ->update([
                'jmlPosko'=> DB::raw('jmlPosko+1'), 
                'updated_at' => Carbon::now(),
             ]);
            // $addPosko = new Posko;
            // $addPosko->nama = $request->nama;
            // $addPosko->detail = $request->detail_lokasi;
            // $addPosko->kapasitas = $request->kapasitas;
            // // $addPosko->trc_id = $request->trc_id;
            // // $addPosko->bencana_id = $request->idBencana;
            // $addPosko->save();

            $eksekusi = Integrasi::select('id')->whereNull('posko_id')->where('bencana_id',session()->get('idBencana'))->first();
            $getIdPosko = Posko::select('id')->orderBy('id','desc')->value('id');
            $getIdTrc = $request->trc_id;
            $eksekusi->update([
                'posko_id' => $getIdPosko,
                'user_id' => $getIdTrc,
            ]);
         
          
            // $getIdIntegrasi = Integrasi::select('id')->where('bencana_id',session()->get('idBencana'))->first();
            // $getIdIntegrasi->posko_id = $getIdPosko;
            // $getIdIntegrasi->user_id = $getIdTrc;
            // $getIdIntegrasi->update();
            
            Alert::success('Success', 'Data berhasil ditambahkan');
        //     return back();
        // }
        return back();
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
        $posko = Posko::where('id', $id)->first();
        $request->validate([
            // Akan melakukan validasi kecuali punyanya sendiri
            'nama' => ['string', Rule::unique('posko')->ignore($id)],
        ]);
        
        $posko = Posko::where('id', $id)->first();

        // if (auth()->user()->hasAnyRole(['pusdalop'])) {
            $posko->namaPosko = $request->namaSamaran;
            // $posko->provinsi = $request->provinsi;
            // $posko->kota = $request->kota;
            // $posko->kecamatan = $request->kecamatan;
            // $posko->kelurahan = $request->kelurahan;
            $posko->detail = $request->detail_lokasi;
            $posko->update();

            $eksekusi =  Integrasi::where('posko_id', $id)->update(['user_id' => $request->trc_id]);
            
            // $eksekusi = Integrasi::select('id')->where('posko_id',$id)->get();
            // $getIdPosko = Posko::select('id')->orderBy('id','desc')->value('id');
            // $getIdTrc = $request->trc_id;
            // $eksekusi->update([
            //     'posko_id' => $getIdPosko,
            //     'user_id' => $getIdTrc,
            // ]);
            // $eksekusi->user_id = $request->trc_id;
            // $eksekusi->update();
            // $member->syncRoles($role);
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

    public function delete(Request $request, $id)
    {
        // if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $delete = Posko::destroy($id);yy
            Bencana::where('id', $request->session()->get('idBencana'))
            ->update([
                'jmlPosko'=> DB::raw('jmlPosko-1'), 
                'updated_at' => Carbon::now(),
             ]);

            // $getIdBencana = Integrasi::select('bencana_id')->where('posko_id', $id)->value('bencana_id');
            $getIdIntegrasi = Integrasi::where('posko_id', $id)->value('id');
            $getPosko = Posko::where('id', $id)->value('id');
            // $getBencana = Bencana::where('id', $getIdBencana)->value('id');
            
            $delIntegrasi = Integrasi::destroy($getIdIntegrasi);
            // $delBencana = Bencana::destroy($getBencana);
            $delPosko = Posko::destroy($getPosko);

            // check data deleted or not
            if ($delIntegrasi == 1 && $delPosko == 1) {
                $success = true;
                $message = "Data berhasil dihapus";
            } else {
                $success = true;
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
}