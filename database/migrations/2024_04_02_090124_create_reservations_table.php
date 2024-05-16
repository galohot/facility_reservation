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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('facility_id')->constrained('facilities');
            $table->string('event');
            $table->dateTime('reservation_start');
            $table->dateTime('reservation_end');
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->string('description');
            $table->string('document')->nullable(); // Add a column for image storage
            $table->string('document_attachment')->nullable(); // Add a column for image storage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};