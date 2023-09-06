<?php

namespace App\Jobs;

use App\Mail\ImputationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ImputationNotification;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use App\Notifications\ImputationMailNotification;

class ImputationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

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
        foreach($this->users as $row) :
            Mail::to($row->email)->send($this->notification);
        endforeach;
    }
}
