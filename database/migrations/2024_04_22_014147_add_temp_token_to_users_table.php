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
        Schema::table('users', function (Blueprint $table) {
            $table->string('temp_token')->nullable();
            $table->string('otp')->nullable();
            $table->string('otp_verified_at')->nullable();
            $table->string('otp_sent_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('temp_token');
            $table->dropColumn('otp');
            $table->dropColumn('otp_verified_at');
            $table->dropColumn('otp_sent_at');
        });
    }
};
