<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('department');
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->json('social_links')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
