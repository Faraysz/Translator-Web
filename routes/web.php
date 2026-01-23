<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [TranslateController::class, 'index']);
Route::post('/translate', [TranslateController::class, 'translate']);
