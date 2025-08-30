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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projet_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['etude', 'expertise', 'realisation', 'autorisation']);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut', ['planifie', 'en_cours', 'termine', 'retard']);
            $table->decimal('montant_prevu', 15, 2);
            $table->decimal('montant_realise', 15, 2);
            $table->foreignId('responsable_id')->constrained('users')->onDelete('cascade');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
