<?php
namespace App\services;

use App\Models\Match;
use App\Models\Tournament;
use App\Models\Player;
use Carbon\Carbon;
use phpseclib\Math\BigInteger;

class TournamentService
{
    private $name;
    private $start_datetime;
    private $gender;
    private $rounds;
    private $sets_per_match;
    private $player_ids;
    private $winner_ids;

    public const MAN = 0;
    public const WOMAN = 1;

    public function __construct(array $data_set) {
        $this->name             = $data_set['name'];
        $this->start_datetime   = $data_set['start_datetime'];
        $this->gender           = $data_set['gender'];
        $this->sets_per_match   = $data_set['sets_per_match'] ?? 3;
        $this->player_ids       = $data_set['player_ids'];
        $this->winner_ids       = [];
    }

    public function create()
    {
        $rv = $this->validate_params_values();

        if($rv){
            return ['message' => $rv, 'error' => 400];
        }

        $tournament = new Tournament();
        $tournament->name           = $this->name;
        $tournament->start_datetime = $this->start_datetime;
        $tournament->gender         = $this->gender;
        $tournament->sets_per_match = $this->sets_per_match;

        $this->createRoundsAndMatches();
        $this->assignPlayersToRound(1, $this->player_ids);
        $winner_id = $this->playTournament();
        $tournament->winner_id = $winner_id;
        $tournament->save();

        return $winner_id;
    }

    /*
     * Esto creará todas los partidos y rondas a realizarse
     */
    public function createRoundsAndMatches(){

        $matches_count = $this->player_ids / 2;

        $match_datetime = $tournament->start_datetime;

        $carbon_datetime = new Carbon();

        for ($round = 1; $round <= $this->rounds; $round++) {

            for ($matches = $matches_count; $matches >= 1; $matches--) {
                $match = new Match();
                $match->tournament_id = $this->tournament_id;
                $match->round = $round;
                $match->start_datetime = $match_datetime;

                /* Al día siguiente es el próximo partido de la misma ronda  */
                $carbon_datetime->setTimestamp(strtotime($match_datetime));
                $match_datetime = $carbon_datetime->addDay();

                $match->save();
            }
            /* A los dos días es la próxima ronda */
            $carbon_datetime->setTimestamp(strtotime($match_datetime));
            $match_datetime = $carbon_datetime->addDay();
            $matches_count /= 2;
        }
    }

    public function assignPlayersToRound($round, $player_ids){

        $player_ids = shuffle($player_ids);
        $index = 0;

        $matches = Match::where('tournament_id', $this->tournament_id)->where('round', $round)->get();

        foreach($matches as $match) {
            $match->players()->attach($player_ids[$index++]);
            $match->players()->attach($player_ids[$index++]);
        }
    }

    public function playTournament(): BigInteger
    {
        for ($round = 1; $round <= $this->rounds; $round++) {
            $winner_ids = $this->playRound($round);
        }

        return $winner_ids[0];
    }

    public function playRound($round): array
    {
        $winner_ids = [];
        $matches = Match::where('tournament_id', $this->tournament_id)->where('round', $round)->get();
        foreach($matches as $match) {
            $winner_ids[] = $this->playMatch($match->id);
        }
        return $winner_ids;
    }

    public function playMatch($match_id): BigInteger
    {
        $player_ids = Match::query('SELECT player_id FROM match_players WHERE id = '.$match_id )->get()->toArray();

        if (count ($player_ids) === 2) {
            $winner_id = $this->getBestPlayer($player_ids);
            $match = Match::find($match_id);
            $match->winner_id = $winner_id;
            $match->save();
            return $winner_id;
        }

        return 0;
    }

    public function getBestPlayer($player_ids): BigInteger
    {
        $players = Player::whereIn('id', $player_ids)->get()->toArray();

        $player1 = $players[0];
        $player2 = $players[1];

        $player1['performance'] = $player1['skill_level'] + rand(0, $player1['luck']);
        $player2['performance'] = $player2['skill_level'] + rand(0, $player2['luck']);

        do {
            if ($this->gender === self::MAN) {
                $player1['performance'] += ($player1['strength'] + $player1['speed']);
                $player2['performance'] += ($player2['strength'] + $player2['speed']);
            } else {
                $player1['performance'] += $player1['reaction_time'];
                $player2['performance'] += $player2['reaction_time'];
            }
        } while($player1['performance'] === $player2['performance']);

        return $player1['performance'] > $player2['performance'] ? $player1['id'] : $player2['id'];
    }

    public function validate_params_values() {

        /* Comprobar si la cantidad de tenistas son potencia de dos */
        $cant = count($this->player_ids);
        $rounds = log($cant, 2);
        if ($rounds != (int)$rounds) {
            return 'Error: La cantidad de participantes debe ser potencia de 2';
        }
        $this->rounds = $rounds;

        /* Comprobar que no haya jugadores repetidos */
        if(count($this->player_ids) !== count(array_unique($this->player_ids))){
            return 'Error: Hay participantes repetidos';
        }

        /* Comprobar si todos son del género correcto */
        $player = Player::whereIn('id', $this->player_ids)->where('gender', '<>', $this->gender)->get();

        if (count($player)) {
            $el_la = $player->gender == 0 ? 'El' : "La";
            return  'Error: '.$el_la.' participante '.$player->first_name.' '.$this->last_name.' no corresponde al género de este torneo';
        }

        return 0;
    }
}