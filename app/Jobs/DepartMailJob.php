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

class DepartMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $correspondants,private int $id)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $correspondantEmails = Correspondant::whereIn('id', $this->correspondants)->pluck('email');
        $depart = Depart::findOrFail($this->id);
        $correspondantEmails->each(function ($email) use($depart) {
            Mail::to($email)->send(new CourrierDepartMail($depart));
        });
    }
}
