<?php

use App\Http\Controllers\CandidatureController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('/form', [CandidatureController::class, 'create']);

Route::post('/form', [CandidatureController::class, 'store']);
