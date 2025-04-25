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
        Schema::create('presensi', function(Blueprint $table) {
            $table->string('presensi_id', 35)->primary();
            $table->integer('presensi_status')->nullable();
            // Status:
            // 1 = Hadir
            // 2 = Telat
            // 3 = Izin
            // 4 = Alpha
            // 5 = Cuti
            $table->string('presensi_keterangan', 255)->nullable();
            $table->string('user_id', 35);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('presensi');
    }
};
