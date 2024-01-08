<?php

use App\Livewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', Livewire\UserLogin::class)->name('login');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'tickets',
    'as' => 'tickets.',
], function () {
    Route::get('/', Livewire\ListTickets::class)->name('index');
    Route::get('create', Livewire\CreateTicket::class)->name('create');
    Route::get('{ticket}/edit', Livewire\EditTicket::class)->name('edit');
});
