<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_club_ring_games', static function (Blueprint $table) {
            $table->dateTime('date')->after('id');

            $table->unique(['date', 'user_id', 'club_ring_game_id']);
        });
    }
};
