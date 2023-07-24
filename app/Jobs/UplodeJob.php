<?php

namespace App\Jobs;

use App\Helper\DeleteAction;
use Illuminate\Bus\Queueable;
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
    public function __construct(public $request, public Model $model)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->file_uplode($this->request, $this->model);
    }
}
