<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropdownController extends Controller
{
    //
    public function getData(Request $request)
    {
        // Ambil data dari database berdasarkan pencarian
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$search}%")
            ->select('id', 'name')
            ->get();

        // Format data untuk Select2
        $results = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'text' => $user->name,
            ];
        });

        return response()->json(['results' => $results]);
    }
}
