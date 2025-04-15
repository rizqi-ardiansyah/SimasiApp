<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiSekitar extends Model
{
    use HasFactory;

    protected $table = 'kondisi_sekitar';

    protected $fillable = [
        'tanggal',
        'waktu',
        'alamat',
        'idKepala',
        'picLokasi',
        'keterangan',
        'status',
    ];
}

