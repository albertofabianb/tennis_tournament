<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'tournaments';

    public function matches () {
        return $this->hasMany(Match::class, 'id');
    }

    public function players(){
        return $this->belongsToMany(Player::class, 'tournament_players');
    }

    protected $fillable = ['name', 'start_datetime', 'gender', 'rounds', 'sets_per_match', 'winner_id'];
}
