<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\LicenceNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
<<<<<<< HEAD
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
=======
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16
use romanzipp\QueueMonitor\Traits\IsMonitored;

class LicenceMailJob implements ShouldQueue
{
<<<<<<< HEAD
    use Dispatchable, InteractsWithQueue, IsMonitored, Queueable, SerializesModels;
=======
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;
>>>>>>> fce45b969ec21c06ebf7063d5c926e44705ccd16

    /**
     * Create a new job instance.
     */
    public function __construct(public LicenceNotification $notification, protected User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify($this->notification);
    }
}
