<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Pengungsi;
use App\Models\Posko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PengungsiController extends Controller
{
    // protected $idPosko;
    //Membuat variabel global idPosko
    public function _construct()
    {
        $this->idPosko;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $this->idPosko = $id;
        //Memberikan nilai pada idPosko
        session()->put('idPosko', $id);
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
            'kpl_id',
            'statKel',
            'telpon',
            'gender',
            'umur',
            'statPos',
            'pengungsi.posko_id as idPospeng',
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
            ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
            ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
            ->where('pengungsi.posko_id', $id)
            ->orderBy('pengungsi.kpl_id', 'desc')
            ->distinct()
            ->paginate(5);

        $getKpl = KepalaKeluarga::all();

        // $dataKpl = KepalaKeluarga::select('kepala_keluarga.id','kepala_keluarga.nama',
        // DB::raw('count(p.kpl_id) as ttlAnggota'),DB::raw("concat('Prov. ',provinsi,',
        // Kota ',kota,',Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ') as lokasi"))
        // ->join('pengungsi as p','kepala_keluarga.id','=','p.kpl_id')
        // ->where('p.statKel','=',0)
        // ->groupBy('kepala_keluarga.id','kepala_keluarga.nama','lokasi')
        // ->distinct()
        // ->paginate(5);

        // $dataKpl = Pengungsi::select('nama')

        $getNmPosko = Posko::select('nama')->where('id', $id)->get();

        $dataKpl = Pengungsi::select('*', DB::raw('count(kpl_id) as ttlAnggota'))
            // ->join('kepala_keluarga as kp','kp.id','=','pengungsi.kpl_id')
            ->where('pengungsi.posko_id', '=', $id)
            ->where('pengungsi.statKel', '=', 0)
            ->groupBy(
                'kpl_id',
                'pengungsi.nama',
                'statKel',
                'telpon',
                'gender',
                'umur',
                'statPos',
                'posko_id',
                'statKon',
                'pengungsi.created_at',
                'pengungsi.updated_at',
                'pengungsi.id',
            )
            ->get();

        $getJml = Pengungsi::select('*')
            ->where('pengungsi.posko_id', '=', $id)
            ->get();

        $getAlamat = KepalaKeluarga::select('*', DB::raw("concat('Prov. ',
        provinsi,', Kota ',kota,',
        Kec. ',kecamatan,', Ds. ',kelurahan,',Daerah ',detail,' ')
        as lokasi"))
            ->where('kepala_keluarga.id', '=', $id)
            ->get();

        $getJmlAnggota = $getJml->count();

        $getTtlKpl = $dataKpl->count();

        // $getTtlKpl = KepalaKeluarga::select('kepala_keluarga.id','kepala_keluarga.nama',
        // DB::raw('count(peng.kpl_id) as ttlAnggota'))
        // ->join('pengungsi as peng','kepala_keluarga.id','=','peng.kpl_id')
        // ->join('posko as p','peng.posko_id','=','p.id')
        // ->groupBy('kepala_keluarga.id','kepala_keluarga.nama')
        // ->distinct()
        // ->paginate(5);

        $getBalita = Pengungsi::select('*')
            ->where('umur', '<', 5)
            ->where('pengungsi.posko_id', '=', $id)->get();

        $getTtlBalita = $getBalita->count();

        $getLansia = Pengungsi::select('*')
            ->where('umur', '>', 60)
            ->where('pengungsi.posko_id', '=', $id)->get();

        $getTtlLansia = $getLansia->count();

        $getSehat = Pengungsi::select('*')
            ->where('statKon', '=', 0)
            ->where('pengungsi.posko_id', '=', $id)->get();

        $getTtlSehat = $getSehat->count();

        $getSakit = Pengungsi::select('*')
            ->where('statKon', '>', 0)
            ->where('statKon', '!=', 4)
            ->where('pengungsi.posko_id', '=', $id)->get();

        $getTtlSakit = $getSakit->count();

        $getDifabel = Pengungsi::select('*')
            ->where('statKon', '=', 4)
            ->where('pengungsi.posko_id', '=', $id)->get();

        $getTtlDifabel = $getDifabel->count();

        $getNmTrc = Posko::select(
            DB::raw("concat(u.firstname,' ',u.lastname) as fullName")
        )
            // ->join('posko as p','pengungsi.posko_id','=','p.id')
            ->leftJoin('users as u', 'u.id', '=', 'posko.trc_id')
            ->where('posko.id', $id)
            ->get();

        $getMasuk = Pengungsi::select('*')
            ->where('statPos', '=', 1)
            ->where('pengungsi.posko_id', '=', $id)->get();

        $getMasuk = $getMasuk->count();

        $getKeluar = Pengungsi::select('*')
            ->where('statPos', '=', 0)
            ->where('pengungsi.posko_id', '=', $id)->get();

        $getKeluar = $getKeluar->count();

        return view('admin.pengungsi.index', [
            'data' => $pengungsi,
            'kpl' => $getKpl,
            'dataKpl' => $dataKpl,
            'getNama' => $getNmPosko,
            'getNmTrc' => $getNmTrc,
            'ttlDifabel' => $getTtlDifabel,
            'jmlAnggota' => $getJmlAnggota,
            'getAlamat' => $getAlamat,
            'ttlKpl' => $getTtlKpl,
            'ttlBalita' => $getTtlBalita,
            'ttlLansia' => $getTtlLansia,
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
            'kpl_id',
            'statKel',
            'telpon',
            'gender',
            'umur',
            'statPos',
            'pengungsi.posko_id as idPospeng',
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
            ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
            ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
            ->where('pengungsi.posko_id', session()->get('idPosko'))
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
            'kpl_id',
            'statKel',
            'telpon',
            'gender',
            'umur',
            'statPos',
            'pengungsi.posko_id as idPospeng',
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
            ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
            ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
            ->where('pengungsi.posko_id', session()->get('idPosko'))
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
            'kpl_id',
            'statKel',
            'telpon',
            'gender',
            'umur',
            'statPos',
            'pengungsi.posko_id as idPospeng',
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
            ->leftJoin('posko AS p', 'pengungsi.posko_id', '=', 'p.id')
            ->leftJoin('kepala_keluarga as kpl', 'pengungsi.kpl_id', '=', 'kpl.id')
            ->where('pengungsi.posko_id', session()->get('idPosko'))
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
                    'posko_id' => $request->posko_id,
                    'statKon' => $request->statKon,
                ]);
                // 'kplklg_id' => $request->kpl,
            } else {
                Pengungsi::create([
                    'nama' => $request->nama,
                    'telpon' => $request->telpon,
                    'statKel' => $request->statKel,
                    'kpl_id' => $request->kpl,
                    'gender' => $request->gender,
                    'umur' => $request->umur,
                    'statPos' => $request->statPos,
                    'posko_id' => $request->posko_id,
                    'statKon' => $request->statKon,
                ]);
            }
            // $peng = Pengungsi::create($request->all());
            $getIdKpl = KepalaKeluarga::select('id')->orderBy('id', 'desc')->value('id');
            $getIdPeng = Pengungsi::select('id')->orderBy('id', 'desc')->first();
            $getIdPeng->update([
                'kpl_id' => $getIdKpl,
                //  'totalmoroso' => $Ingresos->deuda,
            ]);

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
                    'posko_id' => $request->posko_id,
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
                    'kpl_id' => $request->kpl,
                    'gender' => $request->gender,
                    'umur' => $request->umur,
                    'statPos' => $request->statPos,
                    'posko_id' => $request->posko_id,
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
            $getIdKepala = Pengungsi::where('id', $id)->value('kpl_id');
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
