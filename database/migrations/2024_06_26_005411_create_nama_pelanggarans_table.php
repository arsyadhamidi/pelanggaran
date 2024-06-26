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
        Schema::create('nama_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenispelanggaran_id');
            $table->text('nama');
            $table->text('point');
            $table->text('sanksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nama_pelanggarans');
    }
};