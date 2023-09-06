<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nature;
use App\Models\Interne;
use App\Helper\DeleteAction;
use App\Enum\CourrierInterneEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreInterneRequest;
use App\Http\Requests\UpdateInterneRequest;
use App\Notifications\CourrierNotification;
use Illuminate\Support\Facades\Notification;

class InterneController extends Controller
{
    use DeleteAction;

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Auth::user()->can('create', Interne::class);
        $isSuperadmin = Auth::user()->isSuperadmin();
        $user = User::with('userable')->StructureUser()->latest()->get()->groupBy('userable.nom');
        $typeQuery = Nature::orderBy('nom')->when(! $isSuperadmin, fn ($query) => $query->ByStructure());
        $type = $typeQuery->get();

        return view('interne.create', compact('user', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterneRequest $request): RedirectResponse
    {
        DB::transaction(function () use($request) {
        $item = Interne::create($request->validated());
        $item->generateId('CI');
        $user = User::findOrFail($request->destinataire_id);
        $notification = new CourrierNotification($item, 'Vous avez reçu un nouveau courrier interne');
        $user->notify($notification);
        $this->file_uplode($request, $item);
        toastr()->success('Courrier envoyé avec succès!');
        });
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Interne $interne): View
    {
        $this->authorize('view', $interne);
        if ($interne->Recu()) {
            $interne->update(['etat' => CourrierInterneEnum::READ]);
        }

        return view('interne.show', compact('interne'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interne $interne): View
    {
        $this->authorize('update', $interne);
        $user = User::with('userable')->StructureUser()->latest()->get()->groupBy('userable.nom');
        $typeQuery = Nature::orderBy('nom')->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure());
        $type = $typeQuery->get();

        return view('interne.update', compact('interne', 'user', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterneRequest $request, Interne $interne): RedirectResponse
    {
        $interne->update($request->validated());
        $this->file_uplode($request, $interne);
        toastr()->success('Courrier mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $interne): JsonResponse
    {
        $delete = Interne::findOrFail($interne);

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $userId = Auth::user()->id;
        $rows = Interne::with('nature', 'destinataire', 'expediteur')->onlyTrashed()
            ->when(! $isSuperadmin, function ($query) use ($userId) {
                $query->where(function ($query) use ($userId) {
                    $query->where('destinataire_id', $userId)
                        ->orWhere('expediteur_id', $userId);
                });
            })
            ->latest()->paginate(15);

        return view('interne.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Interne::onlyTrashed()->whereId($id)->firstOrFail();

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Interne::onlyTrashed()->whereId($id)->firstOrFail();
        if ($row->documents) {
            foreach ($row->documents as $item) {
                $this->file_delete($item);
            }
        }

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {

        return $this->All_restore(Interne::onlyTrashed());
    }

    public function all_delete(): RedirectResponse
    {

        return $this->All_remove(Interne::onlyTrashed());
    }
}
