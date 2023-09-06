<?php

namespace App\Jobs;

use App\Mail\ImputationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
<<<<<<< HEAD
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class ImputationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, IsMonitored, Queueable, SerializesModels;
=======
use Illuminate\Support\Facades\Notification;
use App\Notifications\ImputationNotification;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use App\Notifications\ImputationMailNotification;

class ImputationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16

    /**
     * Create a new job instance.
     */
    public function __construct(protected ImputationMail $notification, protected Collection $users)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->users as $row) {
            Mail::to($row->email)->send($this->notification);
        }
    }
}
