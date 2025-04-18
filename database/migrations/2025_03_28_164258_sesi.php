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
        Schema::create('sesi', function(Blueprint $table) {
            $table->string('sesi_id', 35)->primary();
            $table->string('sesi_deskripsi', 255)->nullable();
            $table->dateTime('sesi_masuk')->nullable();
            $table->dateTime('sesi_pulang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('sesi');
    }
};
