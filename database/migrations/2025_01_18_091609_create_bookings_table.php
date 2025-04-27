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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('temple_id');
            $table->unsignedBigInteger('user_id');
            $table->date('booking_date');
            $table->string('booking_id');
            $table->string('receipt_number')->unique();
            $table->string('invoice')->nullable();     
            $table->string('invoice_name')->nullable();  
            $table->timestamps();

            $table->foreign('temple_id')->references('id')->on('temples')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
