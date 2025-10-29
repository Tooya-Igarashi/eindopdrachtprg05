<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Games;
use Illuminate\Support\Facades\Route;

Route::get('/', [GamesController::class, 'index'])->name('games.index');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/contactpage', function(){
//    return view('contactpage');
//});
//
//Route::get('/about-us', function() {
//    $company = 'Hogeschool Rotterdam';
//    return view('about-us', compact(var_name: 'company'));
//})->name('about');
//
//Route::get('products/{id}', function(string $id) {
//    return view ('products', [
//        'id' => $id
//    ]);
//});

//Route::get('about', [AboutController::class, 'index'])
//    ->name(name: 'about');

//Route::get('home', [HomeController::class, 'index'])
//    ->name(name: 'home');
//
//Route::get('about', [HomeController::class, 'about'])
//    ->name(name: 'about');
//
//Route::get('contact', [HomeController::class, 'contact'])
//    ->name(name: 'contact');

//Route::get('games', [GamesController::class, 'index'])
//    ->name(name: 'games');

//Route::get('/games/{game}', [GamesController::class, 'show'])->name('games.show');

Route::resource('games', GamesController::class);

Route::middleware('auth')->group(function (){
Route::resource('create', GamesController::class);

Route::post('/comments', [GamesController::class, 'storeComments'])->name('storeComments');

Route::resource('edit', GamesController::class);

Route::get('admin', [GamesController::class, 'admin'])->name('games.admin');

Route::patch('/games/{game}/authenticate', [GamesController::class, 'authenticate'])->name('games.authenticate');

Route::patch('edit', [GamesController::class, 'update'])->name('games.update');

Route::delete('edit', [GamesController::class, 'destroy'])->name('games.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
