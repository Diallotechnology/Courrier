<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Task;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Nature;
use App\Models\Journal;
use App\Models\Rapport;
use App\Models\Courrier;
use App\Models\Document;
use App\Models\Structure;
use App\Models\Annotation;
use App\Models\Departement;
use App\Models\SubStructure;
use App\Models\Correspondant;
use App\Models\SubDepartement;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class AdminController extends Controller
{
    public function nature(): View
    {
        $rows = Nature::latest()->paginate(15);
        return view('nature.index', compact('rows'));
    }

    public function annotation(): View
    {
        if (Auth::user()->isSuperuser()) {
            $rows = Annotation::with('user')->where('user_id', Auth::user()->id)->latest()->paginate(15);
        }
        if (Auth::user()->isSuperadmin()) {

            $rows = Annotation::with('user')->latest()->paginate(15);
        }

        if (Auth::user()->isAdmin()) {
            $structure_id = Auth::user()->userable->structure_id ? : Auth::user()->userable->departement->structure_id;
            // get user structure
            $item = Structure::findOrFail($structure_id);
            // get structure departement
            $dep_id = $item->departements()->pluck('id');
            // get structure departement subdepartement
            $sub_id = SubDepartement::whereIn('departement_id',$dep_id)->pluck('id');

            $users = User::where(function ($query) use ($dep_id) {
                $query->where('userable_type', 'App\Models\Departement')
                // $query->user_departement()
                      ->whereIn('userable_id', $dep_id);
            })->orWhere(function ($query) use ($sub_id) {
                  // $query->scopeUser_subdepartement()
                $query->where('userable_type', 'App\Models\SubDepartement')
                      ->whereIn('userable_id', $sub_id);
            })->pluck('id');
            $rows = Annotation::with('user')->whereIn('user_id',$users)->latest()->paginate(15);
        }

        return view('annotation.index', compact('rows'));
    }

    public function document(): View
    {
        // if (Auth::user()->isSuperadmin()) {
            $rows = Document::with('documentable')->latest()->paginate(15);
        // }
        // if (Auth::user()->isSuperuser()) {

        // }
        // if (Auth::user()->isAdmin()) {

        // }
        return view('document.index', compact('rows'));
    }

    public function correspondant(): View
    {
        if(Auth::user()->isSuperadmin()) {
            $structure = Structure::all(['id','nom']);
        } else {
            $structure = new Collection();
        }

        $rows = Correspondant::with('structure')->latest()->paginate(15);

        return view('correspondant.index', compact('rows','structure'));
    }

    public function dashboard(): View
    {
        $arriver = Courrier::selectRaw('COUNT(id) as total_arrriver, DATE(created_at) as day')
        ->orderBy('day')->groupBy('day')->pluck('total_arrriver', 'day');

        $tasks = task::where('createur_id', Auth::user()->id)->latest()->take(6)->get();

        return view('dashboard', compact('arriver','tasks'));
    }

    public function structure(): View
    {
        if (Auth::user()->isSuperadmin()) {

            $rows = Structure::withCount('departements')->latest()->paginate(15);
        } else {
            $rows = new Paginator(new Collection(), null, null);
        }
        return view('structure.index', compact('rows'));
    }

    public function substructure(): View
    {
        if (Auth::user()->isSuperadmin()) {
            $rows = SubStructure::with('structure')->latest()->paginate(15);
        }

        if (Auth::user()->isAdmin()) {
            $structure_id = Auth::user()->userable->structure_id ? : Auth::user()->userable->departement->structure_id;
            $rows = SubStructure::with('structure')->whereStructureId($structure_id)->latest()->paginate(15);
        }

        return view('structure.index', compact('rows'));
    }

    public function user(): View
    {
        if(Auth::user()->isSuperadmin()) {
            $rows = User::with('userable')->withCount('imputations')->latest()->paginate(15);
            $departement = Departement::with('subdepartements')->get();
        }

        if(Auth::user()->isSuperuser()) {
            $rows = User::with('userable')->withCount('imputations')->whereUserableType(Auth::user()->userable_type)->whereUserableId(Auth::user()->userable_id)
            ->latest()->paginate(15);
            $departement = new Collection();
        }

        if(Auth::user()->isAdmin()) {
            $structure_id = Auth::user()->userable->structure_id ? : Auth::user()->userable->departement->structure_id;
            // get user structure
            $item = Structure::findOrFail($structure_id);
            // get structure departement
            $dep_id = $item->departements()->pluck('id');
            // get structure departement subdepartement
            $sub_id = SubDepartement::whereIn('departement_id',$dep_id)->pluck('id');

            $rows = User::where(function ($query) use ($dep_id) {
                $query->where('userable_type', 'App\Models\Departement')
                // $query->user_departement()
                      ->whereIn('userable_id', $dep_id);
            })->orWhere(function ($query) use ($sub_id) {
                  // $query->scopeUser_subdepartement()
                $query->where('userable_type', 'App\Models\SubDepartement')
                      ->whereIn('userable_id', $sub_id);
            })->latest()->paginate(15);

            $departement = Departement::with('subdepartements')->whereStructureId($structure_id)->get();

        }

        return view('user.index', compact('rows','departement'));
    }


    public function departement(): View
    {
        if(Auth::user()->isSuperadmin()) {
            $rows = Departement::withCount('users')->with('structure')->latest()->paginate(15);
            $structure = Structure::all(['id','nom']);
        }

        if(Auth::user()->isAdmin()) {
            $structure_id = Auth::user()->userable->structure_id ? : Auth::user()->userable->departement->structure_id;
            $rows = Departement::withCount('users')->with('structure')
            ->whereStructureId($structure_id)->latest()->paginate(15);
            $structure = new Collection();
        }

        return view('departement.index', compact('rows','structure'));
    }

    public function rapport(): View
    {
        if (Auth::user()->isSuperadmin()) {
            $rows = Rapport::latest()->paginate(15);
        } else {
            $structure_id = Auth::user()->userable->structure_id ? : Auth::user()->userable->departement->structure_id;
            $rows = Rapport::whereStructureId($structure_id)->latest()->paginate(15);
        }

        return view('rapport.index', compact('rows'));
    }

    public function agenda(): View
    {
        if (Auth::user()->isSuperadmin()) {
            $agenda = Task::with('users')->get();
        } else {
            $agenda = Task::with('users')->whereCreateurId(Auth::user()->id)->get();
        }
        $events = [];

        foreach ($agenda as $row) {
            $events[] = [
                'title' => $row->nom,
                'start' => $row->debut,
                'end' => $row->fin,
            ];
        }
        return view('agenda', compact('events'));
    }

    public function journal(): View
    {
        $rows = Journal::with('users')->latest()->paginate(15);
        return view('journal.index', compact('rows'));
    }
}
