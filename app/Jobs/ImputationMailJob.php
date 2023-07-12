<?php

namespace App\Jobs;

use App\Notifications\ImputationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ImputationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ImputationNotification $notification, public array $emails)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::route('mail', $this->emails)->notify($this->notification);
    }
}
