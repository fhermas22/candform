<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('/form', function () {
    return view('form');
});
