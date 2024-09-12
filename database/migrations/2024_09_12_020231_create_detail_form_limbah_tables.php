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
            $table->unsignedBigInteger('limbah_id');
            $table->timestamps();
            $table->foreign('limbah_id')->references('id')->on('limbah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_form_limbah');
    }
};
