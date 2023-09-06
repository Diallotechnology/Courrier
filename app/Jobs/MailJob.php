<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
<<<<<<< HEAD
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
=======
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16
use romanzipp\QueueMonitor\Traits\IsMonitored;

class MailJob implements ShouldQueue
{
<<<<<<< HEAD
    use Dispatchable, InteractsWithQueue, IsMonitored, Queueable, SerializesModels;
=======
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new RegisterMail($this->user));
    }
}
