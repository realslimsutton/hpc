<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_session', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('session_id')->index()->constrained()->cascadeOnDelete();
            $table->bigInteger('net_winnings')->nullable()->index();
            $table->decimal('vpip')->nullable()->index();
            $table->decimal('pfr')->nullable()->index();
            $table->decimal('hours_played')->nullable()->index();
        });
    }
};
