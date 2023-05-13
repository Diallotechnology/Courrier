<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

trait DeleteAction
{

    function supp(Model $delete): JsonResponse {

        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => $delete ?  class_basename($delete)." supprimer avec success " : class_basename($delete).' non trouvé',
        ]);
    }

    public function file_delete(Model $model): bool {
        $fileDeleted = false;
        if (File::exists(public_path($model->DocLink()))) {
            $fileDeleted = File::delete(public_path($model->DocLink()));
        }
        return $fileDeleted;
    }


    public function Restore(Model $delete): JsonResponse
    {
        $delete->restore();
        return response()->json([
            'success' => true,
            'message' => $delete ?  class_basename($delete)." restaure avec success " : class_basename($delete).' non trouvé',
        ]);
    }



    public function Remove(Model $delete)
    {
        $delete->forceDelete();
        return response()->json([
            'success' => true,
            'message' => $delete ?  class_basename($delete)." definitivement supprimer avec success " : class_basename($delete).' non trouvé',
        ]);
    }

    public function All_restore(Builder $delete)
    {
        $delete->restore();
        toastr()->success("Tous les elements ont été restaure avec success!");
       return back();
    }

    public function All_remove(Builder $delete)
    {
        $delete->forceDelete();
        toastr()->success("Tous les elements ont été definitivement supprimé avec success!");
        return back();
    }

}
