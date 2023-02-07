<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_ring_games', static function (Blueprint $table) {
            $table->id();
            $table->dateTime('started_at')->index();
            $table->dateTime('ended_at')->index();
            $table->string('table_name')->index();
            $table->foreignId('user_id')->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignId('club_update_id')->index()->constrained()->cascadeOnDelete();
            $table->string('game_rules')->index();
            $table->string('blinds')->index();
            $table->string('rake')->index();
            $table->string('rake_cap')->index()->nullable();
            $table->timestamps();
        });
    }
};
