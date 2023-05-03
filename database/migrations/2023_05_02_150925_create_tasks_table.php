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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courrier_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            // $table->foreignId('imputation_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nom');
            $table->string('description');
            $table->string('type');
            $table->enum('etat', ['foo', 'bar'])->nullable()->default('foo');
            $table->dateTime('debut');
            $table->dateTime('fin');
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
