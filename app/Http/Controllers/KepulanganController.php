<?php

namespace App\Http\Controllers;

use App\Models\Kepulangan;
use App\Models\Bencana;
use App\Models\Posko;
use App\Models\Pengungsi;
use App\Models\KepalaKeluarga;
use App\Models\Integrasi;
use App\Models\User;
use App\Models\KondisiRumah;
use App\Models\KondisiSekitar;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
// use Image;
use Intervention\Image\Facades\Image as Image;

class KepulanganController extends Controller
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
             ' ',bencana.kelurahan) as alamat"),
            DB::raw("COUNT(CASE WHEN int.kondisiRumah_id IS NOT NULL THEN 1 END) as jumlahRumahRusak"),
            DB::raw('MIN(int.user_id) as trc_id') 
        )
            ->join('integrasi as int', 'int.bencana_id', '=', 'bencana.id')
            // ->join('kondisi_rumah as kr','kr.id','=','integrasi.kondisiRumah_id')

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
            // ->where('int.posko_id', $request->id)
            ->orderBy('int.kpl_id', 'desc')
            ->distinct()
            // model paginate agar banyak paginate bisa muncul dalam 1 page
            ->get();

        $getPosko = Posko::select('*','int.bencana_id as idBencana','int.posko_id as idPosko')
        ->join('integrasi as int','int.posko_id','=','posko.id')
        ->join('bencana as b','b.id','=','int.bencana_id')
        ->distinct()
        ->where('b.status','=',3)
        ->get();

        // return view('admin.bencana.index', ['data'=>$bencana]);
        return view('admin.kepulangan.index', [
            'pengungsi' => $pengungsi,
            'posko' => $getPosko,
            'data2' => $bencana2,
            'data' => $bencana,
            'ttlPengungsi' => $ttlPeng,
        ]);

    }

    public function poskoKepulangan($id){
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
                'posko.namaPosko as namaSamaran',
                DB::raw("COUNT(CASE WHEN int.kondisiRumah_id IS NOT NULL THEN 1 END) as jumlahRumahRusak"),
                // 'kr.namaPosko as namaSamaran'
            )
                ->join('integrasi as int','int.posko_id','=','posko.id')
                ->leftJoin('users AS u', 'int.user_id', '=', 'u.id')
                ->join('bencana as b', 'int.bencana_id', '=', 'b.id')
                // ->join('kondisi_rumah as kr','kr.id','=','integrasi.kondisiRumah_id')
                ->leftJoin('pengungsi as p', 'int.png_id', '=', 'p.id')
                ->groupBy('b.provinsi', 'b.kota', 'b.kecamatan', 'b.kelurahan', 'posko.id'
                    , 'posko.nama', 'b.id', 'u.firstname', 'u.lastname', 'u.id', 'posko.created_at',
                    'posko.updated_at', 'kapasitas','int.bencana_id','int.user_id','b.nama','posko.detail','b.jmlPosko','posko.namaPosko')
                ->where('int.bencana_id', $id)
                ->orderBy('u.id', 'desc')
                ->paginate(5);

        $trc = User::select(DB::raw("concat(firstname,' ',lastname) as fullName"), 'firstname',
        'users.id as idAdmin', 'lastname')
            ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->where(function ($query) {
                $query->where('r.id', 2)
                    ->orWhere('r.id', 3);
                }) //memilih role yang akan ditampilkan (p,trc,r)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('integrasi')
                    ->whereRaw('users.id = integrasi.user_id');
            })->get();

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
        return view('admin.kepulangan.poskoKepulangan', [
            'data' => $posko,
            'getTrc' => $trc,
            'getId' => $getIdBencana,
            'ttlPengungsi' => $getTtlPengungsi,
            'getNmBencana' => $getNmBencana,
            'getIdPosko' => $getIdPosko,
            'getLokasi' => $getLokasi
        ]);
    }

    public function rumahRusak(Request $request, $id)
    {
        $kondisiRumah = Integrasi::select('integrasi.kpl_id','kpl.nama',
        DB::raw("concat('Prov. ',b.provinsi,', Kota ',b.kota,',
            Kec. ',b.kecamatan,', Ds. ',b.kelurahan,',
             Daerah ',kpl.detail,' ','')
        as lokasi"),'kpl.anggota','kpl.detail','integrasi.png_id','integrasi.kondisiRumah_id','p.nama as namaPengungsi',
        DB::raw("concat(kr.tanggal,' ',kr.waktu) as ketWaktu"), DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
        Daerah ',kpl.detail,' ') as lokKel"),'kr.picRumah','kr.status','kr.updated_at','kr.id as idKr','kr.tanggal','kr.waktu',
        'kr.keterangan')
            ->leftJoin('kepala_keluarga as kpl','kpl.id','=','integrasi.kpl_id')
            ->join('pengungsi as p','p.id','=','integrasi.png_id')
            ->join('bencana as b','b.id','=','integrasi.bencana_id')
            ->join('kondisi_rumah as kr','kr.id','=','integrasi.kondisiRumah_id')
            ->where('integrasi.posko_id', '=', $request->id)
            // ->where('p.statkel','=',0)
            // ->distinct()
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
                'kpl.detail',
                'integrasi.kondisiRumah_id',
                'p.nama','kr.tanggal','kr.waktu','kpl.provinsi','kpl.kota','kpl.kecamatan','kpl.kelurahan','kpl.detail',
                'kr.picRumah','kr.status','kr.updated_at','kr.id','kr.keterangan'
            )
            
            ->paginate(5);


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
         ' ',bencana.kelurahan) as alamat"), 
    )
        ->join('integrasi as int', 'int.bencana_id', '=', 'bencana.id')
        ->leftJoin('posko AS p', 'int.posko_id', '=', 'p.id')
        ->leftJoin('pengungsi as peng', 'int.png_id', '=', 'peng.id')
        ->orderBy('bencana.tanggal', 'desc')
        ->distinct()
        ->where('bencana.id', $request->bencana_id)
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

    $posko = DB::table('posko')->find($id);

    // return view('admin.bencana.index', ['data'=>$bencana]);
    return view('admin.kepulangan.rumahRusak', [
        'kondisiRumah' => $kondisiRumah,
        'pengungsi' => $pengungsi,
        'namaPosko' => $posko->namaPosko,
        'data2' => $bencana,
        'data' => $bencana,
    ]);
    }

    public function kondisiSekitar(Request $request, $id)
    {
        $kondisiSekitar = Integrasi::select('integrasi.kpl_id','kpl.nama',
        DB::raw("concat('Prov. ',b.provinsi,', Kota ',b.kota,',
            Kec. ',b.kecamatan,', Ds. ',b.kelurahan,',
             Daerah ',kpl.detail,' ','')
        as lokasi"),'kpl.anggota','kpl.detail','integrasi.png_id','integrasi.kondisiSekitar_id','p.nama as namaPengungsi',
        DB::raw("concat(kr.tanggal,' ',kr.waktu) as ketWaktu"), DB::raw("concat('Kec. ',kpl.kecamatan,', Ds. ',kpl.kelurahan,',
        Daerah ',kpl.detail,' ') as lokKel"),'kr.picLokasi','kr.status','kr.updated_at','kr.id as idKr','kr.tanggal','kr.waktu',
        'kr.idKepala','kr.keterangan')
            ->leftJoin('kepala_keluarga as kpl','kpl.id','=','integrasi.kpl_id')
            ->leftJoin('pengungsi as p','p.id','=','integrasi.png_id')
            ->join('bencana as b','b.id','=','integrasi.bencana_id')
            ->join('kondisi_sekitar as kr','kr.id','=','integrasi.kondisiSekitar_id')
            ->where('integrasi.bencana_id', '=', $request->bencana_id)
            ->whereNotNull('integrasi.bencana_id')
            ->whereNotNull('integrasi.kondisiSekitar_id')
            // ->where('p.statkel','=',0)
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
                'kpl.detail',
                'integrasi.kondisiSekitar_id',
                'p.nama','kr.tanggal','kr.waktu','kpl.provinsi','kpl.kota','kpl.kecamatan','kpl.kelurahan','kpl.detail',
                'kr.picLokasi','kr.status','kr.updated_at','kr.id','kr.idKepala','kr.keterangan'
            )
            
            ->paginate(5);


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
         ' ',bencana.kelurahan) as alamat"), 
    )
        ->join('integrasi as int', 'int.bencana_id', '=', 'bencana.id')
        ->leftJoin('posko AS p', 'int.posko_id', '=', 'p.id')
        ->leftJoin('pengungsi as peng', 'int.png_id', '=', 'peng.id')
        ->orderBy('bencana.tanggal', 'desc')
        ->distinct()
        ->where('bencana.id', $request->bencana_id)
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
        ->where('int.bencana_id', $request->bencana_id)
        ->orderBy('int.kpl_id', 'desc')
        ->distinct()
        // model paginate agar banyak paginate bisa muncul dalam 1 page
        ->paginate(10, ['*'], 'p');

    $posko = DB::table('posko')->find($id);

    $namaBencana = Bencana::where('id', $request->id)->value('nama');

    // return view('admin.bencana.index', ['data'=>$bencana]);
    return view('admin.kepulangan.kondisiSekitar', [
        'kondisiSekitar' => $kondisiSekitar,
        'pengungsi' => $pengungsi,
        'namaPosko' => $posko->namaPosko,
        'data' => $bencana,
        'namaBencana' => $namaBencana,
    ]);
    }


    public function getData(Request $request)
    {
        // Ambil data dari database berdasarkan pencarian
        $data=[];
        if($search=$request->nama){
            $data = Pengungsi::where('nama', 'LIKE', "%$search%")->paginate(10);
        }

        return response()->json($data);
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
    public function createRumah(Request $request)
    {
        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $request->validate([
            //     'namaDepan' => ['required', 'max:50'],
            //     'namaBelakang' => ['required', 'max:50'],
            //     'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            // ]);
            $request->validate([
                'picRumah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Bisa upload sampai 5MB
            ]);
            $selectedIds = $request->carinama;
            foreach ($selectedIds as $id) {
                $addRumah = new KondisiRumah;
                $addRumah->tanggal = $request->tanggal;
                $addRumah->waktu = $request->waktu;
                // $addRumah->idPengungsi = $id;

                if ($id == 0) {
                    // Jika user memilih "Tidak ada", maka isi nama dan alamat manual
                    $addPengungsi = new Pengungsi;
                    $addPengungsi->nama = $request->namaPemilikBaru;
                    $addPengungsi->alamat = $request->alamatPemilikBaru;
                    $addPengungsi->telpon = null;
                    $addPengungsi->statKel = null;
                    $addPengungsi->gender = null;
                    $addPengungsi->umur = null;
                    $addPengungsi->statPos = null;
                    $addPengungsi->statKon = null;
                    $addPengungsi->save();

                    $getIdPengungsiBaru = Pengungsi::select('id')->orderBy('id', 'desc')->value('id');
                    $addRumah->idPengungsi = $getIdPengungsiBaru;

                    $addIntegrasi = new Integrasi;
                    $addIntegrasi->kpl_id  = null;
                    $addIntegrasi->png_id  = $getIdPengungsiBaru;
                    $addIntegrasi->posko_id  = $request->posko_id;
                    $addIntegrasi->bencana_id  = $request->bencana_id;
                    $addIntegrasi->user_id  = $request->trc_id;
                    $addIntegrasi->save();
                    // $addRumah->nama = $request->namaPemilikBaru;
                    // $addRumah->alamat = $request->alamatPemilikBaru;
                    // $addRumah->idPengungsi = null; // atau biarkan null jika tidak berkaitan dengan tabel pengungsi
                } else {
                    $addRumah->idPengungsi = $id;
                }

                    if ($request->hasFile('picRumah')) {
                        $file = $request->file('picRumah');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time().'.'.$extension; // Nama unik untuk file

                        // Cek ukuran file sebelum diproses
                        if ($file->getSize() > 2048000) { // Jika lebih dari 2MB
                            $image = Image::make($file)->resize(1024, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode('jpg', 75); // Kualitas 75% untuk kompresi
                            $image->save(public_path('storage/images/') . $filename);
                            // $file->storeAs('public/images', $filename);
                        } else {
                            // Simpan gambar tanpa kompresi jika sudah di bawah 2MB
                            $file->move(public_path('storage/images'), $filename);
                            // $image->save(public_path('storage/images/') . $filename);
                        }

                        // $file->move('images/', $filename);
                        // $file->storeAs('public/images', $filename);
                        $addRumah->picRumah = $filename;
                    }
                $addRumah->status = $request->status;
                $addRumah->keterangan = $request->keterangan;
                $addRumah->save();

                
                $getIdPengungsi = KondisiRumah::select('idPengungsi')->orderBy('id', 'desc')->value('idPengungsi');
                // $getIdPengungsi = $id;
                $getIdKondisiRumah = KondisiRumah::select('id')->orderBy('id', 'desc')->value('id');
    
                Integrasi::where('png_id', $getIdPengungsi)
                ->update([
                 'kondisiRumah_id'=> $getIdKondisiRumah,
                 'updated_at' => Carbon::now(),
                 ]);
    
            }
            Alert::success('Success', 'Data berhasil ditambahkan');
            return back();
        }
        return back();
    }

    public function editRumahRusak(Request $request, $id)
    {
        $editRumah = KondisiRumah::where('id', $id)->first();
        $request->validate([
            // Akan melakukan validasi kecuali punyanya sendiri
            'nama' => ['string', Rule::unique('posko')->ignore($id)],
        ]);
        
        // $posko = Posko::where('id', $id)->first();

        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $request->validate([
            //     'namaDepan' => ['required', 'max:50'],
            //     'namaBelakang' => ['required', 'max:50'],
            //     'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            // ]);
            // $request->validate([
            //     'picRumah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Bisa upload sampai 5MB
            // ]);
            $selectedIds = $request->carinama;
            foreach ($selectedIds as $id) {
                // $addRumah = new KondisiRumah;
                $editRumah->tanggal = $request->tanggal;
                $editRumah->waktu = $request->waktu;
                $editRumah->idPengungsi = $id;
                if ($request->hasFile('picRumah')) {
                    $file = $request->file('picRumah');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension; // Nama unik untuk file

                     // Cek ukuran file sebelum diproses
                    if ($file->getSize() > 2048000) { // Jika lebih dari 2MB
                        $image = Image::make($file)->resize(1024, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->encode('jpg', 75); // Kualitas 75% untuk kompresi
                        $image->save(public_path('storage/images/') . $filename);
                        // $file->storeAs('public/images', $filename);
                    } else {
                        // Simpan gambar tanpa kompresi jika sudah di bawah 2MB
                        $file->move('storage/images/', $filename);
                        // $file->storeAs('storage/images/', $filename);
                        // $file->save(public_path('storage/images/') . $filename);
                    }

                    // $file->move('images/', $filename);
                    // $file->storeAs('public/images', $filename);
                    $editRumah->picRumah = $filename;
                }
                $editRumah->status = $request->status;
                $editRumah->save();

                $getIdPengungsi = KondisiRumah::select('idPengungsi')->orderBy('id', 'desc')->value('idPengungsi');
                $getIdKondisiRumah = KondisiRumah::select('id')->orderBy('id', 'desc')->value('id');
    
                Integrasi::where('png_id', $getIdPengungsi)
                ->update([
                 'kondisiRumah_id'=> $getIdKondisiRumah,
                 'updated_at' => Carbon::now(),
                 ]);
    
            }

            Alert::success('Success', 'Data berhasil diubah');
            return back();
        }
        return redirect()->back();
    }

    public function createKondisi(Request $request)
    {
        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $request->validate([
            //     'namaDepan' => ['required', 'max:50'],
            //     'namaBelakang' => ['required', 'max:50'],
            //     'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            // ]);
            $request->validate([
                'picLokasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Bisa upload sampai 5MB
            ]);
            $selectedIds = $request->cariAlamat;
            foreach ($selectedIds as $id) {
                $addKondisi = new KondisiSekitar;
                $addKondisi->tanggal = $request->tanggal;
                $addKondisi->waktu = $request->waktu;
                $addKondisi->alamat = null;
                // $addKondisi->idKepala = $request->idKepala;
                // $addRumah->idPengungsi = $id;

                if ($id == 0) {
                    // Jika user memilih "Tidak ada", maka isi nama dan alamat manual
                    // $addKondisi = new ;
                    $addKondisi->alamat = $request->alamatBaru;
                    $addKondisi->idKepala = null;
                    // $addPengungsi->alamat = $request->alamatPemilikBaru;
                    // $addKondisisi->picLokasi = null;

                    // $addKondisi->keterangan = null;
                    // $addPengungsi->gender = null;
                    // $addPengungsi->umur = null;
                    // $addPengungsi->statPos = null;
                    // $addPengungsi->statKon = null;
                    // $addPengungsi->save();

                    // $getIdPengungsiBaru = Pengungsi::select('id')->orderBy('id', 'desc')->value('id');
                    // $addRumah->idPengungsi = $getIdPengungsiBaru;

                    $addIntegrasi = new Integrasi;
                    $addIntegrasi->kpl_id  = null;
                    $addIntegrasi->png_id  = null;
                    $addIntegrasi->posko_id  = null;
                    $addIntegrasi->bencana_id  = $request->bencana_id;
                    $addIntegrasi->user_id  = null;
                    $addIntegrasi->kondisiRumah_id  = null;
                    $addIntegrasi->kondisiSekitar_id  = null;
                    $addIntegrasi->save();
                    // $addRumah->nama = $request->namaPemilikBaru;
                    // $addRumah->alamat = $request->alamatPemilikBaru;
                    // $addRumah->idPengungsi = null; // atau biarkan null jika tidak berkaitan dengan tabel pengungsi
                } else {
                    $addKondisi->idKepala = $id;
                }

                    if ($request->hasFile('picLokasi')) {
                        $file = $request->file('picLokasi');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time().'.'.$extension; // Nama unik untuk file

                        // Cek ukuran file sebelum diproses
                        if ($file->getSize() > 2048000) { // Jika lebih dari 2MB
                            $image = Image::make($file)->resize(1024, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode('jpg', 75); // Kualitas 75% untuk kompresi
                            $image->save(public_path('storage/images/') . $filename);
                            // $file->storeAs('public/images', $filename);
                        } else {
                            // Simpan gambar tanpa kompresi jika sudah di bawah 2MB
                            $file->move(public_path('storage/images'), $filename);
                            // $image->save(public_path('storage/images/') . $filename);
                        }

                        // $file->move('images/', $filename);
                        // $file->storeAs('public/images', $filename);
                        $addKondisi->picLokasi = $filename;
                    }
                $addKondisi->status = $request->status;
                $addKondisi->keterangan = $request->keterangan;
                $addKondisi->save();

                
                // $getIdIntgerasi = KondisiSekitar::select('idKepala')->orderBy('id', 'desc')->value('idKepala');
                // $getIdKpl = $id;
                // $getIdKondisiSekitar = kondisiSekitar::select('id')->orderBy('id', 'desc')->value('id');
    
                // Integrasi::where('kpl_id', $id)
                // ->update([
                //  'kondisiSekitar_id'=> $getIdKondisiSekitar,
                //  'updated_at' => Carbon::now(),
                //  ]);

                $lastKondisiSekitar = KondisiSekitar::orderBy('id', 'desc')->first();

                if ($lastKondisiSekitar->idKepala != null) {
                    // Jika kpl_id tidak null → update berdasarkan kpl_id
                    Integrasi::where('kpl_id', $lastKondisiSekitar->idKepala)
                        ->update([
                            'kondisiSekitar_id' => $lastKondisiSekitar->id,
                            'updated_at' => Carbon::now(),
                        ]);
                } else {
                    // Jika kpl_id null → insert baris baru ke tabel Integrasi
                    Integrasi::create([
                        'kondisiSekitar_id' => $lastKondisiSekitar->id,
                        'bencana_id' =>  $request->bencana_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        // tambahkan field lain yang wajib diisi (jika ada)
                    ]);
                }
    
            }
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
    public function delete(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $delete = Posko::destroy($id);yy
            Integrasi::where('kondisiRumah_id', $id)
            ->update([
                'kondisiRumah_id'=> DB::raw('NULL')
             ]);

            // $getIdBencana = Integrasi::select('bencana_id')->where('posko_id', $id)->value('bencana_id');
            $getIdKondisiRumah = KondisiRumah::where('id', $id)->value('id');
            // $getPosko = Posko::where('id', $id)->value('id');
            // $getBencana = Bencana::where('id', $getIdBencana)->value('id');
            
            $delIntegrasi = KondisiRumah::destroy($getIdKondisiRumah);
            // $delBencana = Bencana::destroy($getBencana);
            // $delPosko = Posko::destroy($getPosko);

            // check data deleted or not
            if ($delIntegrasi == 1) {
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
        }
        return back();
    }
}
