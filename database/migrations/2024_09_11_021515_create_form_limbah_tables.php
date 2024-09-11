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
        Schema::create('form_limbah_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('limbah_id')->constrained('limbah')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('destination')->onDelete('cascade');
            $table->string('no_policy')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('no_truck');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_limbah_tables');
    }
};
