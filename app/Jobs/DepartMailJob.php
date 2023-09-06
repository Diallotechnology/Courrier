<?php

namespace App\Jobs;

use App\Models\Depart;
use App\Models\Correspondant;
use Illuminate\Bus\Queueable;
use App\Mail\CourrierDepartMail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class DepartMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    /**
     * Create a new job instance.
     */
    public function __construct(private Collection $correspondants,private Depart $depart)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $depart = $this->depart;
        $correspondantEmails = $this->correspondants;
        $correspondantEmails->each(function ($email) use($depart) {
            Mail::to($email)->send(new CourrierDepartMail($depart));
        });
    }
}
