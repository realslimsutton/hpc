<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('professional_players', static function (Blueprint $table) {
            $table->timestamp('date_of_birth')->nullable()->index()->after('hometown');
        });
    }
};
