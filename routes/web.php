<?php

use App\Livewire\EditTicket;
use App\Livewire\ListTickets;
use App\Livewire\CreateTicket;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('tickets', ListTickets::class)->name('tickets.index');
Route::get('tickets/create', CreateTicket::class)->name('tickets.create');
Route::get('tickets/{ticket}/edit', EditTicket::class)->name('tickets.edit');
