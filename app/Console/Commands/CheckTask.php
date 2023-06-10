<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Enum\TaskEnum;
use App\Models\User;
use App\Notifications\TaskNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-task';

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
        $currentTime = now();
        // ->whereRaw('NOW() >= fin')
        // Tâches en attente qui ont déjà commencé
        $debut = Task::where('etat', TaskEnum::EN_ATTENTE)->where('debut', '<=', $currentTime);

        $debut->update(['etat' => TaskEnum::EN_COURS]);

        // Utilisateurs liés aux tâches en cours
        $usersEnCours = User::whereIn('id', $debut->pluck('createur_id'))->get(['id', 'email']);

        // Envoi de la notification pour les tâches en cours
        Notification::send($usersEnCours, new TaskNotification(null, 'Vous avez de nouvelles tâches en cours'));

        // Tâches en cours qui sont déjà terminées
        $fin = Task::where('etat', TaskEnum::EN_COURS)->where('fin', '<=', $currentTime);

        $fin->update(['etat' => TaskEnum::NON_TERMINE]);

        // Utilisateurs liés aux tâches non terminées
        $usersNonTerminees = User::whereIn('id', $fin->pluck('createur_id'))->get(['id', 'email']);

        // Envoi de la notification pour les tâches non terminées
        Notification::send($usersNonTerminees, new TaskNotification(null, 'Vous avez des tâches non terminées'));

    }
}
