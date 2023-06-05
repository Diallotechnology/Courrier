<?php

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
        Schema::create('departs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('nature_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('courrier_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('correspondant_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('structure_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('numero')->nullable()->unique();
            $table->string('objet');
            $table->string('priorite');
            $table->string('confidentiel');
            $table->string('observation')->nullable();
            $table->string('etat')->default('Enregistré');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departs');
    }
};
