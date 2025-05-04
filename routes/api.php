<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessModuleOneController;
use App\Http\Controllers\ProcessModuleTwoController;

Route::post('/process-m1', [ProcessModuleOneController::class, 'handle']);

Route::post('/process-m2', [ProcessModuleTwoController::class, 'handle']);
