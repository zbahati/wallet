<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/transaction', TransactionController::class)->middleware('auth');
Route::get('/transactions', [TransactionController::class, 'allTransactions'])->middleware('auth')->name('transactions');
Route::get('transactions/export/', [TransactionController::class, 'export'])->name('transactions.export');
Route::post('transactions/import/', [TransactionController::class, 'import'])->name('transactions.import');
Route::get('/transactions/import', [TransactionController::class, 'showImportForm'])->name('transactions.import-form');
require __DIR__ . '/auth.php';
