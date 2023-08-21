<?php

namespace App\Console\Commands;

use App\Enum\ImputationEnum;
use App\Enum\TaskEnum;
use App\Models\Imputation;
use Illuminate\Console\Command;

class CheckImputation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-imputation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Imputation::with('tasks')
            ->whereRelation('tasks', 'etat', TaskEnum::NON_TERMINE)->update(['etat' => ImputationEnum::EXPIRE]);

    }
}
