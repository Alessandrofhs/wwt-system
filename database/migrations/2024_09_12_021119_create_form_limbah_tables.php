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
        Schema::create('form_limbahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade'); // Menyimpan ID tujuan
            $table->string('no_policy'); // Menyimpan nomor kebijakan
            $table->string('no_truck'); // Menyimpan nomor truk
            $table->text('description'); // Menyimpan deskripsi
            $table->string('photo')->nullable(); // Menyimpan path foto (jika ada)
            $table->timestamps(); // Menyimpan timestamp untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_limbah');
    }
};
