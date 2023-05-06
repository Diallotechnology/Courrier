<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Interne;
use App\Models\Nature;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function nature(): View
    {
        $rows = Nature::all();
        return view('nature.index', compact('rows'));
    }

    public function annotation(): View
    {
        $rows = Annotation::all();
        return view('annotation.index', compact('rows'));
    }

    public function document(): View
    {
        $rows = Document::all();
        return view('document.index', compact('rows'));
    }

    public function correspondant(): View
    {
        $rows = Correspondant::all();
        return view('correspondant.index', compact('rows'));
    }

    public function arriver(): View
    {
        $rows = Courrier::all();
        return view('arriver.index', compact('rows'));
    }

    public function depart(): View
    {
        $rows = Depart::all();
        return view('depart.index', compact('rows'));
    }

    public function interne(): View
    {
        $rows = Interne::all();
        return view('interne.index', compact('rows'));
    }

    public function structure(): View
    {
        $rows = Structure::withCount('departements')->get();
        return view('structure.index', compact('rows'));
    }

    public function user(): View
    {
        $rows = User::all();
        return view('interne.index', compact('rows'));
    }


    public function departement(): View
    {
        $rows = Departement::withCount('users')->with('structure')->latest()->get();
        $structure = Structure::all(['id','nom']);
        return view('departement.index', compact('rows','structure'));
    }
}
