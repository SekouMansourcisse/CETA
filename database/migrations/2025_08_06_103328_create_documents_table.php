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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['plan', 'devis', 'contrat', 'photo', 'rapport', 'autre']);
            $table->string('nom');
            $table->string('chemin_acces');
            $table->foreignId('projet_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('activite_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('uploade_par')->constrained('users')->onDelete('cascade');
            $table->timestamp('date_upload');
            $table->string('taille')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
