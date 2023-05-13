<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Imputation;
use App\Models\Interne;
use App\Models\Journal;
use App\Models\Nature;
use App\Models\Structure;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function nature(): View
    {
        $rows = Nature::latest()->paginate(15);
        return view('nature.index', compact('rows'));
    }

    public function annotation(): View
    {
        $rows = Annotation::with('user')->latest()->paginate(15);
        return view('annotation.index', compact('rows'));
    }

    public function document(): View
    {
        $rows = Document::with('documentable')->latest()->paginate(15);
        return view('document.index', compact('rows'));
    }

    public function correspondant(): View
    {
        $rows = Correspondant::with('structure')->latest()->paginate(15);
        $structure = Structure::all(['id','nom']);
        return view('correspondant.index', compact('rows','structure'));
    }

    public function arriver(): View
    {
        return view('arriver.index');
    }

    public function depart(): View
    {
        $rows = Depart::with('user','nature','correspondant','courrier')->latest()->paginate(15);
        $courrier = Courrier::with('nature','correspondant')->latest()->get(['id','numero','reference','date']);
        $correspondant = Correspondant::orderBy('nom')->get();
        $nature = Nature::orderBy('nom')->get();
        return view('depart.index', compact('rows','correspondant','nature','courrier'));
    }

    public function interne(): View
    {

        return view('interne.index');
    }

    public function structure(): View
    {
        $rows = Structure::withCount('departements')->latest()->paginate(15);
        return view('structure.index', compact('rows'));
    }

    public function user(): View
    {
        $rows = User::with('departement')->withCount('imputations')->latest()->paginate(15);
        return view('user.index', compact('rows'));
    }


    public function departement(): View
    {
        $rows = Departement::withCount('users')->with('structure')->latest()->paginate(15);
        $structure = Structure::all(['id','nom']);
        return view('departement.index', compact('rows','structure'));
    }

    public function task(): View
    {
        $rows = Task::with('users')->latest()->paginate(15);
        return view('task.index', compact('rows'));
    }

    public function journal(): View
    {
        $rows = Journal::with('users')->latest()->paginate(15);
        return view('journal.index', compact('rows'));
    }

    public function imputation(): View
    {
        $rows = Imputation::with('user','departement','courrier')->latest()->paginate(15);
        $courrier = Courrier::with('nature')->latest()->get(['id','numero','reference','date']);
        $departement = Departement::all();
        // \dd($rows);
        return view('imputation.index', compact('rows','courrier','departement'));
    }
}
