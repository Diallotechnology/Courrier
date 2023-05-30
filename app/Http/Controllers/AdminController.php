<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Task;
use App\Models\User;
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

    protected function getAnnotationUserIds($structureId)
    {
        $depIds = Structure::findOrFail($structureId)->departements()->pluck('id');
        $subIds = SubDepartement::whereIn('departement_id', $depIds)->pluck('id');

        return User::where(function ($query) use ($depIds) {
            $query->user_departement()
                ->whereIn('userable_id', $depIds);
        })->orWhere(function ($query) use ($subIds) {
            $query->user_subdepartement()
                ->whereIn('userable_id', $subIds);
        })->pluck('id');
    }

    protected function getUserIds($structureId)
    {
        $depIds = Structure::findOrFail($structureId)->departements()->pluck('id');
        $subIds = SubDepartement::whereIn('departement_id', $depIds)->pluck('id');

         User::where(function ($query) use ($depIds) {
            $query->user_departement()
                ->whereIn('userable_id', $depIds);
        })->orWhere(function ($query) use ($subIds) {
            $query->user_subdepartement()
                ->whereIn('userable_id', $subIds);
        })->pluck('id');
    }

    public function annotation(): View
    {
        $user = Auth::user();
        $query = Annotation::with('user')->latest();

        if ($user->isSuperuser()) {
            $query->where('user_id', $user->id);
        } elseif ($user->isAdmin()) {
            $structureId = $user->userable->structure_id ?: $user->userable->departement->structure_id;
            $query->whereIn('user_id', $this->getAnnotationUserIds($structureId));
        }

        $rows = $query->paginate(15);

        return view('annotation.index', compact('rows'));
    }

    public function document(): View
    {
        $rows = Document::with('documentable')->latest()->paginate(15);
        return view('document.index', compact('rows'));
    }

    public function correspondant(): View
    {
        $structure = Auth::user()->isSuperadmin() ? Structure::all(['id', 'nom']) : new Collection();
        $rows = Correspondant::with('structure')->latest()->paginate(15);
        return view('correspondant.index', compact('rows', 'structure'));
    }

    public function dashboard(): View
    {
        $arriver = Courrier::selectRaw('COUNT(id) as total_arrriver, DATE(created_at) as day')
            ->orderBy('day')->groupBy('day')->pluck('total_arrriver', 'day');

        $tasks = Task::where('createur_id', Auth::user()->id)->latest()->take(6)->get();

        return view('dashboard', compact('arriver', 'tasks'));
    }


    public function structure(): View
    {
        $rows = Auth::user()->isSuperadmin() ? Structure::withCount('departements')->latest()->paginate(15) : new Paginator(new Collection(), null, null);
        return view('structure.index', compact('rows'));
    }


    public function user(): View
    {
        $user = Auth::user();
        $query = User::with('userable')->withCount('imputations')->latest();

        if ($user->isSuperadmin()) {
            $query->whereHas('userable');
            $departement = Departement::with('subdepartements')->get();
        } elseif ($user->isSuperuser()) {
            $query->whereUserableType($user->userable_type)->whereUserableId($user->userable_id);
            $departement = new Collection();
        } elseif ($user->isAdmin()) {
            $structureId = $user->userable->structure_id ?: $user->userable->departement->structure_id;
            $depIds = Structure::findOrFail($structureId)->departements()->pluck('id');
            $subIds = SubDepartement::whereIn('departement_id', $depIds)->pluck('id');

            $rows = User::where(function ($query) use ($depIds) {
                $query->user_departement()
                    ->whereIn('userable_id', $depIds);
            })->orWhere(function ($query) use ($subIds) {
                $query->user_subdepartement()
                    ->whereIn('userable_id', $subIds);
            })->latest()->paginate(15);
            $departement = Departement::with('subdepartements')->whereStructureId($structureId)->get();
        }

        $rows = $query->paginate(15);

        return view('user.index', compact('rows', 'departement'));
    }


    public function departement(): View
    {
        $user = Auth::user();
        $query = Departement::withCount('users')->with('structure')->latest();

        if ($user->isSuperadmin()) {
            $query->whereHas('structure');
            $structure = Structure::all(['id', 'nom']);
        } elseif ($user->isAdmin()) {
            $structureId = $user->userable->structure_id ?: $user->userable->departement->structure_id;
            $query->whereStructureId($structureId);
            $structure = new Collection();
        }

        $rows = $query->paginate(15);

        return view('departement.index', compact('rows', 'structure'));
    }


    public function rapport(): View
    {
        $user = Auth::user();
        $structureId = $user->isSuperadmin() ? null : ($user->userable->structure_id ?: $user->userable->departement->structure_id);
        $rows = Rapport::when($user->isSuperadmin(), function ($query) {
            $query->latest();
        })->when($structureId, function ($query) use ($structureId) {
            $query->whereStructureId($structureId);
        })->latest()->paginate(15);

        return view('rapport.index', compact('rows'));
    }


    public function agenda(): View
    {
        $user = Auth::user();
        $agenda = $user->isSuperadmin() ? Task::with('users')->get() : Task::with('users')->whereCreateurId($user->id)->get();
        $events = $agenda->map(function ($row) {
            return [
                'title' => $row->nom,
                'start' => $row->debut,
                'end' => $row->fin,
            ];
        });

        return view('agenda', compact('events'));
    }

    public function journal(): View
    {
        $rows = Journal::with('users')->latest()->paginate(15);
        return view('journal.index', compact('rows'));
    }
}
