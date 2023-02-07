<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('club_tournaments', static function (Blueprint $table) {
            $table->string('duration')->virtualAs('TIMEDIFF(ended_at, started_at)')->index()->after('ended_at');
        });
    }
};
