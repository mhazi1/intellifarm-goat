<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\LivestockController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::post('/add-farm', [FarmController::class, 'store'])->name('farm.add');
Route::post('/add-livestock', [LivestockController::class, 'store'])->name('livestock.add');
Route::post('/add-farm-employee', [FarmController::class, 'store_employee'])->name('farm.add.employee');
