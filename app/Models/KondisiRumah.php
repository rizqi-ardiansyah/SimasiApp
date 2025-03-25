<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiRumah extends Model
{
    use HasFactory;

    protected $table = 'kondisi_rumah';

    protected $fillable = [
        'tanggal',
        'waktu',
        'idPengungsi',
        'picRumah',
        'status',
    ];
}
