<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;

    protected $table = 'bencana';

    protected $fillable = [
        'nama',
        'tanggal',
        'waktu',
        'jmlPengungsi',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'jmlPosko',
        'jmlPengungsi',
        'status',
    ];

    public function integrasi()
{
    return $this->hasMany(\App\Models\Integrasi::class, 'bencana_id');
}

}