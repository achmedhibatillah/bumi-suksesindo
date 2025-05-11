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
        Schema::create('users', function(Blueprint $table) {
            $table->string('user_id', 35)->primary();
            $table->string('user_nama', 255)->nullable();
            $table->string('user_email', 255)->nullable();
            $table->string('user_password', 255)->nullable();
            $table->string('user_foto', 255)->nullable();
            $table->string('ut_id', 35);
            $table->timestamps();

            $table->foreign('ut_id')->references('ut_id')->on('users_temp')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('users');
    }
};
