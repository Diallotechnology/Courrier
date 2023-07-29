<?php

namespace App\Jobs;

use App\Models\Depart;
use App\Models\Interne;
use App\Models\Rapport;
use App\Models\Courrier;
use App\Models\Document;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UplodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, DeleteAction;

    /**
     * Create a new job instance.
     */
    public function __construct(public Request $request, public Model $model)
    {
        $this->request = $request;
        $this->model = $model;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

    }

}
