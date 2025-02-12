<?php

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
