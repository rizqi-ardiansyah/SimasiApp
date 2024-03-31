<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTeam extends Model
{
    use HasFactory;

    protected $table = 'memberteam';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'nohp',
        'alamat',
        'peran',
        'tim'
    ];
}
