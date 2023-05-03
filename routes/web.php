<?php

use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CorrespondantController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImputationController;
use App\Http\Controllers\InterneController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TaskController;
use Database\Factories\ImputationFactory;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('annotation',AnnotationController::class)->except('index');
Route::resource('archive',ArchiveController::class)->withTrashed()->except('index');
Route::resource('correspondant',CorrespondantController::class)->withTrashed()->except('index');
Route::resource('courrier/arriver',CourrierController::class)->withTrashed()->except('index');
Route::resource('courrier/depart',DepartController::class)->withTrashed()->except('index');
Route::resource('courrier/interne',InterneController::class)->withTrashed()->except('index');
Route::resource('departement',DepartementController::class)->withTrashed()->except('index');
Route::resource('document',DocumentController::class)->withTrashed()->except('index');
Route::resource('history',HistoryController::class)->withTrashed()->except('index');
Route::resource('imputation',ImputationController::class)->withTrashed()->except('index');
Route::resource('nature',NatureController::class)->withTrashed()->except('index');
Route::resource('rapport',RapportController::class)->withTrashed()->except('index');
Route::resource('tache',TaskController::class)->withTrashed()->except('index');
require __DIR__.'/auth.php';
