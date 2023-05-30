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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('structure_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('courrier_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('reference')->nullable();
            $table->string('objet');
            $table->string('type');
            $table->longText('contenu')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
