<?php

namespace App\Console\Commands;

use App\Jobs\DepartMailJob;
use App\Models\Depart;
use Illuminate\Console\Command;

class CheckDepartMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-depart-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send courrier depart correspondants notification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentTime = now();
        $depart = Depart::with('correspondants','nature','initiateur','courrier','structure')->where('date', '<=', $currentTime)->get();
        $depart->each(function ($row)  {
            // send correspondant mail notification
            DepartMailJob::dispatch($row->correspondants->pluck('email'), $row);
        });
    }
}
