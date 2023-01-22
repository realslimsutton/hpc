<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('professional_players', static function (Blueprint $table) {
            $table->text('twitter_url')->nullable()->after('enabled');
            $table->text('twitter_handle')->nullable()->after('twitter_url');
        });
    }
};
