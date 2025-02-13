<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::post('/add-farm', [FarmController::class, 'store'])->name('farm.add');
