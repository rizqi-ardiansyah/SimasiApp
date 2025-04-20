<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiPsikologis extends Model
{
    use HasFactory;

    protected $table = 'kondisi_psikologis';

    protected $fillable = [
        'idPengungsi',
        'jawaban1',
        'jawaban2',
        'jawaban3',
        'jawaban4',
        'jawaban5',
        'jawaban6',
        'skor',
        'status'
    ];
}
