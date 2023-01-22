<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('professional_players', static function (Blueprint $table) {
            $table->string('country')->index()->nullable()->after('twitter_handle');
            $table->string('hometown')->index()->nullable()->after('country');
        });
    }
};
