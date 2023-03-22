<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'matches',
        'wins',
        'draws',
        'loses',
        'goals_win',
        'goals_lose',
        'points',
    ];
}
