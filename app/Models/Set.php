<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $table = 'sets';

    public function matchPlayers(){
        return $this->belongsTo(MatchPlayer::class, 'match_player_id');
    }
}
