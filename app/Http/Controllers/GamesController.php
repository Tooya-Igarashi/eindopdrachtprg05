<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\games;
use App\Models\genres;
use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GamesController extends Controller
{
    //
    public function index(Request $request)
    {
        $games = Games::query();
        $genres = genres::all();

        if ($request->has('name') && $request->name != '') {
            $games->where('name', 'like', '%' . $request->name . '%')
                ->orWhere('description', 'like', '%' . $request->name . '%');
        }

        if ($request->has('genre') && $request->genre != '') {
            $games->where('genre_id', $request->genre);
        }

        $games = $games->get();

        return view('games.index', compact('games', 'genres'));

//        $games = new games();
//        $games->name = 'The Legend of Zelda: Breath of the Wild';
//        $games->genre = 'Action-adventure';
//        return view('games', compact('games'));
    }

    public function show(Games $game)
    {
        $comments = Comments::with('user')->where('game_id', $game->id)->get();

        return view('games.show', compact('game', 'comments'));
    }

    public function storeComments(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'contents' => 'required',
        ]);
        $comment = new Comments();
        $comment->user_id = Auth::id();
        $comment->game_id = $request->input('game_id');
        $comment->title = $request->input('title');
        $comment->contents = $request->input('contents');

        $comment->save();

        return redirect()->route('games.show', $request->input('game_id'));
    }

    //voor veel op 1 relatie
    //database tabel ->migration
    //model nodig
    //data ophalen
    //meesturen aan de view
    // <select> in de view
    public function create()
    {
//        if (Auth::guest()){
//            return redirect()->route('login');
//        }

        $comments = Comments::where('user_id', Auth::id())->get();
        $genres = genres::all();
        return view('games.create', compact('genres'), compact('comments'));
    }

    //form data
    public function store(Request $request)
    {
//        $filename = '';
//        if ($request->hasFile('img')) {
//            $filename = time() . '_' . $request->img->getClientOriginalName();
//
//            $request->img->move(public_path('images'), $filename);
//        }
        //validate
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'trophies' => 'required|numeric:',
            'time' => 'required|numeric',
            'difficulty' => 'required|max:10',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('photos', 'public');
        }

        //inset into sql
        $game = new Games();
        $game->user_id = Auth::id();
        $game->name = $request->input('name');
        $game->genre_id = $request->input('genre_id');
        $game->description = $request->input('description');
        $game->trophies = $request->input('trophies');
        $game->time = $request->input('time');
        $game->difficulty = $request->input('difficulty');
        $game->image = $imagePath;

        $game->save();

        //redirect
        return redirect()->route('games.index');
    }

    public function edit(Games $game)
    {
//        if (Auth::guest()){
//            return redirect()->route('login');
//        }

//        if ($game->users()->isNot(Auth::User())){
//            abort(403);
//        }
        if ($game->user_id !== Auth::id()){
            abort(403);
        }

        $genres = genres::all();
        return view('games.edit', compact('game'), compact('genres'));
    }
//    public function show($id)
//    {
//        $game = Games::findOrFail($id);
//        return view('games.show', compact('game'));
//    }
//}

    public function admin()
    {
        if (Auth::guest() || Auth::user()->role !== 1){
            return redirect()->route('login');
        }
        $games = Games::all();
        $genres = genres::all();
        return view('games.admin', compact('games'), compact('genres'));
    }
    public function update(Games $game)
    {
        request()->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'trophies' => 'required|numeric:',
            'time' => 'required|numeric',
            'difficulty' => 'required|max:10',
        ]);


        $game->update([
            'name' => request('name'),
            'genre_id' => request('genre_id'),
            'description' => request('description'),
            'trophies' => request('trophies'),
            'time' => request('time'),
            'difficulty' => request('difficulty'),
        ]);

        return redirect()->route('games.show', $game);
        //redirect to show does not work? Must find out why.
    }

    public function destroy(Games $game)
    {
        if ($game->user_id !== Auth::id()){
            abort(403);
        }
        $game->delete();

        return redirect()->route('games.index');
    }

    public function authenticate(Games $game)
    {
        if ($game->validation_check === 0) {
            $game->update(['validation_check' => 1]);
        } else if ($game->validation_check === 1) {
            $game->update(['validation_check' => 0]);
        }

        if (Auth::user()->role !== 1){
            return redirect()->route('games.index');
        }else{
            return redirect()->route('games.admin');
        }
    }
}
