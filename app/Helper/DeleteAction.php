<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

trait DeleteAction
{

    function supp(Model $delete): JsonResponse {

        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => $delete ?  class_basename($delete)." supprimer avec success " : 'Forme non trouvé',
        ]);
    }

    public function file_delete(Model $model): bool {
        $fileDeleted = false;
        if (File::exists(public_path($model->DocLink()))) {
            $fileDeleted = File::delete(public_path($model->DocLink()));
        }
        return $fileDeleted;
    }


    public function Restore()
    {

    }

    public function All_restore()
    {

    }



    public function Delete()
    {

    }

    public function All_delete()
    {

    }

}
