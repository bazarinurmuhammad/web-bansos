<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function() {
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

    Route::get('/sub-district', \App\Http\Controllers\SubDistrictController::class)->name('subdistrict.index');
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    Route::resource('/place', \App\Http\Controllers\PlaceController::class);
    Route::resource('/place/{place}/menu', \App\Http\Controllers\PlaceMenuController::class)->scoped();
});
