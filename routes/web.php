<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia; //added so I can use React for the front end


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { //Route::get betekend dat je een get request wilt doen naar de root (/)
    return Inertia::render('Welcome', [ //Inertia::render betekend dat je een react component wilt renderen
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class) //Route::resource betekend dat je alle routes wilt gebruiken van de ChirpController. Resource betekend dat je alle CRUD routes wilt gebruiken
    ->only(['index', 'store', 'update', 'destroy']) //only betekend dat je alleen deze routes wilt gebruiken. Je kunt nu een Chirp aanmaken, updaten en verwijderen
    ->middleware(['auth', 'verified']); //alleen deze routes gebruiken --> als je bent ingelogd en je email is geverifieerd

require __DIR__.'/auth.php'; //require betekend dat je de file wilt gebruiken. __DIR__ betekend dat je de file wilt gebruiken van de huidige directory
