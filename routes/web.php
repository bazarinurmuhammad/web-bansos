<?php

use App\Http\Controllers\AdminProporserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProporserController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\RejectController;
use App\Http\Controllers\RootController;
use App\Models\Proporser;

Route::get('/', [RootController::class, 'index'])->name('root');
Route::view('/login', 'auth.login')->name('login');

Route::get('/proporser', [ProporserController::class, 'index'])->name('proporse.index');
Route::post('/proporser', [ProporserController::class, 'store'])->name('proporse.store');

Route::middleware('auth')->group(function() {
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

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
    Route::put('/rw/{id}', [RwController::class, 'edit'])->name('rw.update');
    Route::delete('/rw/{id}', [RwController::class, 'destroy'])->name('rw.destroy');

    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income/create', [IncomeController::class, 'store'])->name('income.store');
    Route::get('/income/{id}', [IncomeController::class, 'edit'])->name('income.edit');
    Route::put('/income/{id}', [IncomeController::class, 'update'])->name('income.update');
    Route::delete('/income/{id}', [IncomeController::class, 'destroy'])->name('income.destroy');

    Route::get('/manage-proporser', [AdminProporserController::class, 'index'])->name('manage-proporser.index');
    Route::get('/manage-proporser/create', [AdminProporserController::class, 'create']);
    Route::post('/manage-proporser/store', [AdminProporserController::class, 'store']);
    Route::get('/manage-proporser/{id}', [AdminProporserController::class, 'edit']);
    Route::put('/manage-proporser/{id}', [AdminProporserController::class, 'update']);
    Route::delete('/manage-proporser/{id}', [AdminProporserController::class, 'destroy']);

    Route::get('/manage-receiver', [ReceiverController::class, 'index'])->name('manage-receiver.index');
    Route::get('/manage-receiver/{id}', [ReceiverController::class, 'edit']);
    Route::put('/manage-receiver/{id}', [ReceiverController::class, 'update']);
    Route::delete('/manage-receiver/{id}', [ReceiverController::class, 'destroy']);

    Route::get('/manage-reject', [RejectController::class, 'index'])->name('manage-reject.index');
    Route::get('/manage-reject/{id}', [RejectController::class, 'edit']);
    Route::put('/manage-reject/{id}', [RejectController::class, 'update']);
    Route::delete('/manage-reject/{id}', [RejectController::class, 'destroy']);

});
