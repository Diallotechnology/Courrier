<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CourrierNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
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
