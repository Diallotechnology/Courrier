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
        Schema::create('imputation_sub_departement', function (Blueprint $table) {
            $table->foreignId('imputation_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sub_departement_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['sub_departement_id', 'imputation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imputation_sub_departement');
    }
};
