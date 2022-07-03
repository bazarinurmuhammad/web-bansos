<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProporserController;

Route::view('/', 'landingPage');
Route::redirect('/login', 'login');

Route::get('/proporser', [ProporserController::class, 'index'])->name('proporse.index');
Route::post('/proporser', [ProporserController::class, 'store'])->name('proporse.store');

Route::middleware('auth')->group(function() {
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

    Route::get('/sub-district', \App\Http\Controllers\SubDistrictController::class)->name('subdistrict.index');
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    Route::resource('/place', \App\Http\Controllers\PlaceController::class);
    Route::resource('/place/{place}/menu', \App\Http\Controllers\PlaceMenuController::class)->scoped();



    Route::get('/rt', [RtController::class, 'index'])->name('rt.index');
    Route::get('/rt/create', [RtController::class, 'create'])->name('rt.create');
    Route::post('/rt/create', [RtController::class, 'store'])->name('rt.store');
    Route::get('/rt/{id}', [RtController::class, 'edit'])->name('rt.edit');
    Route::put('/rt/{id}', [RtController::class, 'update'])->name('rt.update');
    Route::delete('/rt/{id}', [RtController::class, 'destroy'])->name('rt.destroy');

    Route::get('/rw', [RwController::class, 'index'])->name('rw.index');
    Route::get('/rw/create', [RwController::class, 'create'])->name('rw.create');
    Route::post('/rw/create', [RwController::class, 'store'])->name('rw.store');
    Route::get('/rw/{id}', [RwController::class, 'edit'])->name('rw.edit');
    Route::put
    ('/rw/{id}', [RwController::class, 'edit'])->name('rw.update');
    Route::delete('/rw/{id}', [RwController::class, 'destroy'])->name('rw.destroy');

    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income/create', [IncomeController::class, 'store'])->name('income.store');
    Route::get('/income/{id}', [IncomeController::class, 'edit'])->name('income.edit');
    Route::put('/income/{id}', [IncomeController::class, 'update'])->name('income.update');
    Route::delete('/income/{id}', [IncomeController::class, 'destroy'])->name('income.destroy');

});
