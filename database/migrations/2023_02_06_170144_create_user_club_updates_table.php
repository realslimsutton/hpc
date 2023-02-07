<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_club_updates', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('club_update_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('agent_id')->index()->nullable()->constrained('users')->nullOnDelete();
            $table->integer('games')->index();
            $table->integer('hands')->index();
            $table->bigInteger('fee')->index();
            $table->bigInteger('insurance')->index();
            $table->bigInteger('net_winnings')->index();
            $table->timestamps();
        });
    }
};
