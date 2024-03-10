<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_name');
            $table->enum('fuel_type',['Petrol','Diesel','Electric']);
            $table->string('model');
            $table->string('cost_per_hour');
            $table->string('image_url');
            $table->string('vehicle_description');
            $table->unsignedBigInteger('vehicle_category_id');
            $table->foreign('vehicle_category_id')->references('id')->on('vehicle_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
