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
        Schema::create('satker_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kd_satker')->index(); // Add index to kd_satker column
            $table->string('nama_satker');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satker_masters');
    }
};