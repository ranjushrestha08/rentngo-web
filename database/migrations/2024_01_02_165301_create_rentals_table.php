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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('drop_location_id');
            $table->foreign('drop_location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('pick_location_id');
            $table->foreign('pick_location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('total_cost');
            $table->string('rental_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
