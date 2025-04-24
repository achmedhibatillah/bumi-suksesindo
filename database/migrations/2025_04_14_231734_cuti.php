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
        Schema::create('cuti', function(Blueprint $table) {
            $table->string('cuti_id', 35)->primary();
            $table->integer('cuti_status');
            $table->date('cuti_mulai');
            $table->date('cuti_selesai');
            $table->string('cuti_alasan', 350)->nullable();
            $table->integer('cuti_verif');
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
        Schema::drop('cuti');
    }
};
