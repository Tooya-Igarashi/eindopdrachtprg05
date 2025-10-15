<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contactpage', function(){
    return view('contactpage');
});

Route::get('/about-us', function() {
    $company = 'Hogeschool Rotterdam';
    return view('about-us', compact(var_name: 'company'));
})->name('about');

Route::get('products/{id}', function(string $id) {
    return view ('products', [
        'id' => $id
    ]);
});

//Route::get('about', [AboutController::class, 'index'])
//    ->name(name: 'about');

Route::get('home', [HomeController::class, 'index'])
    ->name(name: 'home');

Route::get('about', [HomeController::class, 'about'])
    ->name(name: 'about');

Route::get('contact', [HomeController::class, 'contact'])
    ->name(name: 'contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
