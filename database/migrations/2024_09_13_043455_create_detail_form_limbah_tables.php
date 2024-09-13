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
        Schema::create('detail_form_limbah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_limbah_id')->constrained()->onDelete('cascade'); // Menyimpan ID form limbah
            $table->foreignId('limbah_id')->constrained()->onDelete('cascade'); // Menyimpan ID limbah
            $table->integer('quantity'); // Menyimpan quantity limbah
            $table->string('unit'); // Menyimpan unit (kg, pcs, dll)
            $table->timestamps(); // Menyimpan timestamp untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_form_limbah_tables');
    }
};
