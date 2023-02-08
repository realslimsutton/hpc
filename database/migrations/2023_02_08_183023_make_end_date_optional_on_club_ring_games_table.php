<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('club_ring_games', static function (Blueprint $table) {
            $table->dateTime('ended_at')->nullable()->change();
        });
    }
};
