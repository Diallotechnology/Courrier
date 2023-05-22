<?php

use App\Enum\CourrierInterneEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('nature_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('expediteur_id')->constrained('users');
            $table->foreignId('destinataire_id')->constrained('users');
            $table->dateTime('delai')->nullable();
            $table->string('reference')->nullable()->unique();
            $table->string('objet');
            $table->string('priorite');
            $table->string('confidentiel');
            $table->longText('contenu')->nullable();
            $table->string('etat')->default(CourrierInterneEnum::RECU->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internes');
    }
};
