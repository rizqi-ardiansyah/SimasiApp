<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaKeluarga extends Model
{
    use HasFactory;

    protected $table = 'kepala_keluarga';

    protected $fillable = [
        'nama',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'detail',
    ];
}
