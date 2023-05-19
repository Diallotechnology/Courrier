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
        Schema::create('annotation_imputation', function (Blueprint $table) {
            $table->foreignId('imputation_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('annotation_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['annotation_id', 'imputation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annotation_imputation');
    }
};
