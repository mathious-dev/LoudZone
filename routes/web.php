<?php

use App\Livewire\administration\role\RoleList;
use App\Livewire\administration\user\UserList;
use App\Livewire\administration\user\UserForm;
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
        Route::get('/users',UserList::class)->name('userList');
        Route::get('/user/create',UserForm::class)->name('userForm.create');
        Route::get('/user/edit',UserForm::class)->name('userForm.edit');
        Route::get('/roles',RoleList::class)->name('roleList');
    });
});
