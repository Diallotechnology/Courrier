<?php

namespace App\Jobs;

<<<<<<< HEAD
use App\Mail\CourrierDepartMail;
=======
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16
use App\Models\Depart;
use App\Models\Correspondant;
use Illuminate\Bus\Queueable;
<<<<<<< HEAD
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
=======
use App\Mail\CourrierDepartMail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16
use romanzipp\QueueMonitor\Traits\IsMonitored;

class DepartMailJob implements ShouldQueue
{
<<<<<<< HEAD
    use Dispatchable, InteractsWithQueue, IsMonitored, Queueable, SerializesModels;
=======
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16

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
