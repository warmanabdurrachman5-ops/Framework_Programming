<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/h', function () {
    return('Hello World');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/student', [StudentController::class, 'index']);