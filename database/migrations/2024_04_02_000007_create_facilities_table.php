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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('capacity')->nullable();
            $table->integer('floor');
            $table->string('image_main')->nullable(); // Add a column for image storage
            $table->string('image_1')->nullable(); // Add a column for image storage
            $table->string('image_2')->nullable(); // Add a column for image storage
            $table->string('image_3')->nullable(); // Add a column for image storage
            $table->string('location')->nullable();
            $table->string('google_map_link')->nullable();
            $table->foreignId('uker_masters_id')->constrained('uker_masters');
            $table->foreignId('facility_category_id')->constrained('facility_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};