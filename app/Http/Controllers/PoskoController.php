<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Pengungsi;
use App\Models\Posko;
use App\Models\User;
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
            DB::raw("concat('Prov. ',provinsi,', Kota ',kota,', Kec. ',
            kecamatan,', Ds. ',kelurahan,', Daerah ',detail,' ')
        as lokasi"),
            'posko.id as idPosko',
            'posko.trc_id as idTrc',
            'posko.nama as namaPosko',
            'provinsi',
            'kota',
            'kecamatan',
            'kelurahan',
            'detail',
            'kapasitas',
            'bencana_id',
            'b.id as idBencana',
            DB::raw("concat(u.firstname,' ',u.lastname) as fullName"), 'u.id as idAdmin',
            'posko.created_at',
            'posko.updated_at',
            DB::raw('count(p.posko_id) as ttlPengungsi'),
        )
            ->leftJoin('users AS u', 'posko.trc_id', '=', 'u.id')
            ->join('bencana as b', 'posko.bencana_id', '=', 'b.id')
            ->leftJoin('pengungsi as p', 'posko.id', '=', 'p.posko_id')
            ->groupBy('lokasi', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'detail', 'posko.id'
                , 'posko.nama', 'posko.bencana_id', 'b.id', 'u.firstname', 'u.lastname', 'u.id', 'posko.created_at',
                'posko.updated_at', 'posko.trc_id','kapasitas')
            ->where('posko.bencana_id', $id)
            ->orderBy('u.id', 'desc')
            ->paginate(5);

        $trc = User::select(DB::raw("concat(firstname,' ',lastname) as fullName"), 'users.id as idAdmin', 'lastname')
            ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->where(function ($query) {
                $query->where('r.id', 2)
                    ->orWhere('r.id', 3);
                }) //memilih role yang akan ditampilkan (p,trc,r)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('posko')
                    ->whereRaw('users.id = posko.trc_id');
            })->get();

        $getTtlPengungsi = Pengungsi::select(DB::raw("count('posko_id') as ttlPengungsi"))
            ->join('posko as p', 'pengungsi.posko_id', '=', 'p.id')
            ->paginate(5);

        // return view('admin.posko.index', ['data'=>$posko],
        // ['getTrc'=>$trc],['getId'=>$getIdBencana],['ttlPengungsi'=>$getTtlPengungsi]);
        return view('admin.posko.index', [
            'data' => $posko,
            'getTrc' => $trc,
            'getId' => $getIdBencana,
            'ttlPengungsi' => $getTtlPengungsi,
        ]);

    }

    public function search()
    {
        // $getIdBencana = Bencana::where('id',$id)->value('id');
        $filter = request()->query();
        return $posko = Posko::select(
            DB::raw("concat('Prov. ',provinsi,', Kota ',kota,', Kec. ',
            kecamatan,', Ds. ',kelurahan,', Daerah ',detail,' ')
        as lokasi"),
            'posko.id as idPosko',
            'posko.nama as namaPosko',
            'posko.trc_id',
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
            DB::raw('count(p.posko_id) as ttlPengungsi'), 'kapasitas',
        )
            ->leftJoin('users AS u', 'posko.trc_id', '=', 'u.id')
            ->leftJoin('bencana as b', 'posko.bencana_id', '=', 'b.id')
            ->leftJoin('pengungsi as p', 'posko.id', '=', 'p.posko_id')
            ->groupBy('lokasi', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'detail', 'posko.id'
                , 'posko.nama', 'posko.bencana_id', 'b.id', 'u.firstname', 'u.lastname', 'u.id', 'posko.created_at',
                'posko.updated_at','posko.kapasitas', 'posko.trc_id')
            ->where('posko.bencana_id', session()->get('idBencana'))
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
            ->leftJoin('users AS u', 'posko.trc_id', '=', 'u.id')
            ->leftJoin('bencana as b', 'posko.bencana_id', '=', 'b.id')
            ->leftJoin('pengungsi as p', 'posko.id', '=', 'p.posko_id')
            ->groupBy('lokasi', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'detail', 'posko.id'
                , 'posko.nama', 'posko.bencana_id', 'b.id', 'u.firstname', 'u.lastname', 'u.id', 'posko.created_at',
                'posko.updated_at','posko.kapasitas')
            ->where('posko.trc_id', $id)
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
        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            $request->validate([
                // 'namaBelakang' => ['required', 'max:50'],
                'nama' => ['string', 'unique:posko'],
                // 'trc_id' => ['string', 'unique:posko'],
            ]);
            $addPosko = new Posko;
            $addPosko->nama = $request->nama;
            $addPosko->provinsi = $request->provinsi;
            $addPosko->kota = $request->kota;
            $addPosko->kecamatan = $request->kecamatan;
            $addPosko->kelurahan = $request->kelurahan;
            $addPosko->detail = $request->detail;
            $addPosko->kapasitas = $request->kapasitass;
            $addPosko->trc_id = $request->trc_id;
            $addPosko->bencana_id = $request->idPosko;
            $addPosko->save();

            // $idPosko = Posko::where('bencana_id', $request->idBencana)->first()->value('id');
            // $bencana = Bencana::where('id', $request->idBencana)->first();
            // $bencana->posko_id = $idPosko;
            // $bencana->update();

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
        $posko = Posko::where('id', $id)->first();
        $request->validate([
            // Akan melakukan validasi kecuali punyanya sendiri
            'nama' => ['string', Rule::unique('posko')->ignore($id)],
        ]);
        // $role = Role::where('id', $request->peran)->first();
        $posko = Posko::where('id', $id)->first();

        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            $posko->nama = $request->nama;
            $posko->provinsi = $request->provinsi;
            $posko->kota = $request->kota;
            $posko->kecamatan = $request->kecamatan;
            $posko->kelurahan = $request->kelurahan;
            $posko->detail = $request->detail;
            $posko->trc_id = $request->trc_id;
            $posko->update();
            // $member->syncRoles($role);
            Alert::success('Success', 'Data berhasil diubah');
            return redirect()->back();
        }
        return redirect()->back();
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
            $delete = Posko::destroy($id);

            // check data deleted or not
            if ($delete == 1) {
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