<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            ['first_name' => 'Alan',    'last_name' => 'Smith',     'gender' => 0, 'skill_level' => 80, 'strength' => 70, 'speed' => 60, 'reaction_time' => null, 'luck' => 20],
            ['first_name' => 'Robert',  'last_name' => 'Gregor',    'gender' => 0, 'skill_level' => 75, 'strength' => 82, 'speed' => 55, 'reaction_time' => null, 'luck' => 35],
            ['first_name' => 'Kevin',   'last_name' => 'Philips',   'gender' => 0, 'skill_level' => 82, 'strength' => 65, 'speed' => 40, 'reaction_time' => null, 'luck' => 10],
            ['first_name' => 'Patel',   'last_name' => 'Shankar',   'gender' => 0, 'skill_level' => 69, 'strength' => 90, 'speed' => 65, 'reaction_time' => null, 'luck' => 8],
            ['first_name' => 'Igor',    'last_name' => 'Funsky',    'gender' => 0, 'skill_level' => 65, 'strength' => 89, 'speed' => 58, 'reaction_time' => null, 'luck' => 30],
            ['first_name' => 'Marcel',  'last_name' => 'Belmont',   'gender' => 0, 'skill_level' => 90, 'strength' => 72, 'speed' => 45, 'reaction_time' => null, 'luck' => 15],
            ['first_name' => 'Hugo',    'last_name' => 'Schwartz',  'gender' => 0, 'skill_level' => 94, 'strength' => 80, 'speed' => 39, 'reaction_time' => null, 'luck' => 25],
            ['first_name' => 'Steve',   'last_name' => 'McHooney',  'gender' => 0, 'skill_level' => 87, 'strength' => 79, 'speed' => 35, 'reaction_time' => null, 'luck' => 12],

            ['first_name' => 'Ana',         'last_name' => 'Krasnipova',    'gender' => 1, 'skill_level' => 80, 'strength' => null, 'speed' => null, 'reaction_time' => 22, 'luck' => 35],
            ['first_name' => 'Julia',       'last_name' => 'van Dragen',    'gender' => 1, 'skill_level' => 75, 'strength' => null, 'speed' => null, 'reaction_time' => 18, 'luck' => 21],
            ['first_name' => 'Maria',       'last_name' => 'Vargas',        'gender' => 1, 'skill_level' => 82, 'strength' => null, 'speed' => null, 'reaction_time' => 15, 'luck' => 11],
            ['first_name' => 'Stella',      'last_name' => 'Rush',          'gender' => 1, 'skill_level' => 69, 'strength' => null, 'speed' => null, 'reaction_time' => 12, 'luck' => 15],
            ['first_name' => 'Clarissa',    'last_name' => 'Pontello',      'gender' => 1, 'skill_level' => 65, 'strength' => null, 'speed' => null, 'reaction_time' => 20, 'luck' => 30],
            ['first_name' => 'Elizabeth',   'last_name' => 'Lewis',         'gender' => 1, 'skill_level' => 90, 'strength' => null, 'speed' => null, 'reaction_time' => 15, 'luck' => 18],
            ['first_name' => 'Alfonsina',   'last_name' => 'Rodriguez',     'gender' => 1, 'skill_level' => 94, 'strength' => null, 'speed' => null, 'reaction_time' => 25, 'luck' => 20],
            ['first_name' => 'Selena',      'last_name' => 'Lopez',         'gender' => 1, 'skill_level' => 87, 'strength' => null, 'speed' => null, 'reaction_time' => 10, 'luck' => 9]
        ];

        foreach ($players as $player_details) {
            $player = new Player($player_details);
            $player->save();
        }
    }
}
