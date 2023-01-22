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
        Schema::create('professional_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->timestamp('date')->index();
            $table->text('stream_url');
            $table->foreignId('location_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('poker_game_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('stake_id')->index()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('professional_sessions');
    }
};
