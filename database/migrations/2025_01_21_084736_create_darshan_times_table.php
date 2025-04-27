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
        Schema::create('darshan_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('temple_id');
            $table->date('date');
            $table->string('from');
            $table->string('to');
            $table->timestamps();

            $table->foreign(columns: 'temple_id')->references('id')->on('temples')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('darshan_times');
    }
};
