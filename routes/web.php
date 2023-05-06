<?php

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\StructureController;
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



    Route::controller(AdminController::class)->group(function () {
        Route::get('courrier/arriver','arriver')->name('arriver');
        Route::get('courrier/depart','depart')->name('depart');
        Route::get('courrier/interne','interne')->name('interne');
        Route::get('nature','nature')->name('nature');
        Route::get('correspondant','correspondant')->name('correspondant');
        Route::get('document', 'document')->name('document');
        Route::get('annotation','annotation')->name('annotation');
        Route::get('departement','departement')->name('departement');
        Route::get('structure','structure')->name('structure');
    });
});


Route::resource('annotation',AnnotationController::class)->except('index','show','create');
Route::resource('archive',ArchiveController::class)->except('index');
Route::resource('correspondant',CorrespondantController::class)->except('index','create','show');
Route::resource('courrier/arriver',CourrierController::class)->except('index');
Route::resource('courrier/depart',DepartController::class)->except('index');
Route::resource('courrier/interne',InterneController::class)->except('index');
Route::resource('departement',DepartementController::class)->except('index','create');
Route::resource('structure',StructureController::class)->except('index','create');
Route::resource('document',DocumentController::class)->except('index','create');
Route::resource('history',HistoryController::class)->except('index');
Route::resource('imputation',ImputationController::class)->except('index');
Route::resource('nature',NatureController::class)->except('index','show','create');
Route::resource('rapport',RapportController::class)->except('index');
Route::resource('tache',TaskController::class)->except('index');
require __DIR__.'/auth.php';
