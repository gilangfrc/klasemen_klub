<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/add-club', [MainController::class, 'addClub'])->name('add.club');
Route::post('/update-standings', [MainController::class, 'updateStandings'])->name('update.standings');
Route::post('/reset-standings', [MainController::class, 'resetStandings'])->name('reset.standings');
