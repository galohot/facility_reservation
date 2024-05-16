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
        Schema::create('uker_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('satker_master_kd_satker'); // Change to unsigned integer to match
            $table->foreign('satker_master_kd_satker')->references('kd_satker')->on('satker_masters'); // Specify the column to reference
            $table->string('nama_unit_kerja_eselon_2');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uker_masters');
    }
};