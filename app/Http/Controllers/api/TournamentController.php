<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TournamentRequest;
use Illuminate\Http\Request;
use App\services\TournamentService;


class TournamentController extends Controller
{
    public function run(TournamentRequest $request)
    {
        $data_set = $request->validated();

        try {

            $tournamentService = new TournamentService($data_set);
            $winner_id = $tournamentService->create();

        } catch(\Exception $e) {
            throw new ResponseException($e->getMessage(), ResponseInterface::HTTP_CODE_BAD_REQUEST, $e);
        }

        $player = Player::find($winner_id);

        return ['Message: The winner of the tournament is '.$player->first_name.' '.$player->last_name.'!',
            'code' => 200];

        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
