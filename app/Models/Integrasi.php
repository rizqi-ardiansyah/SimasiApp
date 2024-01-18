<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrasi extends Model
{
    use HasFactory;

    protected $table = 'integrasi';

    protected $fillable = [
        'kpl_id',
        'png_id',
        'posko_id',
        'bencana_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
