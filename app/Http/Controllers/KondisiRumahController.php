<?php

namespace App\Http\Controllers;

use App\Models\Kepulangan;
use App\Models\Bencana;
use App\Models\Posko;
use App\Models\Pengungsi;
use App\Models\KepalaKeluarga;
use App\Models\Integrasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\KondisiRumah;
use App\Models\Karyawan;


class KondisiRumahController extends Controller
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
            // ->where('bencana.status', '=', 3)
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
        return view('admin.kepulangan.index', [
            'data2' => $bencana2,
            'data' => $bencana,
            'ttlPengungsi' => $ttlPeng,
        ]);

    }

    public function rumahRusak(Request $request, $id)
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
        ->where('bencana.id', $request->id)
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

    $pengungsi = Pengungsi::select(
        DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
        Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
        Daerah ',kpl.detail,' ')
    as lokasi"),
        DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
        Daerah ',kpl.detail,' ')
    as lokKel"),'kpl.detail',
        'pengungsi.nama',
        'pengungsi.id as idPengungsi',
        'int.kpl_id',
        'statKel',
        'telpon',
        'gender',
        'umur',
        'statPos',
        'int.posko_id as idPospeng',
        'statKon',
        'pengungsi.created_at as tglMasuk',
        'p.id as idPosko',
        'p.nama as namaPosko',
        'kpl.id as idKepala',
        'kpl.nama as namaKepala',
        'kpl.provinsi as provinsi',
        'kpl.kota as kota',
        'kpl.kecamatan as kecamatan',
        'kpl.kelurahan as kelurahan',
        'kpl.detail as detail',
    )
        ->join('integrasi as int','int.png_id','=','pengungsi.id')
        ->join('posko as p', 'p.id','=','int.posko_id')
        ->leftJoin('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
        // ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
        // ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
        ->where('int.bencana_id', $request->id)
        ->orderBy('int.kpl_id', 'desc')
        ->distinct()
        // model paginate agar banyak paginate bisa muncul dalam 1 page
        ->paginate(10, ['*'], 'p');

    // $pengungsi = Pengungsi::find($id);

    //     // Mengecek apakah data ditemukan
    //     if (!$pengungsi) {
    //         // Jika data tidak ditemukan, arahkan ke halaman 404 atau tampilkan pesan
    //         abort(404, 'Data pengungsi tidak ditemukan.');
    //     }

    $bencanas = DB::table('bencana')->find($id);

    // return view('admin.bencana.index', ['data'=>$bencana]);
    return view('admin.kepulangan.rumahRusak', [
        'pengungsi' => $pengungsi,
        'namaBencana' => $bencanas->nama,
        'data2' => $bencana,
        'data' => $bencana,
        'ttlPengungsi' => $ttlPeng,
    ]);
    }

    // $data = Provinces::where('name', 'LIKE', '%'.request('q').'%')->paginate(10);


    public function getData(Request $request)
    {
        // Ambil data dari database berdasarkan pencarian
        $data=[];
        if($search=$request->nama){
            $data = Pengungsi::where('nama', 'LIKE', "%$search%")->paginate(10);
        }

        return response()->json($data);

        // $search = $request->input('search');
        // $users = Pengungsi::where('nama', 'LIKE', "%{$search}%")
        //     ->select('id', 'nama')
        //     ->get();

        // // Format data untuk Select2
        // $results = $users->map(function ($user) {
        //     return [
        //         'id' => $user->id,
        //         'text' => $user->nama,
        //     ];
        // });

        // return response()->json(['results' => $results]);
    }


    public function indexPengungsi(Request $request)
    {
        
         // $this->idPosko = $id;
        //Memberikan nilai pada idPosko
        $this->idBencana = $request->bencana_id;
        $this->idPosko = $request->id;
        $this->idTrc = $request->trc_id;  
        
        session()->put('idPosko', $this->idPosko); 
        session()->put('idBencana', $this->idBencana); 
        session()->put('idTrc', $this->idTrc); 

        session()->put('idPosko', $request->id);



        $pengungsi = Pengungsi::select(
            DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
            Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokasi"),
            DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokKel"),'kpl.detail',
            'pengungsi.nama',
            'pengungsi.id as idPengungsi',
            'int.kpl_id',
            'statKel',
            'telpon',
            'gender',
            'umur',
            'statPos',
            'int.posko_id as idPospeng',
            'statKon',
            'pengungsi.created_at as tglMasuk',
            'p.id as idPosko',
            'p.nama as namaPosko',
            'kpl.id as idKepala',
            'kpl.nama as namaKepala',
            'kpl.provinsi as provinsi',
            'kpl.kota as kota',
            'kpl.kecamatan as kecamatan',
            'kpl.kelurahan as kelurahan',
            'kpl.detail as detail',
        )
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('posko as p', 'p.id','=','int.posko_id')
            ->leftJoin('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            // ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
            // ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
            ->where('int.posko_id', $request->id)
            ->orderBy('int.kpl_id', 'desc')
            ->distinct()
            // model paginate agar banyak paginate bisa muncul dalam 1 page
            ->paginate(10, ['*'], 'p');

        $pengungsiKeluar = Pengungsi::select(
            DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
            Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
             Daerah ',kpl.detail,' ')
        as lokasi"),
            DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokKel"),'kpl.detail',
            'pengungsi.nama',
            'pengungsi.id as idPengungsi',
            'int.kpl_id',
            'statKel',
            'telpon',
            'gender',
            'umur',
            'statPos',
            'int.posko_id as idPospeng',
            'statKon',
            'pengungsi.created_at as tglMasuk',
            'p.id as idPosko',
            'p.nama as namaPosko',
            'kpl.id as idKepala',
            'kpl.nama as namaKepala',
            'kpl.provinsi as provinsi',
            'kpl.kota as kota',
            'kpl.kecamatan as kecamatan',
            'kpl.kelurahan as kelurahan',
            'kpl.detail as detail',
        )
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('posko as p','p.id','=','int.posko_id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            // ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
            // ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
            ->where('int.posko_id', $request->id)
            ->where('pengungsi.statPos', 0)
            ->orderBy('int.kpl_id', 'desc')
            ->distinct()
            ->paginate(5, ['*'], 'k');


        $getKpl = KepalaKeluarga::orderBy('nama', 'asc')->get();

        $getPengungsi = Pengungsi::distinct()->get();

        $getNmPosko = Posko::select('nama')->where('id', $request->id)->get();

        $getNmBencana = Bencana::select('nama')->where('id', $request->bencana_id)->get();

        $getJmlPosko = Bencana::select('jmlPosko')->where('id', $request->bencana_id)->get();

        $dataKpl = Pengungsi::select('*', DB::raw('count(int.png_id) as ttlAnggota'))
            // ->join('kepala_keluarga as kp','kp.id','=','pengungsi.kpl_id')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->where('int.posko_id', '=', $request->id)
            ->where('pengungsi.statKel', '=', 0)
            ->groupBy(
                'int.kpl_id',
                'pengungsi.nama',
                'statKel',
                'telpon',
                'gender',
                'umur',
                'statPos',
                'int.posko_id',
                'statKon',
                'pengungsi.created_at',
                'pengungsi.updated_at',
                'pengungsi.id',
                'int.id',
                'int.png_id',
                'int.bencana_id',
                'int.user_id',
                'int.created_at',
                'int.updated_at',
            )
            ->get();

        $anggotaKpl = Integrasi::select('integrasi.kpl_id','kpl.nama',
        DB::raw("concat('Prov. ',b.provinsi,', Kota ',b.kota,',
            Kec. ',b.kecamatan,', Ds. ',b.kelurahan,',
             Daerah ',kpl.detail,' ')
        as lokasi"),'kpl.anggota','kpl.detail')
            ->join('kepala_keluarga as kpl','kpl.id','=','integrasi.kpl_id')
            ->join('pengungsi as p','p.id','=','integrasi.png_id')
            ->join('bencana as b','b.id','=','integrasi.bencana_id')
            ->where('integrasi.posko_id', '=', $request->id)
            ->where('p.statkel','=',0)
            ->distinct()
            ->groupBy(
                'integrasi.id',
                'integrasi.kpl_id',
                'integrasi.png_id',
                'integrasi.posko_id',
                'integrasi.bencana_id',
                'integrasi.user_id',
                'kpl.id',
                'kpl.anggota',
                'kpl.nama',
                'b.provinsi',
                'b.kota',
                'b.kecamatan',
                'b.kelurahan',
                'kpl.detail',
                'kpl.created_at',
                'kpl.updated_at',
                'kpl.detail'
            )
            
            ->get();


            $anggotaKpl2 = Integrasi::select('integrasi.kpl_id')
            ->join('kepala_keluarga as kpl','kpl.id','=','integrasi.kpl_id')
            ->where('integrasi.posko_id', '=', $request->id)
            
            ->get();

        $getJml = Pengungsi::select('*')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->where('int.posko_id', '=', $request->id)
            ->get();


        $getJmlAnggota = $getJml->count();
        
        $getJmlAnggotaKpl = $anggotaKpl2->count();

        $getAlamat = KepalaKeluarga::select('*', DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,',
        Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->where('kepala_keluarga.id', '=', $request->id)
            ->get();

        $getTtlKpl = $dataKpl->count();

        $getBalita = Pengungsi::select('*','pengungsi.nama','pengungsi.umur','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '<', 6)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlBalita = $getBalita->count();

        $getLansia = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"), 'kpl.detail')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '>=', 60)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlLansia = $getLansia->count();

        $getSehat = Pengungsi::select('*')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->where('statKon', '=', 0)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlSehat = $getSehat->count();

        $getSakit = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"),'kpl.detail')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('statKon', '>', 0)
            ->where('statKon', '!=', 5)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlSakit = $getSakit->count();

        $getDifabel = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"), 'kpl.detail')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('statKon', '=', 5)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlDifabel = $getDifabel->count();

        $getNmTrc = Posko::select(
            DB::raw("concat(u.firstname) as fullName")
        )
            // ->join('posko as p','pengungsi.posko_id','=','p.id')
            ->join('integrasi as int','int.posko_id','=','posko.id')
            ->join('karyawans as u', 'u.id', '=', 'int.user_id')
            ->where('posko.id', $request->id)
            ->distinct()
            ->get();

        $getMasuk = Pengungsi::select('*')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->where('statPos', '=', 1)
            ->where('int.posko_id', '=', $request->id)->get();

        $getMasuk = $getMasuk->count();

        $getKeluar = Pengungsi::select('*')
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->where('statPos', '=', 0)
            ->where('int.posko_id', '=', $request->id)->get();

        $getKeluar = $getKeluar->count();

        $getLokasi = Bencana::select( DB::raw("concat('Ds. ',kelurahan, ', Kec. ',kecamatan, ', Kota ',kota,
        ', Prov. ',provinsi) as lokasi"))
        ->join('integrasi as int','int.bencana_id','=','bencana.id')
        ->where('int.bencana_id', $request->bencana_id)
        ->get();

        return view('admin.kepulangan.index', [
            'idBencana' => $this->idBencana,
            'anggotaKpl' => $anggotaKpl,
            'pengKel' => $pengungsiKeluar,
            'data' => $pengungsi,
            'kpl' => $getKpl,
            'dataKpl' => $dataKpl,
            // 'getNama' => $getNmPosko,
            'getNama' => $getNmBencana,
            'getNmTrc' => $getNmTrc,
            'getJmlPosko' => $getJmlPosko,
            'getDifabel' => $getDifabel,
            'ttlDifabel' => $getTtlDifabel,
            'jmlAnggota' => $getJmlAnggota,
            'getJmlAnggotaKpl' => $getJmlAnggotaKpl,
            'getAlamat' => $getAlamat,
            'ttlKpl' => $getTtlKpl,
            'getBalita' => $getBalita,
            'ttlBalita' => $getTtlBalita,
            'getLansia' => $getLansia,
            'ttlLansia' => $getTtlLansia,
            'getSakit' => $getSakit,
            'ttlSakit' => $getTtlSakit,
            'getMasuk' => $getMasuk,
            'getKeluar' => $getKeluar,
            'getSehat' => $getTtlSehat,
            'getLokasi' => $getLokasi,
            'getPengungsi' => $getPengungsi
        ]);
        // return view('admin.pengungsi.index',['data' => $pengungsi],['kpl'=>$getKpl],['datas' => $pengungsi]);
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
     * @param  \App\Models\Kepulangan  $kepulangan
     * @return \Illuminate\Http\Response
     */
    public function show(Kepulangan $kepulangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kepulangan  $kepulangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kepulangan $kepulangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kepulangan  $kepulangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kepulangan $kepulangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepulangan  $kepulangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kepulangan $kepulangan)
    {
        //
    }
}
