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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Who performed the action
            $table->string('action'); // e.g., 'created', 'updated', 'deleted'
            $table->string('model_type'); // e.g., 'App\Models\Projet'
            $table->unsignedBigInteger('model_id')->nullable(); // ID of the affected record
            $table->json('old_values')->nullable(); // Old data (for updates)
            $table->json('new_values')->nullable(); // New data (for creations/updates)
            $table->text('description')->nullable(); // Textual description of the action
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};
