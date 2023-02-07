<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_club_tournaments', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('club_tournament_id')->index()->constrained()->cascadeOnDelete();
            $table->bigInteger('buy_in')->index();
            $table->bigInteger('buy_in_fee')->index();
            $table->bigInteger('re_entry')->index();
            $table->bigInteger('re_entry_fee')->index();
            $table->integer('hands')->index();
            $table->bigInteger('gross_winnings')->index();
            $table->bigInteger('net_winnings')->index();
            $table->timestamps();
        });
    }
};
