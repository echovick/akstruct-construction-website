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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('project_type'); // Dropdown selection
            $table->string('budget_range')->nullable();
            $table->text('message')->nullable();
            $table->string('drawings_specs')->nullable(); // Path to uploaded file
            $table->enum('status', ['new', 'in_progress', 'completed', 'declined'])->default('new');
            $table->text('admin_notes')->nullable(); // Internal notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
