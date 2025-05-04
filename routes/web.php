<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/module-m1', function () {
    return view('module-m1');
})->name('module-1');

Route::get('/module-m2', function () {
    return view('module-m2');
})->name('module-2');
