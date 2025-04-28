<?php

namespace App\Http\Controllers;

use App\Models\MemberTeam;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Karyawan;

class MemberTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $member = MemberTeam::select(DB::raw("concat(memberteam.firstname,' ',memberteam.lastname) 
        as fullName"), 'memberteam.firstname', 'memberteam.lastname', 
        'memberteam.email', 'memberteam.nohp','memberteam.alamat','memberteam.peran')
            ->leftJoin('karyawans as u', 'u.id', '=', 'memberteam.tim')
            ->orderBy('firstname', 'asc')
            ->paginate(5);

        return view('admin.member.indexPusdalop', [
            'datas' => $member,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMember(Request $request)
    {
        MemberTeam::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'nohp' => $request->telepon,
            // 'kpl_id' => $request->kpl,
            'alamat' => $request->alamat,
            'peran' => $request->peranAnggota,
            'tim' => $request->idAdmin,
        ]);

        Alert::success('Success', 'Data berhasil ditambahkan');
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
     * @param  \App\Models\MemberTeam  $memberTeam
     * @return \Illuminate\Http\Response
     */
    public function show(MemberTeam $memberTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberTeam  $memberTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $role = Role::where('id', $request->peran)->first();
        $member = MemberTeam::where('id', $id)->first();

        $member->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'nohp' => $request->telepon,
            'alamat' => $request->alamat,
            'peran' => $request->peranAnggota
            // 'posko_id' => $request->posko_id,
        ]);

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberTeam  $memberTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberTeam $memberTeam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberTeam  $memberTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberTeam $memberTeam)
    {
        //
    }

    public function deleteAnggota($id)
    {
        if (auth()->user()->hasAnyRole(['pusdalop'])) {
            // $getTim = User::where('id', $id)->get();
            $getMemberTeam = MemberTeam::where('tim', $id)->get();
            $delete = MemberTeam::destroy($id);

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
