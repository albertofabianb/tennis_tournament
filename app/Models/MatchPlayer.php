<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use net\authorize\util\SensitiveTag;

class MatchPlayer extends Model
{
    use HasFactory;

    protected $table = 'match_players';

    public function sets(){
        return $this->hasMany(Set::class, 'id');
    }
}
