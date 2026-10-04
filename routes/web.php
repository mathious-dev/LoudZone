<?php

use App\Livewire\administration\UserCrud;
use App\Livewire\administration\RoleCrud;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::middleware(['role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
        Route::get('/users',UserCrud::class)->name('userCrud');
        Route::get('/roles',RoleCrud::class)->name('roleCrud');
    });
});
