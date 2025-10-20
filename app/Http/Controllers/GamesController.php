<?php

namespace App\Http\Controllers;

use App\Models\games;
use App\Models\genres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function show(Games $game)
    {
        return view('games.show', compact('game'));
    }

    //voor veel op 1 relatie
    //database tabel ->migration
    //model nodig
    //data ophalen
    //meesturen aan de view
    // <select> in de view
    public function create()
    {
        $genres = genres::all();
        return view('games.create', compact('genres'));
    }

    //form data
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'trophies' => 'required|numeric:',
            'time' => 'required|numeric',
            'difficulty' => 'required|max:10',
        ]);

        //inset into sql
        $game = new Games();
        $game->name = $request->input('name');
        $game->genre_id = $request->input('genre_id');
        $game->description = $request->input('description');
        $game->trophies = $request->input('trophies');
        $game->time = $request->input('time');
        $game->difficulty = $request->input('difficulty');

        $game->save();

        //redirect
        return redirect()->route('games.index');
    }

    public function edit(Games $game)
    {
        $genres = genres::all();
        return view('games.edit', compact('game'), compact('genres'));
    }
//    public function show($id)
//    {
//        $game = Games::findOrFail($id);
//        return view('games.show', compact('game'));
//    }
//}
    public function update(string $id)
    {
        request()->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'trophies' => 'required|numeric:',
            'time' => 'required|numeric',
            'difficulty' => 'required|max:10',
        ]);

        $games = Games::findOrFail($id);

        $games->update([
            'name' => request('name'),
            'genre_id' => request('genre_id'),
            'description' => request('description'),
            'trophies' => request('trophies'),
            'time' => request('time'),
            'difficulty' => request('difficulty'),
        ]);

        return redirect()->route('games.index');
        //redirect to show does not work? Must find out why.
    }

    public function destroy(string $id)
    {
        Games::findOrFail($id)->delete();

        return redirect()->route('games.index');
    }
}
