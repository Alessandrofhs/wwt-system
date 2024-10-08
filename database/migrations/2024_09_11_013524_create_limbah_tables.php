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
        Schema::create('tm_limbahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_limbah')->unique(); // Kode limbah harus unik
            $table->string('nama_limbah'); // Nama limbah
            $table->timestamps(); // Menyimpan timestamp untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limbah');
    }
};
