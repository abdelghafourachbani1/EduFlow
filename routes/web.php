<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/', 'home');
Route::view('/login', 'login');
Route::view('/register', 'register');

Route::view('/courses','courses');
Route::view('/courses/{id}','course-details');
