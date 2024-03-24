<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Pengungsi;
use App\Models\Posko;
use App\Models\Bencana;
use Carbon\Carbon;
use App\Models\Integrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PengungsiImport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PengungsiController extends Controller
{
    private $idBencana;
    private $idPosko;
    private $idTrc;
    // protected $idPosko;
    //Membuat variabel global idPosko
    public function _construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        as lokKel"),
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
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            // ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
            // ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
            ->where('int.posko_id', $request->id)
            ->orderBy('int.kpl_id', 'desc')
            ->distinct()
            // model paginate agar banyak paginate bisa muncul dalam 1 page
            ->paginate(5, ['*'], 'p');

        $pengungsiKeluar = Pengungsi::select(
            DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
            Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokasi"),
            DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokKel"),
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


        $getKpl = KepalaKeluarga::all();

        $getNmPosko = Posko::select('nama')->where('id', $request->id)->get();

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
        DB::raw("concat('Prov. ',provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,', Daerah ',detail,' ')
        as lokasi"),'kpl.anggota')
            ->join('kepala_keluarga as kpl','kpl.id','=','integrasi.kpl_id')
            ->join('pengungsi as p','p.id','=','integrasi.png_id')
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
                'kpl.provinsi',
                'kpl.kota',
                'kpl.kecamatan',
                'kpl.kelurahan',
                'kpl.detail',
                'kpl.created_at',
                'kpl.updated_at',
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

        $getBalita = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('umur', '<', 5)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlBalita = $getBalita->count();

        $getLansia = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
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
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('statKon', '>', 0)
            ->where('statKon', '!=', 4)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlSakit = $getSakit->count();

        $getDifabel = Pengungsi::select('*','pengungsi.nama','kpl.nama as namKep',DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,', Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->join('integrasi as int','int.png_id','=','pengungsi.id')
            ->join('kepala_keluarga as kpl','kpl.id','=','int.kpl_id')
            ->where('statKon', '=', 4)
            ->where('int.posko_id', '=', $request->id)->get();

        $getTtlDifabel = $getDifabel->count();

        $getNmTrc = Posko::select(
            DB::raw("concat(u.firstname,' ',u.lastname) as fullName")
        )
            // ->join('posko as p','pengungsi.posko_id','=','p.id')
            ->join('integrasi as int','int.posko_id','=','posko.id')
            ->join('users as u', 'u.id', '=', 'int.user_id')
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

        return view('admin.pengungsi.index', [
            'idBencana' => $this->idBencana,
            'anggotaKpl' => $anggotaKpl,
            'pengKel' => $pengungsiKeluar,
            'data' => $pengungsi,
            'kpl' => $getKpl,
            'dataKpl' => $dataKpl,
            'getNama' => $getNmPosko,
            'getNmTrc' => $getNmTrc,
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
            'getSehat' => $getTtlSehat
        ]);
        // return view('admin.pengungsi.index',['data' => $pengungsi],['kpl'=>$getKpl],['datas' => $pengungsi]);
    }

    public function search()
    {

        $filter = request()->query();
        return $pengungsi = Pengungsi::select(
            DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
            Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokasi"),
            DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokKel"),
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
            ->leftJoin('posko AS p', 'int.posko_id', '=', 'p.id')
            ->leftJoin('kepala_keluarga as kpl', 'int.kpl_id', '=', 'kpl.id')
            ->where('int.posko_id', session()->get('idPosko'))
            ->where(function ($query) use ($filter) {
                $query->where('pengungsi.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('pengungsi.telpon', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('pengungsi.umur', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.provinsi', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kota', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kecamatan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kelurahan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.detail', 'LIKE', "%{$filter['search']}%");
            })
            ->orderBy('pengungsi.nama', 'asc')
            ->distinct()
            ->get();
    }

    public function searchPengMasuk()
    {

        $filter = request()->query();
        return $pengungsi = Pengungsi::select(
            DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
            Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokasi"),
            DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokKel"),
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
            ->leftJoin('posko AS p', 'int.posko_id', '=', 'p.id')
            ->leftJoin('kepala_keluarga as kpl', 'int.kpl_id', '=', 'kpl.id')
            ->where('int.posko_id', session()->get('idPosko'))
            ->where('pengungsi.statPos', 1)
            ->where(function ($query) use ($filter) {
                $query->where('pengungsi.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('pengungsi.telpon', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('pengungsi.umur', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.provinsi', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kota', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kecamatan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kelurahan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.detail', 'LIKE', "%{$filter['search']}%");
            })
            ->orderBy('pengungsi.nama', 'asc')
            ->distinct()
            ->get();
    }

    public function searchPengKeluar()
    {

        $filter = request()->query();
        return $pengungsi = Pengungsi::select(
            DB::raw("concat('Prov. ',kpl.provinsi,', Kota ',kpl.kota,',
            Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokasi"),
            DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
            Daerah ',kpl.detail,' ')
        as lokKel"),
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
            ->leftJoin('posko AS p', 'int.posko_id', '=', 'p.id')
            ->leftJoin('kepala_keluarga as kpl', 'int.kpl_id', '=', 'kpl.id')
            ->where('int.posko_id', session()->get('idPosko'))
            ->where('pengungsi.statPos', 0)
            ->where(function ($query) use ($filter) {
                $query->where('pengungsi.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('pengungsi.telpon', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('pengungsi.umur', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.nama', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.provinsi', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kota', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kecamatan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.kelurahan', 'LIKE', "%{$filter['search']}%")
                    ->orWhere('kpl.detail', 'LIKE', "%{$filter['search']}%");
            })
            ->orderBy('pengungsi.nama', 'asc')
            ->distinct()
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPengungsi(Request $request)
    {
        // $getDataKpl =
        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $request->validate([
            //     // 'namaBelakang' => ['required', 'max:50'],
            //     // 'nama' => ['string', 'unique:posko'],
            //     // 'trc_id' => ['string', 'unique:posko'],

            // ]);

            $statKel = $request->statKel;
            $this->idBencana = $request->bencana_id;
            $this->idPosko = $request->id;
            $this->idTrc = $request->trc_id;           

            if ($statKel == 0) {
                KepalaKeluarga::create([
                    'nama' => $request->nama,
                    'provinsi' => $request->provinsi,
                    'kota' => $request->kota,
                    'kecamatan' => $request->kecamatan,
                    'kelurahan' => $request->kelurahan,
                    'detail' => $request->detail,
                ]);
                    Pengungsi::create([
                        'nama' => $request->nama,
                        'telpon' => $request->telpon,
                        'statKel' => $request->statKel,
                        'gender' => $request->gender,
                        'umur' => $request->umur,
                        'statPos' => $request->statPos,
                        // 'posko_id' => $request->posko_id,
                        'statKon' => $request->statKon,
                    ]);
                    Integrasi::create([
                        'bencana_id' => $request->bencana_id,
                        'posko_id' => $request->posko_id,
                        'user_id' => $request->trc_id,
                    ]);
                $getIdIntegrasi = Integrasi::select('id')->orderBy('id','desc')->first();
                $getIdKpl = KepalaKeluarga::select('id')->orderBy('id', 'desc')->value('id');
                $getIdPengungsi = Pengungsi::select('id')->orderBy('id', 'desc')->value('id');
                $getIdPeng = Pengungsi::select('id')->orderBy('id', 'desc')->first();
                // $getIdBencana = Bencana::select('id')->where('id', $idBencana)->get();
                // $getIdPeng->update([
                //     'kpl_id' => $getIdKpl,
                //  ]);
                 $getIdIntegrasi->update([
                    'kpl_id' => $getIdKpl,
                    'png_id' => $getIdPengungsi,
                 ]);
                //  $getIdBencana->update([
                //     'jmlPengungsi' => 
                //  ])
                // 'kplklg_id' => $request->kpl,
            } else {
                Pengungsi::create([
                    'nama' => $request->nama,
                    'telpon' => $request->telpon,
                    'statKel' => $request->statKel,
                    // 'kpl_id' => $request->kpl,
                    'gender' => $request->gender,
                    'umur' => $request->umur,
                    'statPos' => $request->statPos,
                    // 'posko_id' => $request->posko_id,
                    'statKon' => $request->statKon,
                ]);
                Integrasi::create([
                    'bencana_id' => $request->bencana_id,
                    'posko_id' => $request->posko_id,
                    'user_id' => $request->trc_id,
                ]);
                $getIdKpl = KepalaKeluarga::select('id')->orderBy('id', 'desc')->value('id');
                $getIdPengungsi = Pengungsi::select('id')->orderBy('id', 'desc')->value('id');
                $getIdIntegrasi = Integrasi::select('id')->orderBy('id','desc')->first();
                $getIdIntegrasi->update([
                    'kpl_id' => $getIdKpl,
                    'png_id' => $getIdPengungsi,
                ]);
                KepalaKeluarga::where('id', $request->kpl)
                ->update([
                    'anggota'=> DB::raw('anggota+1'), 
                    'updated_at' => Carbon::now(),
                 ]);
            }
            Bencana::where('id', $this->idBencana)
            ->update([
             'jmlPengungsi'=> DB::raw('jmlPengungsi+1'), 
             'updated_at' => Carbon::now(),
             ]);

                // $peng = Pengungsi::create($request->all());
                

            // return Redirect::to('admin/ingresos');
            Alert::success('Success', 'Data berhasil ditambahkan');
            return back();
        }
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
        $file = $request->file('file')->store('Laravel/import');

        $idBencanas = $this->idBencana;
        Excel::import(new ExcelImport, $file);
        
        // $getIdIntegrasi = Integrasi::select('id')->orderBy('id','desc')->first();
        $eksekusi = Integrasi::select('id')->whereNull('bencana_id');
        $eksekusi->update([
            'bencana_id' => $this->idBencana = session()->get('idBencana'),
            'posko_id' => $this->idPosko = session()->get('idPosko'),
            'user_id' => $this->idTrc = session()->get('idTrc'),
        ]);
        //
        Alert::success('Success', 'Data berhasil dipulihkan');
        return back();
        // return back()->withStatus('Excel file succesfully');
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
        $pengungsi = Pengungsi::where('id', $id)->first();
        $kepalaKeluarga = KepalaKeluarga::where('id', $request->kpl)->first();

        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $request->validate([
            //     // 'namaBelakang' => ['required', 'max:50'],
            //     // 'nama' => ['string', 'unique:posko'],
            //     // 'trc_id' => ['string', 'unique:posko'],

            // ]);

            $statKel = $pengungsi->statKel;

            if ($statKel == 0) {
                $pengungsi->update([
                    'nama' => $request->nama,
                    'telpon' => $request->telpon,
                    'statKel' => $request->statKel,
                    'gender' => $request->gender,
                    'umur' => $request->umur,
                    'statPos' => $request->statPos,
                    // 'posko_id' => $request->posko_id,
                    'statKon' => $request->statKon,
                ]);
                $kepalaKeluarga->update([
                    'nama' => $request->nama,
                    'provinsi' => $request->provinsi,
                    'kota' => $request->kota,
                    'kecamatan' => $request->kecamatan,
                    'kelurahan' => $request->kelurahan,
                    'detail' => $request->detail,
                ]);
                // 'kplklg_id' => $request->kpl,
            } else {
                $pengungsi->update([
                    'nama' => $request->nama,
                    'telpon' => $request->telpon,
                    'statKel' => $request->statKel,
                    // 'kpl_id' => $request->kpl,
                    'gender' => $request->gender,
                    'umur' => $request->umur,
                    'statPos' => $request->statPos,
                    // 'posko_id' => $request->posko_id,
                    'statKon' => $request->statKon,
                ]);
            }
            Alert::success('Success', 'Data berhasil diubah');
            return back();
        }
        return back();
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
        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            $getStatkel = Pengungsi::where('id', $id)->value('statKel');
            // $statKel = $getIdKepala->statKel;
            $getIdKepala = Integrasi::where('png_id', $id)->value('kpl_id');
            $getKepala = KepalaKeluarga::where('id', $getIdKepala)->value('id');

            if ($getStatkel == 0) {
                $delPengungsi = Pengungsi::destroy($id);
                $delKepala = KepalaKeluarga::destroy($getKepala);
            } else {
                $delPengungsi = Pengungsi::destroy($id);
            }

            // check data deleted or not
            if ($delPengungsi == 1 || $delKepala == 1) {
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
        }
        return back();
    }

    // show filter keluarga
    public function showKeluarga()
    {
        return view('admin.pengungsi.listKeluarga');
    }
    // show filter balita
    // show filter lansia
    // show filter sakit
}
