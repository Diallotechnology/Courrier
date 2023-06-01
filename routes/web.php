<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\BackupController;
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
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\SubDepartementController;
use App\Http\Controllers\SubStructureController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(AdminController::class)->group(function () {
        // Route::get('courrier/arriver','arriver')->name('arriver');
        // Route::get('courrier/depart','depart')->name('depart');
        // Route::get('courrier/interne','interne')->name('interne');
        // Route::get('courrier/suivie','suivie')->name('suivie');
        Route::get('nature','nature')->name('nature');
        Route::get('correspondant','correspondant')->name('correspondant');
        Route::get('document', 'document')->name('document');
        Route::get('annotation','annotation')->name('annotation');
        Route::get('departement','departement')->name('departement');
        Route::get('subdepartement','subdepartement')->name('subdepartement');
        Route::get('structure','structure')->name('structure');
        Route::get('user','user')->name('user');
        Route::get('journal','journal')->name('journal');
        Route::get('agenda','agenda')->name('agenda');
        Route::get('rapport','rapport')->name('rapport');
        Route::get('dashboard','dashboard')->name('dashboard');
    });

    Route::view('courrier/arriver','arriver.index')->name('arriver');
    Route::view('courrier/depart','depart.index')->name('depart');
    Route::view('courrier/interne','interne.index')->name('interne');
    Route::view('courrier/suivie','suivie')->name('suivie');
    Route::view('imputation','imputation.index')->name('imputation');
    Route::view('tache','task.index')->name('task');
    Route::view('search','search')->name('search');

    Route::controller(CorrespondantController::class)->group(function () {
        Route::get('correspondant/trash','trash')->name('correspondant.trash');
        Route::get('correspondant/restore/all','all_recover')->name('correspondant.restore');
        Route::get('correspondant/delete/all','all_delete')->name('correspondant.delete');
        Route::get('correspondant/restore/{id}','recover')->whereNumber('id');
        Route::delete('correspondant/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(AnnotationController::class)->group(function () {
        Route::get('annotation/trash','trash')->name('annotation.trash');
        Route::get('annotation/restore/all','all_recover')->name('annotation.restore');
        Route::get('annotation/delete/all','all_delete')->name('annotation.delete');
        Route::get('annotation/restore/{id}','recover')->whereNumber('id');
        Route::delete('annotation/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('user/trash','trash')->name('user.trash');
        Route::get('user/restore/all','all_recover')->name('user.restore');
        Route::get('user/delete/all','all_delete')->name('user.delete');
        Route::get('user/restore/{id}','recover')->whereNumber('id');
        Route::delete('user/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(DepartementController::class)->group(function () {
        Route::get('departement/trash','trash')->name('departement.trash');
        Route::get('departement/restore/all','all_recover')->name('departement.restore');
        Route::get('departement/delete/all','all_delete')->name('departement.delete');
        Route::get('departement/restore/{id}','recover')->whereNumber('id');
        Route::delete('departement/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('user/trash','trash')->name('user.trash');
        Route::get('user/restore/all','all_recover')->name('user.restore');
        Route::get('user/delete/all','all_delete')->name('user.delete');
        Route::get('user/restore/{id}','recover')->whereNumber('id');
        Route::delete('user/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(DocumentController::class)->group(function () {
        Route::get('document/trash','trash')->name('document.trash');
        Route::get('document/restore/all','all_recover')->name('document.restore');
        Route::get('document/delete/all','all_delete')->name('document.delete');
        Route::get('document/restore/{id}','recover')->whereNumber('id');
        Route::delete('document/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(NatureController::class)->group(function () {
        Route::get('nature/trash','trash')->name('nature.trash');
        Route::get('nature/restore/all','all_recover')->name('nature.restore');
        Route::get('nature/delete/all','all_delete')->name('nature.delete');
        Route::get('nature/restore/{id}','recover')->whereNumber('id');
        Route::delete('nature/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(StructureController::class)->group(function () {
        Route::get('structure/trash','trash')->name('structure.trash');
        Route::get('structure/restore/all','all_recover')->name('structure.restore');
        Route::get('structure/delete/all','all_delete')->name('structure.delete');
        Route::get('structure/restore/{id}','recover')->whereNumber('id');
        Route::delete('structure/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(TaskController::class)->group(function () {
        Route::get('task/trash','trash')->name('task.trash');
        Route::get('task/restore/all','all_recover')->name('task.restore');
        Route::get('task/delete/all','all_delete')->name('task.delete');
        Route::get('task/restore/{id}','recover')->whereNumber('id');
        Route::delete('task/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(CourrierController::class)->group(function () {
        Route::get('arriver/trash','trash')->name('arriver.trash');
        Route::get('arriver/restore/all','all_recover')->name('arriver.restore');
        Route::get('arriver/delete/all','all_delete')->name('arriver.delete');
        Route::get('arriver/restore/{id}','recover')->whereNumber('id');
        Route::delete('arriver/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(DepartController::class)->group(function () {
        Route::get('depart/trash','trash')->name('depart.trash');
        Route::get('depart/restore/all','all_recover')->name('depart.restore');
        Route::get('depart/delete/all','all_delete')->name('depart.delete');
        Route::get('depart/restore/{id}','recover')->whereNumber('id');
        Route::delete('depart/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(InterneController::class)->group(function () {
        Route::get('interne/trash','trash')->name('interne.trash');
        Route::get('interne/restore/all','all_recover')->name('interne.restore');
        Route::get('interne/delete/all','all_delete')->name('interne.delete');
        Route::get('interne/restore/{id}','recover')->whereNumber('id');
        Route::delete('interne/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(ImputationController::class)->group(function () {
        Route::get('imputation/trash','trash')->name('imputation.trash');
        Route::get('imputation/restore/all','all_recover')->name('imputation.restore');
        Route::get('imputation/delete/all','all_delete')->name('imputation.delete');
        Route::get('imputation/restore/{id}','recover')->whereNumber('id');
        Route::delete('imputation/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(RapportController::class)->group(function () {
        Route::get('rapport/trash','trash')->name('rapport.trash');
        Route::get('rapport/restore/all','all_recover')->name('rapport.restore');
        Route::get('rapport/delete/all','all_delete')->name('rapport.delete');
        Route::get('rapport/restore/{id}','recover')->whereNumber('id');
        Route::delete('rapport/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(SubStructureController::class)->group(function () {
        Route::get('substructure/trash','trash')->name('substructure.trash');
        Route::get('substructure/restore/all','all_recover')->name('substructure.restore');
        Route::get('substructure/delete/all','all_delete')->name('substructure.delete');
        Route::get('substructure/restore/{id}','recover')->whereNumber('id');
        Route::delete('substructure/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::controller(SubDepartementController::class)->group(function () {
        Route::get('subdepartement/trash','trash')->name('subdepartement.trash');
        Route::get('subdepartement/restore/all','all_recover')->name('subdepartement.restore');
        Route::get('subdepartement/delete/all','all_delete')->name('subdepartement.delete');
        Route::get('subdepartement/restore/{id}','recover')->whereNumber('id');
        Route::delete('subdepartement/delete/{id}','force_delete')->whereNumber('id');
    });

    Route::resource('annotation',AnnotationController::class)->except('index','show','create');
    Route::resource('user',UserController::class)->except('index','create');
    Route::resource('archive',ArchiveController::class)->except('index');
    Route::resource('correspondant',CorrespondantController::class)->except('index','create');
    Route::resource('courrier/arriver',CourrierController::class)->except('index');
    Route::resource('courrier/depart',DepartController::class)->except('index');
    Route::resource('courrier/interne',InterneController::class)->except('index');
    Route::resource('departement',DepartementController::class)->except('index','create');
    Route::resource('structure',StructureController::class)->except('index','create');
    Route::resource('document',DocumentController::class)->except('index','create');
    Route::resource('imputation',ImputationController::class)->except('index');
    Route::resource('nature',NatureController::class)->except('index','show','create');
    Route::resource('reponse',ReponseController::class)->except('index','show','create');
    Route::resource('rapport',RapportController::class)->except('index');
    Route::resource('task',TaskController::class)->except('index');
    Route::resource('backup',BackupController::class)->except('index');
    Route::resource('subdepartement',SubDepartementController::class)->except('index','create');
    Route::resource('substructure',SubStructureController::class)->except('index','create');
});

require __DIR__.'/auth.php';
