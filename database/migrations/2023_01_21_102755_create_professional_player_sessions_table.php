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
        Schema::create('professional_player_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_session_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('professional_player_id')->index()->constrained()->cascadeOnDelete();
            $table->bigInteger('net_winnings')->index();
            $table->decimal('vpip')->index();
            $table->decimal('pfr')->index();
            $table->decimal('hours_played')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_player_sessions');
    }
};
