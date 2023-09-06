<?php

namespace App\Jobs;

use App\Mail\CourrierDepartMail;
use App\Models\Depart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class DepartMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, IsMonitored, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Collection $correspondants, private Depart $depart)
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
        $correspondantEmails->each(function ($email) use ($depart) {
            Mail::to($email)->send(new CourrierDepartMail($depart));
        });
        $depart->update(['etat' => 'Envoyé']);
    }
}
