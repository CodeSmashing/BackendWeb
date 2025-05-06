<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/module-page', [
    ModuleController::class, 'index'
])->name('modules');
