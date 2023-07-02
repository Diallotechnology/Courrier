<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enum\RoleEnum;
use App\Models\Annotation;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Imputation;
use App\Models\Interne;
use App\Models\Journal;
use App\Models\Nature;
use App\Models\Notification;
use App\Models\Rapport;
use App\Models\Structure;
use App\Models\SubDepartement;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Structure::factory(5)->create();
        Departement::factory(5)->create();
        SubDepartement::factory(5)->create();
        $test = User::factory()->create(['email' => 'admin@gmail.com', 'role' => RoleEnum::ADMIN]);
        User::factory(25)->create();
        Nature::factory(5)->create();
        Depart::factory(260)->hasCorrespondants(2)->create();
        Correspondant::factory(35)->create();
        Annotation::factory(275)->hasUser(25);
        Annotation::factory(6)->hasUser($test)->create();
        Courrier::factory(260)->create();
        Interne::factory(260)->create();
        Document::factory(115)->create();
        Imputation::factory(115)->hasAnnotations(6)->hasDepartements(6)->create();
        Rapport::factory(15)->create();
        Task::factory(150)->create();
        // Journal::factory(10)->create()
        // Générer 10 fausses notifications pour chaque utilisateur
        // User::all()->each(function ($user) {
        // Notification::factory()->count(10)->create();
        // });

        User::factory()
            ->has(Courrier::factory()->count(10), 'courriers')
            ->has(Imputation::factory()->count(10), 'imputations')
            ->has(Task::factory()->count(10), 'tasks')
        // ->has(Journal::factory()->count(5), 'journals')
        // ->has(Notification::factory()->count(5), 'journals')
            ->create();
    }
}
