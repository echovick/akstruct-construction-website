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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->text('content');
            $table->string('image')->nullable();     // Client photo
            $table->string('video_url')->nullable(); // Video testimonial URL
            $table->string('audio_url')->nullable(); // Audio testimonial URL
            $table->boolean('is_featured')->default(false);
            $table->integer('rating')->nullable(); // Optional rating (e.g., 1-5 stars)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
