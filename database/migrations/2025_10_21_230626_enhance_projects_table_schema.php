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
        Schema::table('projects', function (Blueprint $table) {
            // Remove redundant/unused category string field (we use category_id FK instead)
            $table->dropColumn('category');

            // Add video support for project videos
            $table->string('video_path')->nullable()->after('gallery_images');

            // Add structured specifications (JSON) for technical details
            $table->json('specifications')->nullable()->after('sustainability_focus');

            // Add project timeline/milestones (JSON)
            $table->json('timeline')->nullable()->after('duration');

            // Add map coordinates for Google Maps integration
            $table->string('map_coordinates')->nullable()->after('location');
            $table->string('google_maps_url')->nullable()->after('map_coordinates');

            // Add team/stakeholder information
            $table->string('developer')->nullable()->after('client');
            $table->string('architect')->nullable()->after('developer');
            $table->string('contractor')->nullable()->after('architect');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Re-add the category field
            $table->string('category')->after('short_description');

            // Remove added fields
            $table->dropColumn([
                'video_path',
                'specifications',
                'timeline',
                'map_coordinates',
                'google_maps_url',
                'developer',
                'architect',
                'contractor',
            ]);
        });
    }
};
