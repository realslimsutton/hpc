<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamp('date_of_birth');
            $table->string('clubgg_id')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->unique();
            $table->string('country');
            $table->boolean('accepts_marketing')->index();
            $table->string('discord_id')->nullable()->unique();
            $table->string('discord_username')->nullable();
            $table->string('discord_token')->nullable();
            $table->string('discord_refresh_token')->nullable();
            $table->integer('discord_discriminator')->nullable();
            $table->text('discord_avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
