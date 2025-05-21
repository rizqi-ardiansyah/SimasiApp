<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiMedis extends Model
{
    use HasFactory;

    protected $table = 'kondisi_medis';

    protected $fillable = [
        'idPengungsi',
        'tanggal',
        'waktu',
        'keluhan',
        'riwayat_penyakit',
        'konfis',
    ];
}
