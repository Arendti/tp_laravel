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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('ticket_title');
            $table->string('ticket_description');
            $table->enum('ticket_status', ['new', 'in progress', 'waiting client', 'done', 'waiting validation', 'validated', 'refused'])->default('new');
            $table->enum('ticket_priority', ['low', 'medium', 'high'])->default('low');
            $table->boolean('ticket_included');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
