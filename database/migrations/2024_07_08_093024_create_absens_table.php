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
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hadir_id');
            $table->foreign('hadir_id')->references('id')->on('hadirs')->onDelete('cascade')->onUpdate('cascade');

            $table->string('date');
            $table->integer('hadir');
            $table->integer('izin');
            $table->integer('alfa');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
