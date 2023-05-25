<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Annotation;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Journal;
use App\Models\Nature;
use App\Models\Rapport;
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

    public function dashboard(): View
    {
        $arriver = Courrier::selectRaw('COUNT(id) as total_arrriver, DATE(created_at) as day')->orderBy('day')
        ->groupBy('day')->pluck('total_arrriver', 'day');

        $depart = Courrier::selectRaw('COUNT(id) as total_depart, DATE(created_at) as day')->orderBy('day')
        ->groupBy('day')->pluck('total_depart', 'day');

        $interne = Courrier::selectRaw('COUNT(id) as total_interne, DATE(created_at) as day')->orderBy('day')
        ->groupBy('day')->pluck('total_interne', 'day');

        $tasks = task::latest()->take(6)->get();
        // \dd($arriver->values());
        return view('dashboard', compact('arriver','tasks','interne','depart'));
    }

    public function structure(): View
    {
        $rows = Structure::withCount('departements')->latest()->paginate(15);
        return view('structure.index', compact('rows','tasks'));
    }

    public function user(): View
    {
        $rows = User::with('departement')->withCount('imputations')->latest()->paginate(15);
        $departement = Departement::all();
        return view('user.index', compact('rows','departement'));
    }


    public function departement(): View
    {
        $rows = Departement::withCount('users')->with('structure')->latest()->paginate(15);
        $structure = Structure::all(['id','nom']);
        return view('departement.index', compact('rows','structure'));
    }

    public function rapport(): View
    {
        $rows = Rapport::latest()->paginate(15);
        return view('rapport.index', compact('rows'));
    }

    public function agenda(): View
    {
        $events = [];
        $agenda = Agenda::all();

        foreach ($agenda as $row) {
            $events[] = [
                'title' => $row->nom,
                'start' => $row->debut,
                'end' => $row->fin,
            ];
        }
        return view('agenda', \compact('events'));
    }

    public function journal(): View
    {
        $rows = Journal::with('users')->latest()->paginate(15);
        return view('journal.index', compact('rows'));
    }
}
