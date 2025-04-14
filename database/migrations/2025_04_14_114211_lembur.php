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
        Schema::create('lembur', function(Blueprint $table) {
            $table->string('lembur_id', 35)->primary();
            $table->date('lembur_tgl');
            $table->time('lembur_mulai');
            $table->time('lembur_selesai');
            $table->string('lembur_catatan', 350);
            $table->integer('lembur_status')->default(0);
            $table->string('user_id', 35);

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schmea::drop('lembur');
    }
};
