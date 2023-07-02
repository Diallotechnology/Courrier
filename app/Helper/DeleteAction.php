<?php

namespace App\Helper;

use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Document;
use App\Models\History;
use App\Models\Interne;
use App\Models\Journal;
use App\Models\Rapport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

trait DeleteAction
{
    public function history(int $id, string $action, string $description): void
    {
        History::create([
            'user_id' => Auth::user()->id,
            'courrier_id' => $id,
            'action' => $action,
            'description' => $description,
        ]);
    }

    public function journal(string $action): void
    {
        Journal::create([
            'user_id' => Auth::user()->id,
            'structure_id' => Auth::user()->structure(),
            'libelle' => $action,
        ]);
    }

    public function supp(Model $delete): JsonResponse
    {
        $this->authorize('delete', $delete);
        $delete->delete();

        return response()->json([
            'success' => true,
            'message' => $delete ? class_basename($delete).' supprimer avec success ' : class_basename($delete).' non trouvé',
        ]);
    }

    public function file_delete(Model $model): bool
    {
        $fileDeleted = false;
        if (File::exists(public_path($model->DocLink()))) {
            $fileDeleted = File::delete(public_path($model->DocLink()));
        }

        return $fileDeleted;
    }

    public function file_uplode($request, Model $model)
    {
        $type = '';
        $path = '';

        if ($model instanceof Interne) {
            $type = 'Interne';
            $path = 'courrier/interne';
        } elseif ($model instanceof Courrier) {
            $type = 'Courrier Arrivé';
            $path = 'courrier/arrive';
        } elseif ($model instanceof Rapport) {
            $type = 'Rapport';
            $path = 'rapport';
        } elseif ($model instanceof Depart) {
            $type = 'Courrier Depart';
            $path = 'courrier/depart';
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                $filename = $file->hashName();
                $chemin = $file->storeAs($path, $filename, 'public');
                $data = new Document([
                    'libelle' => $model->numero,
                    'type' => $type,
                    'user_id' => Auth::user()->id,
                    'structure_id' => Auth::user()->structure(),
                    'chemin' => $chemin,
                ]);
                $model->documents()->save($data);
            }
        }
    }

    public function Restore(Model $delete): JsonResponse
    {
        $this->authorize('restore', $delete);
        $delete->restore();

        return response()->json([
            'success' => true,
            'message' => $delete ? class_basename($delete).' restaure avec success ' : class_basename($delete).' non trouvé',
        ]);
    }

    public function Remove(Model $delete)
    {
        $this->authorize('forceDelete', $delete);
        $delete->forceDelete();

        return response()->json([
            'success' => true,
            'message' => $delete ? class_basename($delete).' definitivement supprimer avec success ' : class_basename($delete).' non trouvé',
        ]);
    }

    public function All_restore(Builder $delete)
    {
        $delete->restore();
        toastr()->success('Tous les elements ont été restaure avec success!');

        return back();
    }

    public function All_remove(Builder $delete)
    {
        $delete->forceDelete();
        toastr()->success('Tous les elements ont été definitivement supprimé avec success!');

        return back();
    }
}
