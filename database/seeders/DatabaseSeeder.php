<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enum\RoleEnum;
use App\Enum\StructureTypeEnum;
use App\Models\Annotation;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Folder;
use App\Models\Imputation;
use App\Models\Interne;
use App\Models\Nature;
use App\Models\Price;
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
        Depart::factory(60)->hasCorrespondants(2)->create();
        Correspondant::factory(35)->create();
        Annotation::factory(10)->hasUser(5);
        Annotation::factory(3)->hasUser($test)->create();
        Courrier::factory(260)->create();
        Interne::factory(160)->create();
        Folder::factory(15)->create();
        Document::factory(95)->create();
        Imputation::factory(55)->hasAnnotations(5)->hasDepartements(6)->create();
        Rapport::factory(15)->create();
        Task::factory(150)->create();

        User::factory()
            ->has(Courrier::factory()->count(10), 'courriers')
            ->has(Imputation::factory()->count(10), 'imputations')
            ->has(Task::factory()->count(10), 'tasks')
            ->create();

        $priceData = [
            ['type' => StructureTypeEnum::SMALL, 'temps' => 3, 'montant' => 150000],
            ['type' => StructureTypeEnum::SMALL, 'temps' => 6, 'montant' => 300000],
            ['type' => StructureTypeEnum::SMALL, 'temps' => 12, 'montant' => 600000],
            ['type' => StructureTypeEnum::MOYEN, 'temps' => 3, 'montant' => 300000],
            ['type' => StructureTypeEnum::MOYEN, 'temps' => 6, 'montant' => 600000],
            ['type' => StructureTypeEnum::MOYEN, 'temps' => 12, 'montant' => 1100000],
        ];

        foreach ($priceData as $data) {
            Price::factory()->create([
                'type' => $data['type'],
                'temps' => $data['temps'],
                'montant' => $data['montant'],
            ]);
        }
    }
}
