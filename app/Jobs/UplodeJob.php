<?php

namespace App\Jobs;

use App\Helper\DeleteAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
