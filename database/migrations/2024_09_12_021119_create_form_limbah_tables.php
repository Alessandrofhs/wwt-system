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
        Schema::create('form_limbah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_id');
            $table->unsignedBigInteger('destination_id');
            $table->string('no_policy')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('no_truck')->nullable();
            $table->string('description')->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();
            $table->foreign('detail_id')->references('id')->on('detail_form_limbah')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('destination')->onDelete('cascade');
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
