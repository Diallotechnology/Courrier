<?php

use App\Enum\RoleEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InterneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\ImputationController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\SubStructureController;
use App\Http\Controllers\CorrespondantController;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\SubDepartementController;



Route::middleware('auth')->group(function () {
    Route::middleware("role:".RoleEnum::SUPERADMIN->value)->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('structure','structure')->name('structure');

        });

        Route::controller(CorrespondantController::class)->group(function () {
            Route::get('correspondant/delete/all','all_delete')->name('correspondant.delete');
            Route::delete('correspondant/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(AnnotationController::class)->group(function () {
            Route::get('annotation/delete/all','all_delete')->name('annotation.delete');
            Route::delete('annotation/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('user/delete/all','all_delete')->name('user.delete');
            Route::delete('user/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(DepartementController::class)->group(function () {
            Route::get('departement/delete/all','all_delete')->name('departement.delete');
            Route::delete('departement/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('user/delete/all','all_delete')->name('user.delete');
            Route::delete('user/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(DocumentController::class)->group(function () {
            Route::get('document/delete/all','all_delete')->name('document.delete');
            Route::delete('document/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(NatureController::class)->group(function () {
            Route::get('nature/delete/all','all_delete')->name('nature.delete');
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
            Route::get('task/delete/all','all_delete')->name('task.delete');
            Route::delete('task/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(CourrierController::class)->group(function () {
            Route::get('arriver/delete/all','all_delete')->name('arriver.delete');
            Route::delete('arriver/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(DepartController::class)->group(function () {
            Route::get('depart/delete/all','all_delete')->name('depart.delete');
            Route::delete('depart/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(InterneController::class)->group(function () {
            Route::get('interne/delete/all','all_delete')->name('interne.delete');
            Route::delete('interne/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(ImputationController::class)->group(function () {
            Route::get('imputation/delete/all','all_delete')->name('imputation.delete');
            Route::delete('imputation/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(RapportController::class)->group(function () {
            Route::get('rapport/delete/all','all_delete')->name('rapport.delete');
            Route::delete('rapport/delete/{id}','force_delete')->whereNumber('id');
        });

        Route::controller(SubDepartementController::class)->group(function () {
            Route::get('subdepartement/delete/all','all_delete')->name('subdepartement.delete');
            Route::delete('subdepartement/delete/{id}','force_delete')->whereNumber('id');
        });
        Route::resource('structure',StructureController::class)->except('index','create');
    });

    Route::middleware("role:".RoleEnum::ADMIN->value)->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('departement','departement')->name('departement');
            Route::get('subdepartement','subdepartement')->name('subdepartement');
            Route::get('journal','journal')->name('journal');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('user/trash','trash')->name('user.trash');
            Route::get('user/restore/all','all_recover')->name('user.restore');
            Route::get('user/restore/{id}','recover')->whereNumber('id');

        });

        Route::controller(DepartementController::class)->group(function () {
            Route::get('departement/trash','trash')->name('departement.trash');
            Route::get('departement/restore/all','all_recover')->name('departement.restore');
            Route::get('departement/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(SubDepartementController::class)->group(function () {
            Route::get('subdepartement/trash','trash')->name('subdepartement.trash');
            Route::get('subdepartement/restore/all','all_recover')->name('subdepartement.restore');
            Route::get('subdepartement/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('user/trash','trash')->name('user.trash');
            Route::get('user/restore/all','all_recover')->name('user.restore');
            Route::get('user/restore/{id}','recover')->whereNumber('id');
        });
        Route::resource('departement',DepartementController::class)->except('index','create');
        Route::resource('subdepartement',SubDepartementController::class)->except('index','create');
    });

    Route::middleware("role:".RoleEnum::SUPERUSER->value)->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('user', 'user')->name('user');
            Route::get('annotation','annotation')->name('annotation');
        });

        Route::controller(AnnotationController::class)->group(function () {
            Route::get('annotation/trash','trash')->name('annotation.trash');
            Route::get('annotation/restore/all','all_recover')->name('annotation.restore');
            Route::get('annotation/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(CorrespondantController::class)->group(function () {
            Route::get('correspondant/trash','trash')->name('correspondant.trash');
            Route::get('correspondant/restore/all','all_recover')->name('correspondant.restore');
            Route::get('correspondant/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(NatureController::class)->group(function () {
            Route::get('nature/trash','trash')->name('nature.trash');
            Route::get('nature/restore/all','all_recover')->name('nature.restore');
            Route::get('nature/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(DocumentController::class)->group(function () {
            Route::get('document/trash','trash')->name('document.trash');
            Route::get('document/restore/all','all_recover')->name('document.restore');
            Route::get('document/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(CourrierController::class)->group(function () {
            Route::get('arriver/trash','trash')->name('arriver.trash');
            Route::get('arriver/restore/all','all_recover')->name('arriver.restore');
            Route::get('arriver/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(DepartController::class)->group(function () {
            Route::get('depart/trash','trash')->name('depart.trash');
            Route::get('depart/restore/all','all_recover')->name('depart.restore');
            Route::get('depart/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(ImputationController::class)->group(function () {
            Route::get('imputation/trash','trash')->name('imputation.trash');
            Route::get('imputation/restore/all','all_recover')->name('imputation.restore');
            Route::get('imputation/restore/{id}','recover')->whereNumber('id');
        });
        Route::resource('annotation',AnnotationController::class)->except('index','show','create');
        Route::resource('user',UserController::class)->except('index','create');
        Route::resource('courrier/arriver',CourrierController::class)->only('destroy');
        Route::resource('courrier/depart',DepartController::class)->only('destroy');
        Route::resource('correspondant',CorrespondantController::class)->only('destroy');
        Route::resource('nature',NatureController::class)->only('destroy');
        Route::resource('imputation',ImputationController::class)->except('index');
        Route::resource('document',DocumentController::class)->only('destroy');
    });

    Route::middleware("role:".RoleEnum::SECRETAIRE->value)->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('rapport','rapport')->name('rapport');
            Route::get('agenda','agenda')->name('agenda');
            Route::get('document', 'document')->name('document');
            Route::get('dashboard','dashboard')->name('dashboard');
            Route::get('nature','nature')->name('nature');
            Route::get('correspondant','correspondant')->name('correspondant');
        });

        Route::view('courrier/arriver','arriver.index')->name('arriver');
        Route::view('courrier/depart','depart.index')->name('depart');
        Route::view('courrier/interne','interne.index')->name('interne');
        Route::view('courrier/suivie','suivie')->name('suivie');
        Route::view('imputation','imputation.index')->name('imputation');
        Route::view('tache','task.index')->name('task');
        Route::view('search','search')->name('search');

        Route::controller(TaskController::class)->group(function () {
            Route::get('task/trash','trash')->name('task.trash');
            Route::get('task/restore/all','all_recover')->name('task.restore');
            Route::get('task/restore/{id}','recover')->whereNumber('id');
        });
        Route::controller(InterneController::class)->group(function () {
            Route::get('interne/trash','trash')->name('interne.trash');
            Route::get('interne/restore/all','all_recover')->name('interne.restore');
            Route::get('interne/restore/{id}','recover')->whereNumber('id');
        });

        Route::controller(RapportController::class)->group(function () {
            Route::get('rapport/trash','trash')->name('rapport.trash');
            Route::get('rapport/restore/all','all_recover')->name('rapport.restore');
            Route::get('rapport/restore/{id}','recover')->whereNumber('id');
        });
        Route::resource('courrier/arriver',CourrierController::class)->except('index','destroy','create');
        Route::resource('courrier/depart',DepartController::class)->except('index','destroy');
        Route::resource('courrier/interne',InterneController::class)->except('index');
        Route::resource('correspondant',CorrespondantController::class)->except('index','create','destroy');
        Route::resource('nature',NatureController::class)->except('index','show','create','destroy');
        Route::resource('rapport',RapportController::class)->except('index');
        Route::resource('task',TaskController::class)->except('index');
        Route::resource('reponse',ReponseController::class)->except('index','show','create');
    });

    Route::resource('backup',BackupController::class)->except('index');
    // Route::get('test', [GmailController::class, 'test'])->name('test');
Route::get('listMessages', [GmailController::class, 'listMessages'])->name('gmail.messages');
// Route for authentication callback
Route::get('/auth/callback', [GmailController::class, 'callback']);

// Route to initiate authentication
Route::get('/auth', [GmailController::class, 'authenticate']);
});


require __DIR__.'/auth.php';
