<?php

namespace App\Jobs;

use App\Notifications\CourrierNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class CourrierMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, IsMonitored, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected CourrierNotification $notification, protected Collection $users)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->users, $this->notification);
    }
}
