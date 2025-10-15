<?php

namespace App\Http\Controllers;

use App\Models\games;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    //
    public function index()
    {
        $games = Games::all();
        return view('games.index', compact('games'));

//        $games = new games();
//        $games->name = 'The Legend of Zelda: Breath of the Wild';
//        $games->genre = 'Action-adventure';
//        return view('games', compact('games'));
    }
}
