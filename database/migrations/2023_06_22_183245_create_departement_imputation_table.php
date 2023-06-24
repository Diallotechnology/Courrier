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
        Schema::create('departement_imputation', function (Blueprint $table) {
            $table->foreignId('departement_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('imputation_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['departement_id', 'imputation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departement_imputation');
    }
};
