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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();               // Internal page name
            $table->string('slug')->unique();               // URL slug
            $table->string('title');                        // Page title
            $table->text('description')->nullable();        // Meta description
            $table->json('content');                        // Structured JSON content
            $table->string('template')->default('default'); // Template to use
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
