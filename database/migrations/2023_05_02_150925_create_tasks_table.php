<?php

use App\Enum\TaskEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courrier_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('imputation_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('createur_id')->constrained('users');
            $table->string('numero')->nullable()->unique();
            $table->string('nom');
            $table->longText('description');
            $table->string('type');
            $table->string('etat')->default(TaskEnum::EN_ATTENTE->value);
            $table->dateTime('debut')->nullable();
            $table->dateTime('fin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
