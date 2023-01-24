<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function tournaments(){
        return $this->belongsToMany(Tournament::class, 'tournament_players');
    }

    public function matches(){
        //return $this->belongsToMany(Match::class, 'match_players');
    }
}
