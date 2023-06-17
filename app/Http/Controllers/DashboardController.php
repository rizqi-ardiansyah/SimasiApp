<?php

namespace App\Http\Controllers;

use App\Models\Posko;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getRP = User::select('*')
            ->leftJoin('model_has_roles as mr', 'users.id', '=', 'mr.model_id')
            ->leftJoin('roles AS r', 'mr.role_id', '=', 'r.id')
            ->where('r.id', '=', 1)->get();
        $getRPTotal = $getRP->count();

        $getRT = User::select('*')
            ->leftJoin('model_has_roles as mr', 'users.id', '=', 'mr.model_id')
            ->leftJoin('roles AS r', 'mr.role_id', '=', 'r.id')
            ->where('r.id', '=', 2)->get();
        $getRTTotal = $getRT->count();

        // bencana berjalan
        $getBBerjalan = Bencana::select('*')
            ->where('status', '=', 1)->get();
        $getBBTotal = $getBBerjalan->count();

        // bencana selesai
        $getBSelesai = Bencana::select('*')
            ->where('status', '=', 0)->get();
        $getBSTotal = $getBSelesai->count();

        // Bencana terjadi di tahun 2010
        $getBthn2014 = Bencana::select('*')
        ->whereYear('tanggal', '=', 2014)->paginate(5);

        // $getTtl2014 = $getBThn->count();

        $getPthn2014 = Posko::select('b.nama as namaBencana', DB::raw('count(p.posko_id) as ttlPengungsi'))
        ->leftJoin('bencana as b','posko.bencana_id','=','b.id')
        ->leftJoin('pengungsi as p','posko.id','=','p.posko_id')
        // ->join('users as u','posko.trc_id','=','u.id')
        ->groupBy('posko.bencana_id', 'b.tanggal', 'b.waktu', 'b.id',
                'b.nama', 'status', 'b.updated_at',
                'posko.id', 'posko.nama', 'posko.bencana_id', 'b.id', 'posko.created_at',
                'posko.updated_at', 'posko.trc_id')
        ->whereYear('b.tanggal','=',2014)
        // ->where('posko.bencana_id', 4)
        ->paginate(5);

        $getPthn2018 = Posko::select('b.nama as namaBencana', DB::raw('count(p.posko_id) as ttlPengungsi'))
        ->leftJoin('bencana as b','posko.bencana_id','=','b.id')
        ->leftJoin('pengungsi as p','posko.id','=','p.posko_id')
        // ->join('users as u','posko.trc_id','=','u.id')
        ->groupBy('posko.bencana_id', 'b.tanggal', 'b.waktu', 'b.id',
                'b.nama', 'status', 'b.updated_at',
                'posko.id', 'posko.nama', 'posko.bencana_id', 'b.id', 'posko.created_at',
                'posko.updated_at', 'posko.trc_id')
        ->whereYear('b.tanggal','=',2018)
        // ->where('posko.bencana_id', 4)
        ->paginate(5);

        $getPthn2022 = Posko::select('posko.bencana_id as idBencana','b.nama as namaBencana', DB::raw('count(p.posko_id) as ttlPengungsi'))
        ->leftJoin('bencana as b','posko.bencana_id','=','b.id')
        ->leftJoin('pengungsi as p','posko.id','=','p.posko_id')
        // ->join('users as u','posko.trc_id','=','u.id')
        ->groupBy('posko.bencana_id', 'b.tanggal', 'b.waktu', 'b.id',
                'b.nama', 'status', 'b.updated_at',
                'posko.id', 'posko.nama', 'posko.bencana_id', 'b.id', 'posko.created_at',
                'posko.updated_at', 'posko.trc_id')
        ->whereYear('b.tanggal','=',2022)
        // ->where('posko.bencana_id', 4)
        ->paginate(5);

        $getPthn2023 = Posko::select('posko.bencana_id as idBencana','b.nama as namaBencana', DB::raw('count(p.posko_id) as ttlPengungsi'))
        ->leftJoin('bencana as b','posko.bencana_id','=','b.id')
        ->leftJoin('pengungsi as p','posko.id','=','p.posko_id')
        // ->join('users as u','posko.trc_id','=','u.id')
        ->groupBy('posko.bencana_id', 'b.tanggal', 'b.waktu', 'b.id',
                'b.nama', 'status', 'b.updated_at',
                'posko.id', 'posko.nama', 'posko.bencana_id', 'b.id', 'posko.created_at',
                'posko.updated_at', 'posko.trc_id')
        ->whereYear('b.tanggal','=',2023)
        // ->where('posko.bencana_id', 4)
        ->paginate(5);

        return view('admin.dashboard.index', [
            'ttlBS' => $getBSTotal,
            'ttlBB' => $getBBTotal,
            'ttlRP' => $getRPTotal,
            'ttlRT' => $getRTTotal,
            'ttlP2014' => $getPthn2014,
            'ttlP2018' => $getPthn2018,
            'ttlP2022' => $getPthn2022,
            'ttlP2023' => $getPthn2023,
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

    function login(Request $req)
    {
        return User::where('email', $req->input('email'));
    }
}
