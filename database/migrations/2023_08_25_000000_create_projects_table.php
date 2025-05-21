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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('short_description')->nullable();
            $table->string('category'); // Residential, Commercial, etc.
            $table->string('location');
            $table->string('year');
            $table->string('client')->nullable();
            $table->string('area')->nullable();
            $table->string('duration')->nullable();
            $table->string('floors')->nullable();
            $table->string('status')->default('Completed');
            $table->decimal('cost', 15, 2)->nullable();
            $table->text('sustainability_focus')->nullable();
            $table->string('image_path')->nullable();             // Main featured image
            $table->string('featured_image')->nullable();         // Alternative field for featured image
            $table->json('gallery')->nullable();                  // For backward compatibility
            $table->json('gallery_images')->nullable();           // Stores array of image paths
            $table->json('highlights')->nullable();               // Stores array of project highlights
            $table->string('completion_certificate')->nullable(); // Path to downloadable certificate
            $table->string('case_study_pdf')->nullable();         // Path to downloadable PDF
            $table->string('completed_at')->nullable();           // Path to downloadable PDF
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
