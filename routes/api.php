<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;

Route::post('/process', [ProcessController::class, 'handle']);
