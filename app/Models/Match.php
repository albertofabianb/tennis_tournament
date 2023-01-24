<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $table = 'matches';

    public function tournaments() {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function players(){
        return $this->belongsToMany(Player::class, 'match_players');
    }
}
