<?php

namespace App\Jobs;

<<<<<<< HEAD
use App\Notifications\CourrierNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
=======
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CourrierNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16
use romanzipp\QueueMonitor\Traits\IsMonitored;

class CourrierMailJob implements ShouldQueue
{
<<<<<<< HEAD
    use Dispatchable, InteractsWithQueue, IsMonitored, Queueable, SerializesModels;
=======
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16

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
