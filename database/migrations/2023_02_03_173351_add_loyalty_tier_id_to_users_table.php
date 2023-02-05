<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->foreignId('loyalty_tier_id')->after('balance')->nullable()->index()->constrained()->nullOnDelete();
        });
    }
};
