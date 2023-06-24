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
        Schema::create('correspondant_depart', function (Blueprint $table) {
            $table->foreignId('correspondant_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('depart_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['correspondant_id', 'depart_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correspondant_depart');
    }
};
