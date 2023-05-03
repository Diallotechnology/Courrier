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
        Schema::create('imputations', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('departement_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('courrier_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('delai')->nullable();
            $table->string('reference')->unique();
            $table->date('fin_traitement')->nullable();
            $table->string('observation')->nullable();
            $table->enum('etat', ['foo', 'bar'])->nullable()->default('foo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imputations');
    }
};
