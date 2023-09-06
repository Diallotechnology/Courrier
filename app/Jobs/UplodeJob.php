<?php

namespace App\Jobs;

use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Document;
use App\Models\Folder;
use App\Models\Interne;
use App\Models\Rapport;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UplodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public array $documentData;

    public Folder $folder;

    public function __construct(private $uplodefile, private Model $model)
    {

        //  try {

        // if ($this->model instanceof Interne) {
        //     $type = 'Courrier Interne';
        //     $path = 'courrier/interne';
        // } elseif ($this->model instanceof Courrier) {
        //     $type = 'Courrier Arrivé';
        //     $path = 'courrier/arrive';
        // } elseif ($this->model instanceof Rapport) {
        //     $type = 'Rapport';
        //     $path = 'rapport';
        // } elseif ($this->model instanceof Depart) {
        //     $type = 'Courrier Depart';
        //     $path = 'courrier/depart';
        // }
        // $this->folder = new Folder([
        //     'nom' => $this->model->numero,
        //     'type' => $type,
        //     'structure_id' => Auth::user()->structure(),
        // ]);

        // foreach ($this->uplodefile as $file) {
        // dd($file);
        // $filename = $file->hashName();
        // $chemin = $file->storeAs($path, $filename, 'public');
        // $this->documentData[] = array(
        //     'libelle' => $this->model->numero,
        //     'extension' => $file->extension(),
        //     'user_id' => Auth::user()->id,
        // 'folder_id' => $this->folder->id,
        // 'chemin' => $chemin
        //     );
        // }
        // $this->documentData = $data;
        // }

        // catch (\Throwable $th) {
        //     new Exception("file uplode construction error");
        //  }

        // dd($this->documentData);
        // dd($this->uplodefile);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $this->model->folder()->save($this->folder);
        // $this->folder->documents()->createMany($this->documentData);
        // Document::saveMany
        dd($this->documentData);
    }
}
