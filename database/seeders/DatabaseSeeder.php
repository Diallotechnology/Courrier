<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Nature;
use App\Models\Journal;
use App\Models\Courrier;
use App\Models\Structure;
use App\Models\Annotation;
use App\Models\Imputation;
use App\Models\Departement;
use App\Models\Correspondant;
use App\Models\Depart;
use App\Models\Document;
use App\Models\Interne;
use App\Models\Task;
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
        User::factory(60)->create();
        Nature::factory(5)->create();
        Correspondant::factory(35)->create();
        Annotation::factory(275)->hasUser(25);
        $test = User::factory()->create(['email' => 'admin@gmail.com']);
        Annotation::factory(6)->hasUser($test)->create();
        Courrier::factory(60)->create();
        Depart::factory(60)->create();
        Interne::factory(60)->create();
        Document::factory(15)->create();
        Imputation::factory(15)->hasAnnotations(6)->create();
        // Task::factory(15)->create();
        // Agenda::factory(15)->create();
        // Journal::factory(10)->create();


        $departement = Departement::factory()
        ->has(User::factory()->count(10), 'users')
        ->create();

        $user = User::factory()
        ->has(Courrier::factory()->count(10), 'courriers')
        // ->has(Imputation::factory()->count(10), 'imputations')
        // ->has(Task::factory()->count(10), 'tasks')
        // ->has(Journal::factory()->count(5), 'journals')
        // ->has(Notification::factory()->count(5), 'journals')
        ->create();
    }
}
