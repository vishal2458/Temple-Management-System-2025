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
            Schema::create('arti_times', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('temple_id');
                $table->date('date');
                $table->string('time');
                $table->timestamps();
                $table->foreign(columns: 'temple_id')->references('id')->on('temples')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arti_times');
    }
};
