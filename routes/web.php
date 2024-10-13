<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});
Route::get('/კონფიდენციალობა', function () {
    return view('privacy');
});
Route::get('/გამოყენების-წესები', function () {
    return view('terms');
});
