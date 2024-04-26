<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ransum extends Model
{
    use HasFactory;
    protected $table = 'posko';

    protected $fillable = [
        'nama',
        'detail',
        'kapasitas'
    ];
}
