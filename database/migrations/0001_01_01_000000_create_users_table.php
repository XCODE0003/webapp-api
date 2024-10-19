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
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unique();
            $table->string('firstName');
            $table->string('name')->nullable();
            $table->string('avatar');
            $table->bigInteger('ref_id')->nullable();
            $table->integer('click_level')->default(0);
            $table->integer('autobot_level')->default(0);
            $table->integer('recharging_level')->default(0);
            $table->boolean('autoclaim_bonus')->default(false);
            $table->string('balance')->default(0);
            $table->string('balance_donat')->default(0);
            $table->integer('free_spins')->default(2);
            $table->dateTime('last_give_spins')->nullable()->default(now());
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_claim')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
