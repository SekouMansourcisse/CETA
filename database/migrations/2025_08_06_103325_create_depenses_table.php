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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projet_id')->constrained()->onDelete('cascade');
            $table->foreignId('activite_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('montant', 15, 2);
            $table->text('description');
            $table->date('date');
            $table->enum('categorie', ['materiel', 'deplacement', 'formation', 'logiciel', 'autre']);
            $table->foreignId('saisi_par')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
