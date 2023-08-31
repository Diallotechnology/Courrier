<?php

namespace App\Jobs;

use App\Mail\CourrierDepartMail;
use App\Models\Correspondant;
use App\Models\Depart;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Collection;

class DepartMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        // $correspondantEmails = Correspondant::whereIn('id', $this->correspondants)->pluck('email');
        $correspondantEmails = $this->correspondants;
        $correspondantEmails->each(function ($email) use($depart) {
            Mail::to($email)->send(new CourrierDepartMail($depart));
        });
    }
}
