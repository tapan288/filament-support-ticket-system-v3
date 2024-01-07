<?php

use App\Livewire\CreateTicket;
use App\Livewire\ListTickets;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('tickets', ListTickets::class)->name('tickets.index');
Route::get('tickets/create', CreateTicket::class)->name('tickets.create');
